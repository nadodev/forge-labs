@extends('admin.layout')

@section('title', 'Editar Tecnologia')

@section('content')
<div class="space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.stack.index') }}" class="btn-ghost">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Voltar
        </a>
        <div>
            <h1 class="text-3xl font-bold text-white">Editar Tecnologia</h1>
            <p class="text-gray-400 mt-1">Atualize as informações da tecnologia</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.stack.update', $stack) }}" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-white mb-2">Nome da Tecnologia *</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $stack->name) }}" required
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('name')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="icon" class="block text-sm font-medium text-white mb-2">Ícone</label>
                    <x-icon-selector name="icon" value="{{ old('icon', $stack->icon) }}" />
                    @error('icon')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="level" class="block text-sm font-medium text-white mb-2">Nível de Proficiência</label>
                    <select id="level" name="level" 
                            class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Selecione o nível</option>
                        <option value="1" {{ old('level', $stack->level) == '1' ? 'selected' : '' }}>Iniciante</option>
                        <option value="2" {{ old('level', $stack->level) == '2' ? 'selected' : '' }}>Intermediário</option>
                        <option value="3" {{ old('level', $stack->level) == '3' ? 'selected' : '' }}>Avançado</option>
                        <option value="4" {{ old('level', $stack->level) == '4' ? 'selected' : '' }}>Expert</option>
                        <option value="5" {{ old('level', $stack->level) == '5' ? 'selected' : '' }}>Especialista</option>
                    </select>
                    @error('level')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-white mb-2">Ordem de Exibição</label>
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $stack->sort_order) }}"
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('sort_order')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="flex items-center gap-3">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $stack->is_active) ? 'checked' : '' }}
                               class="w-4 h-4 text-blue-600 bg-white/5 border-white/10 rounded focus:ring-blue-500 focus:ring-2">
                        <span class="text-white">Tecnologia ativa</span>
                    </label>
                    @error('is_active')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.stack.index') }}" class="btn-ghost">Cancelar</a>
            <button type="submit" class="btn-primary">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Atualizar Tecnologia
            </button>
        </div>
    </form>
</div>
@endsection