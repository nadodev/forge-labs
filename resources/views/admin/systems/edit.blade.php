@extends('admin.layout')

@section('title', 'Editar Sistema')

@section('admin')
<h1 class="page-title">Editar Sistema</h1>

<form method="POST" action="{{ route('admin.systems.update', $system) }}" class="form">
    @csrf
    @method('PUT')
    <div class="grid-2">
        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="name" value="{{ old('name', $system->name) }}" required>
        </div>
        <div class="form-group">
            <label>Slug (opcional)</label>
            <input type="text" name="slug" value="{{ old('slug', $system->slug) }}">
        </div>
    </div>
    <div class="form-group">
        <label>Descrição</label>
        <textarea name="description" rows="4" required>{{ old('description', $system->description) }}</textarea>
    </div>
    <div class="form-group">
        <label>Descrição Completa</label>
        <textarea name="full_description" rows="8" placeholder="Descrição detalhada do sistema...">{{ old('full_description', $system->full_description) }}</textarea>
    </div>
    <div class="form-group">
        <label>Recursos (um por linha)</label>
        <textarea name="features" rows="6" placeholder="Ex: Sistema de autenticação&#10;Dashboard administrativo&#10;API REST completa">{{ old('features', is_array($system->features) ? implode("\n", $system->features) : '') }}</textarea>
        <small class="form-help">Digite cada recurso em uma linha separada</small>
    </div>
    <div class="form-group">
        <label>Tecnologias (uma por linha)</label>
        <textarea name="technologies" rows="4" placeholder="Ex: Laravel&#10;Vue.js&#10;MySQL&#10;Bootstrap">{{ old('technologies', is_array($system->technologies) ? implode("\n", $system->technologies) : '') }}</textarea>
        <small class="form-help">Digite cada tecnologia em uma linha separada</small>
    </div>
    <div class="grid-3">
        <div class="form-group">
            <label>Categoria</label>
            <select name="category_id" required>
                @foreach($categories as $c)
                <option value="{{ $c->id }}" {{ $c->id == old('category_id', $system->category_id) ? 'selected' : '' }}>{{ $c->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Tipo de licença</label>
            <select name="license_type" required>
                @foreach(['free'=>'Gratuito','paid'=>'Pago','saas'=>'SaaS','open_source'=>'Código Aberto'] as $k=>$label)
                <option value="{{ $k }}" {{ old('license_type', $system->license_type) == $k ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Status</label>
            <select name="status" required>
                @foreach(['active'=>'Ativo','development'=>'Em desenvolvimento','beta'=>'Beta','hidden'=>'Oculto'] as $k=>$label)
                <option value="{{ $k }}" {{ old('status', $system->status) == $k ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="grid-3">
        <div class="form-group">
            <label>Preço</label>
            <input type="number" step="0.01" name="price" value="{{ old('price', $system->price) }}">
        </div>
        <div class="form-group">
            <label>Destaque?</label>
            <label class="checkbox"><input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $system->is_featured) ? 'checked' : '' }}> <span>Sim</span></label>
        </div>
        <div class="form-group">
            <label>Tags</label>
            <div class="chips">
                @foreach($tags as $t)
                <label class="chip">
                    <input type="checkbox" name="tags[]" value="{{ $t->id }}" {{ in_array($t->id, old('tags', $selectedTags)) ? 'checked' : '' }}> {{ $t->name }}
                </label>
                @endforeach
            </div>
        </div>
    </div>
    <div class="actions">
        <a href="{{ route('admin.systems.index') }}" class="btn ghost">Cancelar</a>
        <button type="submit" class="btn primary">Atualizar</button>
    </div>
</form>
@endsection


