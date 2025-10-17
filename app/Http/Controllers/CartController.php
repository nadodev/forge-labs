<?php

namespace App\Http\Controllers;

use App\Models\System;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $total = collect($cart)->sum(function ($item) {
            return ($item['price'] ?? 0) * ($item['quantity'] ?? 1);
        });
        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, System $system)
    {
        $cart = $request->session()->get('cart', []);
        $id = $system->id;
        if (!isset($cart[$id])) {
            $cart[$id] = [
                'id' => $system->id,
                'slug' => $system->slug,
                'name' => $system->name,
                'price' => (float) $system->price,
                'quantity' => 1,
            ];
        } else {
            $cart[$id]['quantity'] += 1;
        }
        $request->session()->put('cart', $cart);
        return back()->with('success', 'Adicionado ao carrinho.');
    }

    public function update(Request $request, System $system)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:99'
        ]);
        $cart = $request->session()->get('cart', []);
        if (isset($cart[$system->id])) {
            $cart[$system->id]['quantity'] = (int) $request->quantity;
            $request->session()->put('cart', $cart);
            return back()->with('success', 'Quantidade atualizada.');
        }
        return back();
    }

    public function remove(Request $request, System $system)
    {
        $cart = $request->session()->get('cart', []);
        unset($cart[$system->id]);
        $request->session()->put('cart', $cart);
        return back()->with('success', 'Item removido do carrinho.');
    }

    public function clear(Request $request)
    {
        $request->session()->forget('cart');
        return back()->with('success', 'Carrinho limpo.');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'cpf' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:30',
            'notes' => 'nullable|string|max:1000',
            'contact_method' => 'required|in:email,whatsapp',
        ]);

        $cart = $request->session()->get('cart', []);
        if (empty($cart)) {
            return back()->with('success', 'Seu carrinho está vazio.');
        }

        $summary = collect($cart)->map(function ($i) {
            return $i['name'].' x'.$i['quantity'].' — R$ '.number_format($i['price'], 2, ',', '.');
        })->implode("\n");
        $total = collect($cart)->sum(function ($i) { return $i['price'] * $i['quantity']; });
        $summary .= "\nTotal: R$ ".number_format($total, 2, ',', '.');

        // Salvar pedido
        $order = \App\Models\Order::create([
            'name' => $request->name,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'whatsapp' => $request->whatsapp,
            'notes' => $request->notes,
            'total' => $total,
            'contact_method' => $request->contact_method,
            'status' => 'pending',
        ]);
        foreach ($cart as $i) {
            $order->items()->create([
                'system_id' => $i['id'],
                'name' => $i['name'],
                'price' => $i['price'],
                'quantity' => $i['quantity'],
            ]);
        }

        if ($request->contact_method === 'whatsapp') {
            $phone = preg_replace('/\D+/', '', $request->whatsapp ?? '55');
            $text = urlencode("Olá! Quero finalizar a compra dos sistemas:%0A%0A$summary");
            return redirect()->away("https://wa.me/{$phone}?text={$text}");
        }

        if ($request->contact_method === 'email') {
            $to = $request->email ?: config('mail.from.address');
            // Opcional: enviar email real. Aqui apenas simulamos com flash.
            // Mail::raw("Pedido:\n\n$summary", function($m) use ($to) { $m->to($to)->subject('Pedido de sistemas'); });
            $request->session()->forget('cart');
            return redirect()->route('cart.receipt', $order)->with('success', 'Pedido enviado por e-mail.');
        }

        return redirect()->route('cart.receipt', $order);
    }

    public function receipt(\App\Models\Order $order)
    {
        $order->load('items');
        return view('cart.receipt', compact('order'));
    }
}


