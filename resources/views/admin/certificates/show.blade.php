@extends('admin.layout')

@section('title', 'Admin - Ver Certificado')

@section('admin')
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.certificates.index') }}" class="p-2 rounded-lg hover:bg-white/10 text-white/60 hover:text-white">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
    </a>
    <h1 class="text-2xl font-bold">Ver Certificado</h1>
</div>

<div class="bg-white/5 border border-white/10 rounded-lg p-6">
    <div class="flex items-start gap-6">
        <div class="text-6xl">{{ $certificate->icon ?: '🏆' }}</div>
        <div class="flex-1 space-y-4">
            <div>
                <h2 class="text-2xl font-bold text-white">{{ $certificate->title }}</h2>
                @if($certificate->issuer)
                    <p class="text-blue-400 font-medium text-lg">{{ $certificate->issuer }}</p>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @if($certificate->issued_at)
                    <div>
                        <label class="block text-sm font-medium text-white/60 mb-1">Data de Emissão</label>
                        <p class="text-white">{{ $certificate->issued_at->format('d/m/Y') }}</p>
                    </div>
                @endif

                <div>
                    <label class="block text-sm font-medium text-white/60 mb-1">Ordem de Exibição</label>
                    <p class="text-white">{{ $certificate->sort_order }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-white/60 mb-1">Criado em</label>
                    <p class="text-white">{{ $certificate->created_at->format('d/m/Y H:i') }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-white/60 mb-1">Atualizado em</label>
                    <p class="text-white">{{ $certificate->updated_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>

            @if($certificate->url)
                <div>
                    <label class="block text-sm font-medium text-white/60 mb-1">URL do Certificado</label>
                    <a href="{{ $certificate->url }}" target="_blank" class="text-blue-400 hover:text-blue-300 inline-flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        {{ $certificate->url }}
                    </a>
                </div>
            @endif
        </div>
    </div>

    <div class="flex justify-end gap-4 mt-6 pt-6 border-t border-white/10">
        <a href="{{ route('admin.certificates.edit', $certificate) }}" class="px-4 py-2 rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow hover:opacity-90">
            Editar
        </a>
    </div>
</div>
@endsection
