@extends('admin.layout')

@section('title', 'Admin - Perfil')

@section('admin')
<div class="flex items-center gap-4 mb-6">
    <h1 class="text-2xl font-bold">Perfil</h1>
    @if(!$profile)
        <a href="{{ route('admin.profile.create') }}" class="ml-auto px-4 py-2 rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow hover:opacity-90">
            Criar Perfil
        </a>
    @endif
</div>


    @if($profile)
        <div class="bg-white/5 border border-white/10 rounded-lg p-6">
            <div class="flex items-start gap-6">
                @if($about->photo_url)
                    <img src="{{ $about->photo_url }}" alt="Foto do perfil" class="w-24 h-24 rounded-full object-cover border-2 border-white/10">
                @else
                    <div class="w-24 h-24 rounded-full bg-white/10 border-2 border-white/10 flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                @endif
                <div class="flex-1 space-y-4">
                    <div>
                        <h2 class="text-2xl font-bold text-white">{{ $about->title ?: 'Sem título' }}</h2>
                        <p class="text-blue-400 font-medium text-lg">{{ $about->subtitle ?: 'Sem subtítulo' }}</p>
                    </div>

                    @if($about->bio)
                    <div>
                        <label class="block text-sm font-medium text-white/60 mb-2">Biografia</label>
                        <p class="text-white leading-relaxed">{{ $about->bio }}</p>
                    </div>
                    @endif

                    @if($about->photo_url)
                        <div>
                            <label class="block text-sm font-medium text-white/60 mb-2">URL da Foto</label>
                            <a href="{{ $about->photo_url }}" target="_blank" class="text-blue-400 hover:text-blue-300 inline-flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                                {{ $about->photo_url }}
                            </a>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-white/60 mb-1">Criado em</label>
                            <p class="text-white">{{ $about->created_at->format('d/m/Y H:i') }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-white/60 mb-1">Atualizado em</label>
                            <p class="text-white">{{ $about->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-4 mt-6 pt-6 border-t border-white/10">
                <a href="{{ route('admin.profile.edit', $about) }}" class="px-4 py-2 rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow hover:opacity-90">
                    Editar Perfil
                </a>
            </div>
        </div>
    @else
        <div class="text-center py-12">
            <div class="text-6xl mb-4">👤</div>
            <h3 class="text-xl font-semibold text-white mb-2">Nenhum perfil encontrado</h3>
            <p class="text-white/60 mb-6">Crie seu perfil para começar</p>
            <a href="{{ route('admin.profile.create') }}" class="px-4 py-2 rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow hover:opacity-90">
                Criar Perfil
            </a>
        </div>
    @endif
</div>
@endsection