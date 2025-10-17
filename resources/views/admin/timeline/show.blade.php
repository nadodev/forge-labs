@extends('admin.layout')

@section('title', 'Ver Item da Timeline')

@section('content')
<div class="space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.timeline.index') }}" class="btn-ghost">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Voltar
        </a>
        <div>
            <h1 class="text-3xl font-bold text-white">Ver Item da Timeline</h1>
            <p class="text-gray-400 mt-1">Detalhes do item da timeline</p>
        </div>
    </div>

    <div class="bg-white/5 border border-white/10 rounded-lg p-6">
        <div class="flex items-start gap-6">
            <div class="text-6xl">{{ $timeline->icon ?: '📅' }}</div>
            <div class="flex-1 space-y-4">
                <div>
                    <h2 class="text-2xl font-bold text-white">{{ $timeline->title }}</h2>
                    @if($timeline->subtitle)
                        <p class="text-blue-400 font-medium text-lg">{{ $timeline->subtitle }}</p>
                    @endif
                </div>

                @if($timeline->description)
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Descrição</label>
                        <p class="text-white leading-relaxed">{{ $timeline->description }}</p>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @if($timeline->date)
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Data</label>
                            <p class="text-white">{{ $timeline->date->format('d/m/Y') }}</p>
                        </div>
                    @endif

                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Ordem de Exibição</label>
                        <p class="text-white">{{ $timeline->sort_order }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Criado em</label>
                        <p class="text-white">{{ $timeline->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Atualizado em</label>
                        <p class="text-white">{{ $timeline->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-4 mt-6 pt-6 border-t border-white/10">
            <a href="{{ route('admin.timeline.edit', $timeline) }}" class="btn-primary">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Editar
            </a>
        </div>
    </div>
</div>
@endsection
