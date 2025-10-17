<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function createCheckoutSession(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'cpf' => 'nullable|string|max:20',
        ]);

        $cart = $request->session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('success', 'Seu carrinho está vazio.');
        }

        $total = collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']);

        $order = Order::create([
            'user_id' => optional($request->user())->id,
            'name' => $request->name,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'total' => $total,
            'payment_status' => 'pending',
        ]);
        foreach ($cart as $i) {
            $order->items()->create([
                'system_id' => $i['id'],
                'name' => $i['name'],
                'price' => $i['price'],
                'quantity' => $i['quantity'],
            ]);
        }

        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        $lineItems = collect($cart)->map(function ($i) {
            return [
                'price_data' => [
                    'currency' => 'brl',
                    'product_data' => [
                        'name' => $i['name'],
                    ],
                    'unit_amount' => (int) round($i['price'] * 100),
                ],
                'quantity' => $i['quantity'],
            ];
        })->values()->all();

        $session = \Stripe\Checkout\Session::create([
            'mode' => 'payment',
            'customer_email' => $request->email,
            'line_items' => $lineItems,
            'success_url' => route('stripe.success', ['order' => $order->id]),
            'cancel_url' => route('stripe.cancel', ['order' => $order->id]),
            'metadata' => [ 'order_id' => (string) $order->id ],
        ]);

        $order->update(['stripe_session_id' => $session->id]);

        return redirect($session->url);
    }

    public function success(Request $request, Order $order)
    {
        if ($order->payment_status !== 'paid') {
            $order->update(['payment_status' => 'paid', 'paid_at' => now()]);
        }
        $request->session()->forget('cart');
        return redirect()->route('cart.receipt', $order)->with('success', 'Pagamento aprovado.');
    }

    public function cancel(Order $order)
    {
        return redirect()->route('cart.index')->with('success', 'Pagamento cancelado.');
    }

    public function webhook(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $endpointSecret = config('services.stripe.webhook_secret');

        try {
            $event = \Stripe\Webhook::constructEvent($payload, $sigHeader, $endpointSecret);
        } catch (\UnexpectedValueException $e) {
            return response('Invalid payload', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            return response('Invalid signature', 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;
                $this->handleCheckoutSessionCompleted($session);
                break;
            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object;
                $this->handlePaymentSucceeded($paymentIntent);
                break;
            default:
                \Log::info('Unhandled event type: ' . $event->type);
        }

        return response('OK', 200);
    }

    private function handleCheckoutSessionCompleted($session)
    {
        $order = Order::where('stripe_session_id', $session->id)->first();
        
        if ($order && $order->payment_status !== 'paid') {
            $order->update([
                'payment_status' => 'paid',
                'paid_at' => now(),
            ]);
            
            \Log::info('Order payment confirmed via webhook: ' . $order->id);
        }
    }

    private function handlePaymentSucceeded($paymentIntent)
    {
        \Log::info('Payment succeeded: ' . $paymentIntent->id);
    }
}


