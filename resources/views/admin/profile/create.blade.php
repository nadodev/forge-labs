@extends('admin.layout')

@section('title', 'Admin - Criar Perfil')

@section('admin')
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.profile.index') }}" class="p-2 rounded-lg hover:bg-white/10 text-white/60 hover:text-white">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
    </a>
    <h1 class="text-2xl font-bold">Criar Perfil</h1>
</div>

    <form method="POST" action="{{ route('admin.profile.store') }}" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div>
                    <label for="title" class="block text-sm font-medium text-white/80 mb-2">Título</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}"
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="Ex: Desenvolvedor Full-Stack">
                    @error('title')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="subtitle" class="block text-sm font-medium text-white/80 mb-2">Subtítulo</label>
                    <input type="text" id="subtitle" name="subtitle" value="{{ old('subtitle') }}"
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="Ex: Especialista em Laravel e Vue.js">
                    @error('subtitle')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="photo_url" class="block text-sm font-medium text-white/80 mb-2">URL da Foto</label>
                    <input type="url" id="photo_url" name="photo_url" value="{{ old('photo_url') }}"
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="https://exemplo.com/foto.jpg">
                    @error('photo_url')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <label for="bio" class="block text-sm font-medium text-white/80 mb-2">Biografia</label>
                    <textarea id="bio" name="bio" rows="8" 
                              class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                              placeholder="Conte um pouco sobre você, sua experiência e objetivos...">{{ old('bio') }}</textarea>
                    @error('bio')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.profile.index') }}" class="px-4 py-2 rounded-lg border border-white/20 text-white hover:bg-white/10 transition-colors">Cancelar</a>
            <button type="submit" class="px-4 py-2 rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow hover:opacity-90">
                Criar Perfil
            </button>
        </div>
    </form>
</div>
@endsection