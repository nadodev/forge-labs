@extends('admin.layout')

@section('title', 'Nova Tag')

@section('admin')
<h1 class="page-title">Nova Tag</h1>

<form method="POST" action="{{ route('admin.tags.store') }}" class="form">
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
    <div class="grid-2">
        <div class="form-group">
            <label>Cor</label>
            <input type="text" name="color" value="{{ old('color') }}" placeholder="#6b7280">
        </div>
        <div class="form-group">
            <label class="checkbox"><input type="checkbox" name="is_active" value="1" checked> <span>Ativa</span></label>
        </div>
    </div>
    <div class="form-group">
        <label>Descrição</label>
        <textarea name="description" rows="3">{{ old('description') }}</textarea>
    </div>
    <div class="actions">
        <a href="{{ route('admin.tags.index') }}" class="btn ghost">Cancelar</a>
        <button type="submit" class="btn primary">Salvar</button>
    </div>
</form>
@endsection


