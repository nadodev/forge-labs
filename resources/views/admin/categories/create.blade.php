@extends('admin.layout')

@section('title', 'Nova Categoria')

@section('admin')
<h1 class="page-title">Nova Categoria</h1>

<form method="POST" action="{{ route('admin.categories.store') }}" class="form">
    @csrf
    <div class="grid-2">
        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
            <label>Slug (opcional)</label>
            <input type="text" name="slug" value="{{ old('slug') }}">
        </div>
    </div>
    <div class="grid-3">
        <div class="form-group">
            <label>Ícone (emoji)</label>
            <input type="text" name="icon" value="{{ old('icon') }}">
        </div>
        <div class="form-group">
            <label>Cor</label>
            <input type="text" name="color" value="{{ old('color') }}" placeholder="#2563eb">
        </div>
        <div class="form-group">
            <label>Ordem</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}">
        </div>
    </div>
    <div class="form-group">
        <label>Descrição</label>
        <textarea name="description" rows="3">{{ old('description') }}</textarea>
    </div>
    <div class="form-group">
        <label class="checkbox"><input type="checkbox" name="is_active" value="1" checked> <span>Ativa</span></label>
    </div>
    <div class="actions">
        <a href="{{ route('admin.categories.index') }}" class="btn ghost">Cancelar</a>
        <button type="submit" class="btn primary">Salvar</button>
    </div>
</form>
@endsection


