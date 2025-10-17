@extends('admin.layout')

@section('title', 'Admin - Timeline')

@section('admin')
<div class="flex items-center gap-4 mb-6">
    <h1 class="text-2xl font-bold">Timeline</h1>
    <a href="{{ route('admin.timeline.create') }}" class="ml-auto px-4 py-2 rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow hover:opacity-90">
        Adicionar Item
    </a>
</div>


    @if($timeline->count() > 0)
        <div class="grid gap-4">
            @foreach($timeline as $item)
                <div class="bg-white/5 border border-white/10 rounded-lg p-6 hover:bg-white/10 transition-colors">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start gap-4">
                            <div class="text-3xl">{{ $item->icon ?: '📅' }}</div>
                            <div class="flex-1">
                                <h3 class="text-xl font-semibold text-white">{{ $item->title }}</h3>
                                @if($item->subtitle)
                                    <p class="text-blue-400 font-medium">{{ $item->subtitle }}</p>
                                @endif
                                @if($item->date)
                                    <p class="text-gray-400 text-sm">{{ $item->date->format('d/m/Y') }}</p>
                                @endif
                                @if($item->description)
                                    <p class="text-gray-300 mt-2">{{ Str::limit($item->description, 150) }}</p>
                                @endif
                                <div class="flex items-center gap-4 mt-2">
                                    <span class="text-xs text-gray-400 bg-gray-800 px-2 py-1 rounded">Ordem: {{ $item->sort_order }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.timeline.show', $item) }}" class="p-2 rounded-lg hover:bg-white/10 text-white/60 hover:text-white">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                                <a href="{{ route('admin.timeline.edit', $item) }}" class="p-2 rounded-lg hover:bg-white/10 text-white/60 hover:text-white">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('admin.timeline.destroy', $item) }}" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir este item da timeline?')">
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
            <div class="text-6xl mb-4">📅</div>
            <h3 class="text-xl font-semibold text-white mb-2">Nenhum item encontrado</h3>
            <p class="text-white/60 mb-6">Comece adicionando seu primeiro item à timeline</p>
            <a href="{{ route('admin.timeline.create') }}" class="px-4 py-2 rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow hover:opacity-90">
                Adicionar Item
            </a>
        </div>
    @endif
</div>
@endsection
