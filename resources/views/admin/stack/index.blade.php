@extends('admin.layout')

@section('title', 'Admin - Stack Tecnológica')

@section('admin')
<div class="flex items-center gap-4 mb-6">
    <h1 class="text-2xl font-bold">Stack Tecnológica</h1>
    <a href="{{ route('admin.stack.create') }}" class="ml-auto px-4 py-2 rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow hover:opacity-90">
        Adicionar Tecnologia
    </a>
</div>


    @if($stack->count() > 0)
        <div class="grid gap-4">
            @foreach($stack as $item)
                <div class="bg-white/5 border border-white/10 rounded-lg p-6 hover:bg-white/10 transition-colors">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start gap-4">
                            <div class="text-3xl">{{ $item->icon ?: '🔧' }}</div>
                            <div class="flex-1">
                                <h3 class="text-xl font-semibold text-white">{{ $item->name }}</h3>
                                @if($item->level)
                                    <p class="text-blue-400 font-medium">Nível: {{ $item->level }}</p>
                                @endif
                                <div class="flex items-center gap-4 mt-2">
                                    <span class="text-xs text-gray-400 bg-gray-800 px-2 py-1 rounded">Ordem: {{ $item->sort_order }}</span>
                                    @if($item->is_active)
                                        <span class="text-xs text-green-400 bg-green-500/10 px-2 py-1 rounded">Ativo</span>
                                    @else
                                        <span class="text-xs text-red-400 bg-red-500/10 px-2 py-1 rounded">Inativo</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.stack.show', $item) }}" class="p-2 rounded-lg hover:bg-white/10 text-white/60 hover:text-white">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                                <a href="{{ route('admin.stack.edit', $item) }}" class="p-2 rounded-lg hover:bg-white/10 text-white/60 hover:text-white">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('admin.stack.destroy', $item) }}" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir esta tecnologia?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-lg hover:bg-white/10 text-red-400 hover:text-red-300">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-12">
            <div class="text-6xl mb-4">🔧</div>
            <h3 class="text-xl font-semibold text-white mb-2">Nenhuma tecnologia encontrada</h3>
            <p class="text-white/60 mb-6">Comece adicionando sua primeira tecnologia</p>
            <a href="{{ route('admin.stack.create') }}" class="px-4 py-2 rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow hover:opacity-90">
                Adicionar Tecnologia
            </a>
        </div>
    @endif
</div>
@endsection