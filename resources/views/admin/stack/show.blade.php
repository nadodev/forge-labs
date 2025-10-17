@extends('admin.layout')

@section('title', 'Ver Tecnologia')

@section('content')
<div class="space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.stack.index') }}" class="btn-ghost">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Voltar
        </a>
        <div>
            <h1 class="text-3xl font-bold text-white">Ver Tecnologia</h1>
            <p class="text-gray-400 mt-1">Detalhes da tecnologia</p>
        </div>
    </div>

    <div class="bg-white/5 border border-white/10 rounded-lg p-6">
        <div class="flex items-start gap-6">
            <div class="text-6xl">{{ $stack->icon ?: '🔧' }}</div>
            <div class="flex-1 space-y-4">
                <div>
                    <h2 class="text-2xl font-bold text-white">{{ $stack->name }}</h2>
                    @if($stack->level)
                        @php
                            $levels = [
                                1 => 'Iniciante',
                                2 => 'Intermediário', 
                                3 => 'Avançado',
                                4 => 'Expert',
                                5 => 'Especialista'
                            ];
                        @endphp
                        <p class="text-blue-400 font-medium text-lg">Nível: {{ $levels[$stack->level] ?? $stack->level }}</p>
                    @endif
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Ordem de Exibição</label>
                        <p class="text-white">{{ $stack->sort_order }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Status</label>
                        @if($stack->is_active)
                            <span class="text-green-400 bg-green-500/10 px-2 py-1 rounded text-sm">Ativo</span>
                        @else
                            <span class="text-red-400 bg-red-500/10 px-2 py-1 rounded text-sm">Inativo</span>
                        @endif
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Criado em</label>
                        <p class="text-white">{{ $stack->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Atualizado em</label>
                        <p class="text-white">{{ $stack->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-4 mt-6 pt-6 border-t border-white/10">
            <a href="{{ route('admin.stack.edit', $stack) }}" class="btn-primary">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Editar
            </a>
        </div>
    </div>
</div>
@endsection