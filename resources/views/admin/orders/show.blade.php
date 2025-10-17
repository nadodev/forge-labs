@extends('admin.layout')

@section('title', 'Detalhes do Pedido')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Pedido #{{ $order->id }}</h1>
                        <p class="mt-1 text-sm text-gray-600">
                            Criado em {{ $order->created_at->format('d/m/Y H:i') }}
                        </p>
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold text-gray-900">
                            R$ {{ number_format($order->total_amount, 2, ',', '.') }}
                        </div>
                        @php
                            $statusColors = [
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'paid' => 'bg-green-100 text-green-800',
                                'shipped' => 'bg-blue-100 text-blue-800',
                                'delivered' => 'bg-green-100 text-green-800',
                                'cancelled' => 'bg-red-100 text-red-800'
                            ];
                            $statusLabels = [
                                'pending' => 'Pendente',
                                'paid' => 'Pago',
                                'shipped' => 'Enviado',
                                'delivered' => 'Entregue',
                                'cancelled' => 'Cancelado'
                            ];
                        @endphp
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full {{ $statusColors[$order->payment_status] ?? 'bg-gray-100 text-gray-800' }}">
                            {{ $statusLabels[$order->payment_status] ?? ucfirst($order->payment_status) }}
                        </span>
                    </div>
                </div>
            </div>

            @if(session('success'))
            <div class="mx-6 mt-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
            @endif

            <div class="px-6 py-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Informações do Cliente -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informações do Cliente</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <dl class="space-y-3">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Nome</dt>
                                    <dd class="text-sm text-gray-900">
                                        {{ $order->customer_name ?? $order->user->name ?? 'Anônimo' }}
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">E-mail</dt>
                                    <dd class="text-sm text-gray-900">
                                        {{ $order->customer_email ?? $order->user->email ?? 'N/A' }}
                                    </dd>
                                </div>
                                @if($order->customer_cpf)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">CPF</dt>
                                    <dd class="text-sm text-gray-900">{{ $order->customer_cpf }}</dd>
                                </div>
                                @endif
                                @if($order->customer_whatsapp)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">WhatsApp</dt>
                                    <dd class="text-sm text-gray-900">{{ $order->customer_whatsapp }}</dd>
                                </div>
                                @endif
                                @if($order->user)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Usuário</dt>
                                    <dd class="text-sm text-gray-900">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Logado
                                        </span>
                                    </dd>
                                </div>
                                @endif
                            </dl>
                        </div>
                    </div>

                    <!-- Informações do Pagamento -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informações do Pagamento</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <dl class="space-y-3">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                                    <dd class="text-sm">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $statusColors[$order->payment_status] ?? 'bg-gray-100 text-gray-800' }}">
                                            {{ $statusLabels[$order->payment_status] ?? ucfirst($order->payment_status) }}
                                        </span>
                                    </dd>
                                </div>
                                @if($order->stripe_session_id)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Stripe Session ID</dt>
                                    <dd class="text-sm text-gray-900 font-mono">{{ $order->stripe_session_id }}</dd>
                                </div>
                                @endif
                                @if($order->paid_at)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Pago em</dt>
                                    <dd class="text-sm text-gray-900">{{ $order->paid_at->format('d/m/Y H:i') }}</dd>
                                </div>
                                @endif
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Total</dt>
                                    <dd class="text-lg font-semibold text-gray-900">
                                        R$ {{ number_format($order->total_amount, 2, ',', '.') }}
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>

                <!-- Itens do Pedido -->
                <div class="mt-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Itens do Pedido</h3>
                    <div class="bg-gray-50 rounded-lg overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Sistema
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Preço Unitário
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Quantidade
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Subtotal
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($order->items as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $item->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        R$ {{ number_format($item->price, 2, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $item->quantity }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        R$ {{ number_format($item->price * $item->quantity, 2, ',', '.') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Observações -->
                @if($order->notes)
                <div class="mt-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Observações</h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-sm text-gray-900">{{ $order->notes }}</p>
                    </div>
                </div>
                @endif

                <!-- Ações -->
                <div class="mt-8 flex justify-between">
                    <a href="{{ route('admin.orders.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                        Voltar
                    </a>
                    <form method="POST" action="{{ route('admin.orders.update-status', $order) }}" class="flex items-center space-x-4">
                        @csrf
                        @method('PATCH')
                        <label for="status" class="text-sm font-medium text-gray-700">Alterar Status:</label>
                        <select name="status" id="status" class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="pending" {{ $order->payment_status === 'pending' ? 'selected' : '' }}>Pendente</option>
                            <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>Pago</option>
                            <option value="shipped" {{ $order->payment_status === 'shipped' ? 'selected' : '' }}>Enviado</option>
                            <option value="delivered" {{ $order->payment_status === 'delivered' ? 'selected' : '' }}>Entregue</option>
                            <option value="cancelled" {{ $order->payment_status === 'cancelled' ? 'selected' : '' }}>Cancelado</option>
                        </select>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                            Atualizar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
