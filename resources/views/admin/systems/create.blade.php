@extends('admin.layout')

@section('title', 'Novo Sistema')

@section('admin')
<h1 class="page-title">Novo Sistema</h1>

<form method="POST" action="{{ route('admin.systems.store') }}" class="form">
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
    <div class="form-group">
        <label>Descrição</label>
        <textarea name="description" rows="4" required>{{ old('description') }}</textarea>
    </div>
    <div class="form-group">
        <label>Descrição Completa</label>
        <textarea name="full_description" rows="8" placeholder="Descrição detalhada do sistema...">{{ old('full_description') }}</textarea>
    </div>
    <div class="grid-3">
        <div class="form-group">
            <label>Categoria</label>
            <select name="category_id" required>
                @foreach($categories as $c)
                <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Tipo de licença</label>
            <select name="license_type" required>
                <option value="free">Gratuito</option>
                <option value="paid">Pago</option>
                <option value="saas">SaaS</option>
                <option value="open_source">Código Aberto</option>
            </select>
        </div>
        <div class="form-group">
            <label>Status</label>
            <select name="status" required>
                <option value="active">Ativo</option>
                <option value="development">Em desenvolvimento</option>
                <option value="beta">Beta</option>
                <option value="hidden">Oculto</option>
            </select>
        </div>
    </div>
    <div class="grid-3">
        <div class="form-group">
            <label>Preço</label>
            <input type="number" step="0.01" name="price" value="{{ old('price') }}">
        </div>
        <div class="form-group">
            <label>Destaque?</label>
            <label class="checkbox"><input type="checkbox" name="is_featured" value="1"> <span>Sim</span></label>
        </div>
        <div class="form-group">
            <label>Tags</label>
            <div class="chips">
                @foreach($tags as $t)
                <label class="chip">
                    <input type="checkbox" name="tags[]" value="{{ $t->id }}"> {{ $t->name }}
                </label>
                @endforeach
            </div>
        </div>
    </div>
    <div class="actions">
        <a href="{{ route('admin.systems.index') }}" class="btn ghost">Cancelar</a>
        <button type="submit" class="btn primary">Salvar</button>
    </div>
</form>
@endsection


