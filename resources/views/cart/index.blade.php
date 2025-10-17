@extends('layouts.app')

@section('title', 'Carrinho - Geja Systems')

@section('content')
<section class="section">
    <div class="container">
        <h1 class="page-title">Seu carrinho</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @if(!count($cart))
            <div class="empty-state">
                <h3>Seu carrinho está vazio</h3>
                <p>Explore os sistemas e adicione itens para continuar.</p>
            </div>
        @else
            <div class="details-layout">
                <div class="details-content">
                    <div class="cards card-cart">
                        @foreach($cart as $item)
                        <div class="card">
                            <div class="card-content">
                                <div class="card-header">
                                    <div class="card-badge">Sistema</div>
                                    <h3 class="card-title">{{ $item['name'] }}</h3>
                                </div>
                                <div class="cart-row">
                                    <div class="cart-col">
                                        <div class="muted">Preço unitário</div>
                                        <div class="price">R$ {{ number_format($item['price'], 2, ',', '.') }}</div>
                                    </div>
                                    <div class="cart-col">
                                        <div class="muted">Quantidade</div>
                                        <form method="POST" action="{{ route('cart.update', $item['id']) }}" class="inline-form">
                                            @csrf
                                            <input type="number" name="quantity" min="1" max="99" value="{{ $item['quantity'] }}" class="qty-input">
                                            <button class="btn ghost small">Atualizar</button>
                                        </form>
                                    </div>
                                    <div class="cart-col">
                                        <div class="muted">Subtotal</div>
                                        <div class="price">R$ {{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }}</div>
                                    </div>
                                    <div class="cart-col actions">
                                        <form method="POST" action="{{ route('cart.remove', $item['id']) }}">
                                            @csrf
                                            <button class="btn danger small">Remover</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <aside class="details-aside">
                    <div class="sticky-box">
                        <div class="pricing-section">
                            <div class="muted">Total</div>
                            <div class="price">R$ {{ number_format($total, 2, ',', '.') }}</div>
                        </div>

                        <form method="POST" action="{{ route('stripe.checkout') }}" class="checkout-form">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name ?? '') }}" required placeholder="Seu nome completo">
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" required placeholder="voce@exemplo.com">
                            </div>
                            <div class="form-group">
                                <label for="cpf">CPF</label>
                                <input type="text" id="cpf" name="cpf" value="{{ old('cpf') }}" placeholder="000.000.000-00">
                            </div>
                            <div class="form-group">
                                <label for="whatsapp">WhatsApp (opcional)</label>
                                <input type="text" id="whatsapp" name="whatsapp" value="{{ old('whatsapp') }}" placeholder="11999999999">
                            </div>
                            <div class="form-group">
                                <label for="notes">Observações (opcional)</label>
                                <textarea id="notes" name="notes" rows="3" placeholder="Informações para o pedido">{{ old('notes') }}</textarea>
                            </div>
                            <div class="actions" style="display:flex; gap:12px; align-items:center;">
                                <button type="submit" class="btn primary" style="flex:1;">Pagar com Stripe</button>
                                <form method="POST" action="{{ route('cart.clear') }}">
                                    @csrf
                                    <button type="submit" class="btn ghost">Limpar</button>
                                </form>
                            </div>
                        </form>
                    </div>
                </aside>
            </div>
        @endif
    </div>
</section>
@endsection


