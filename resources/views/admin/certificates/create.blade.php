@extends('admin.layout')

@section('title', 'Admin - Adicionar Certificado')

@section('admin')
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.certificates.index') }}" class="p-2 rounded-lg hover:bg-white/10 text-white/60 hover:text-white">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
    </a>
    <h1 class="text-2xl font-bold">Adicionar Certificado</h1>
</div>

<form method="POST" action="{{ route('admin.certificates.store') }}" class="space-y-6">
    @csrf
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="space-y-4">
            <div>
                <label for="title" class="block text-sm font-medium text-white/80 mb-2">Título *</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required
                       class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('title')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="issuer" class="block text-sm font-medium text-white/80 mb-2">Emissor</label>
                <input type="text" id="issuer" name="issuer" value="{{ old('issuer') }}"
                       class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('issuer')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="icon" class="block text-sm font-medium text-white/80 mb-2">Ícone</label>
                <x-icon-selector name="icon" value="{{ old('icon') }}" />
                @error('icon')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="space-y-4">
            <div>
                <label for="url" class="block text-sm font-medium text-white/80 mb-2">URL do Certificado</label>
                <input type="url" id="url" name="url" value="{{ old('url') }}"
                       class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('url')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="issued_at" class="block text-sm font-medium text-white/80 mb-2">Data de Emissão</label>
                <input type="date" id="issued_at" name="issued_at" value="{{ old('issued_at') }}"
                       class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('issued_at')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="sort_order" class="block text-sm font-medium text-white/80 mb-2">Ordem de Exibição</label>
                <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', 1) }}"
                       class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('sort_order')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <div class="flex justify-end gap-4">
        <a href="{{ route('admin.certificates.index') }}" class="px-4 py-2 rounded-lg border border-white/20 text-white hover:bg-white/10 transition-colors">Cancelar</a>
        <button type="submit" class="px-4 py-2 rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow hover:opacity-90">
            Salvar Certificado
        </button>
    </div>
</form>
@endsection
