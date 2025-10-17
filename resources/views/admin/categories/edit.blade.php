@extends('admin.layout')

@section('title', 'Editar Categoria')

@section('admin')
<h1 class="page-title">Editar Categoria</h1>

<form method="POST" action="{{ route('admin.categories.update', $category) }}" class="form">
    @csrf
    @method('PUT')
    <div class="grid-2">
        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" required>
        </div>
        <div class="form-group">
            <label>Slug (opcional)</label>
            <input type="text" name="slug" value="{{ old('slug', $category->slug) }}">
        </div>
    </div>
    <div class="grid-3">
        <div class="form-group">
            <label>Ícone (emoji)</label>
            <input type="text" name="icon" value="{{ old('icon', $category->icon) }}">
        </div>
        <div class="form-group">
            <label>Cor</label>
            <input type="text" name="color" value="{{ old('color', $category->color) }}">
        </div>
        <div class="form-group">
            <label>Ordem</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order) }}">
        </div>
    </div>
    <div class="form-group">
        <label>Descrição</label>
        <textarea name="description" rows="3">{{ old('description', $category->description) }}</textarea>
    </div>
    <div class="form-group">
        <label class="checkbox"><input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}> <span>Ativa</span></label>
    </div>
    <div class="actions">
        <a href="{{ route('admin.categories.index') }}" class="btn ghost">Cancelar</a>
        <button type="submit" class="btn primary">Atualizar</button>
    </div>
</form>
@endsection


