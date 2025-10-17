@extends('admin.layout')

@section('title', 'Editar Tag')

@section('admin')
<h1 class="page-title">Editar Tag</h1>

<form method="POST" action="{{ route('admin.tags.update', $tag) }}" class="form">
    @csrf
    @method('PUT')
    <div class="grid-2">
        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="name" value="{{ old('name', $tag->name) }}" required>
        </div>
        <div class="form-group">
            <label>Slug (opcional)</label>
            <input type="text" name="slug" value="{{ old('slug', $tag->slug) }}">
        </div>
    </div>
    <div class="grid-2">
        <div class="form-group">
            <label>Cor</label>
            <input type="text" name="color" value="{{ old('color', $tag->color) }}">
        </div>
        <div class="form-group">
            <label class="checkbox"><input type="checkbox" name="is_active" value="1" {{ old('is_active', $tag->is_active) ? 'checked' : '' }}> <span>Ativa</span></label>
        </div>
    </div>
    <div class="form-group">
        <label>Descrição</label>
        <textarea name="description" rows="3">{{ old('description', $tag->description) }}</textarea>
    </div>
    <div class="actions">
        <a href="{{ route('admin.tags.index') }}" class="btn ghost">Cancelar</a>
        <button type="submit" class="btn primary">Atualizar</button>
    </div>
</form>
@endsection


