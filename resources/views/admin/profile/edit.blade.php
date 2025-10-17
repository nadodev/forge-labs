@extends('admin.layout')

@section('title', 'Editar Perfil')

@section('content')
<div class="space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.profile.index') }}" class="btn-ghost">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Voltar
        </a>
        <div>
            <h1 class="text-3xl font-bold text-white">Editar Perfil</h1>
            <p class="text-gray-400 mt-1">Atualize suas informações pessoais</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.profile.update', $profile) }}" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div>
                    <label for="title" class="block text-sm font-medium text-white mb-2">Título</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $profile->title) }}"
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="Ex: Desenvolvedor Full-Stack">
                    @error('title')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="subtitle" class="block text-sm font-medium text-white mb-2">Subtítulo</label>
                    <input type="text" id="subtitle" name="subtitle" value="{{ old('subtitle', $profile->subtitle) }}"
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="Ex: Especialista em Laravel e Vue.js">
                    @error('subtitle')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="photo_url" class="block text-sm font-medium text-white mb-2">URL da Foto</label>
                    <input type="url" id="photo_url" name="photo_url" value="{{ old('photo_url', $profile->photo_url) }}"
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="https://exemplo.com/foto.jpg">
                    @error('photo_url')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <label for="bio" class="block text-sm font-medium text-white mb-2">Biografia</label>
                    <textarea id="bio" name="bio" rows="8" 
                              class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                              placeholder="Conte um pouco sobre você, sua experiência e objetivos...">{{ old('bio', $profile->bio) }}</textarea>
                    @error('bio')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.profile.index') }}" class="btn-ghost">Cancelar</a>
            <button type="submit" class="btn-primary">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Atualizar Perfil
            </button>
        </div>
    </form>
</div>
@endsection