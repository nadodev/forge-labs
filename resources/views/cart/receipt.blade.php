@extends('layouts.app')

@section('title', 'Recibo do Pedido - Geja Systems')

@section('content')
<section class="section">
    <div class="container">
        <div class="card">
            <div class="card-content">
                <div class="card-header">
                    <div class="card-badge">Recibo</div>
                    <h1 class="card-title">Pedido #{{ $order->id }}</h1>
                </div>
                <p class="muted">Obrigado, {{ $order->name }}. Recebemos seu pedido.</p>

                <div class="grid-2">
                    <div>
                        <h3 class="section-title">Dados do cliente</h3>
                        <ul class="list">
                            <li><strong>Nome:</strong> {{ $order->name }}</li>
                            <li><strong>E-mail:</strong> {{ $order->email }}</li>
                            @if($order->cpf)
                            <li><strong>CPF:</strong> {{ $order->cpf }}</li>
                            @endif
                            @if($order->whatsapp)
                            <li><strong>WhatsApp:</strong> {{ $order->whatsapp }}</li>
                            @endif
                            @if($order->notes)
                            <li><strong>Observações:</strong> {{ $order->notes }}</li>
                            @endif
                        </ul>
                    </div>
                    <div>
                        <h3 class="section-title">Resumo</h3>
                        <ul class="list">
                            @foreach($order->items as $item)
                            <li>{{ $item->name }} x{{ $item->quantity }} — R$ {{ number_format($item->price, 2, ',', '.') }}</li>
                            @endforeach
                        </ul>
                        <div class="total mt-4">Total: <strong>R$ {{ number_format($order->total, 2, ',', '.') }}</strong></div>
                    </div>
                </div>

                <div class="actions mt-6">
                    <a href="{{ route('systems.index') }}" class="btn primary">Continuar navegando</a>
                    <a href="{{ route('cart.index') }}" class="btn ghost">Ver carrinho</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


