@extends('admin.layout')

@section('title', 'Admin - Certificados')

@section('admin')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold">Certificados</h1>
    <a href="{{ route('admin.certificates.create') }}" class="px-4 py-2 rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow hover:opacity-90">Novo Certificado</a>
</div>

@if(session('success'))
    <div class="mb-4 rounded-lg border border-emerald-500/20 bg-emerald-500/10 text-emerald-200 p-3 text-sm">
        {{ session('success') }}
    </div>
@endif

<div class="overflow-hidden rounded-2xl border border-white/10">
    @if($certificates->count() > 0)
        <div class="divide-y divide-white/10">
            @foreach($certificates as $certificate)
                <div class="p-6 hover:bg-white/5 transition-colors">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start gap-4">
                            <div class="text-3xl">{{ $certificate->icon ?: '🏆' }}</div>
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-white">{{ $certificate->title }}</h3>
                                @if($certificate->issuer)
                                    <p class="text-blue-400 font-medium text-sm">{{ $certificate->issuer }}</p>
                                @endif
                                @if($certificate->issued_at)
                                    <p class="text-white/60 text-sm">{{ $certificate->issued_at->format('d/m/Y') }}</p>
                                @endif
                                @if($certificate->url)
                                    <a href="{{ $certificate->url }}" target="_blank" class="text-blue-400 hover:text-blue-300 text-sm inline-flex items-center gap-1 mt-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                        </svg>
                                        Ver certificado
                                    </a>
                                @endif
                                <span class="text-xs text-white/40 bg-white/10 px-2 py-1 rounded mt-2 inline-block">Ordem: {{ $certificate->sort_order }}</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.certificates.show', $certificate) }}" class="p-2 rounded-lg hover:bg-white/10 text-white/60 hover:text-white">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </a>
                            <a href="{{ route('admin.certificates.edit', $certificate) }}" class="p-2 rounded-lg hover:bg-white/10 text-white/60 hover:text-white">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            <form method="POST" action="{{ route('admin.certificates.destroy', $certificate) }}" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir este certificado?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 rounded-lg hover:bg-red-500/20 text-white/60 hover:text-red-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-12">
            <div class="text-6xl mb-4">🏆</div>
            <h3 class="text-xl font-semibold text-white mb-2">Nenhum certificado encontrado</h3>
            <p class="text-white/60 mb-6">Comece adicionando seu primeiro certificado</p>
            <a href="{{ route('admin.certificates.create') }}" class="px-4 py-2 rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow hover:opacity-90">
                Adicionar Certificado
            </a>
        </div>
    @endif
</div>
@endsection
