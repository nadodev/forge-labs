@extends('admin.layout')

@section('title', 'Ver Perfil')

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
            <h1 class="text-3xl font-bold text-white">Ver Perfil</h1>
            <p class="text-gray-400 mt-1">Detalhes do perfil</p>
        </div>
    </div>

    <div class="bg-white/5 border border-white/10 rounded-lg p-6">
        <div class="flex items-start gap-6">
            @if($profile->photo_url)
                <img src="{{ $profile->photo_url }}" alt="Foto do perfil" class="w-32 h-32 rounded-full object-cover border-2 border-white/10">
            @else
                <div class="w-32 h-32 rounded-full bg-white/10 border-2 border-white/10 flex items-center justify-center">
                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
            @endif
            <div class="flex-1 space-y-4">
                <div>
                    <h2 class="text-3xl font-bold text-white">{{ $profile->title ?: 'Sem título' }}</h2>
                    <p class="text-blue-400 font-medium text-xl">{{ $profile->subtitle ?: 'Sem subtítulo' }}</p>
                </div>

                @if($profile->bio)
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Biografia</label>
                        <p class="text-white leading-relaxed text-lg">{{ $profile->bio }}</p>
                    </div>
                @endif

                @if($profile->photo_url)
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">URL da Foto</label>
                        <a href="{{ $profile->photo_url }}" target="_blank" class="text-blue-400 hover:text-blue-300 inline-flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                            {{ $profile->photo_url }}
                        </a>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Criado em</label>
                        <p class="text-white">{{ $profile->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Atualizado em</label>
                        <p class="text-white">{{ $profile->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-4 mt-6 pt-6 border-t border-white/10">
            <a href="{{ route('admin.profile.edit', $profile) }}" class="btn-primary">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Editar
            </a>
        </div>
    </div>
</div>
@endsection