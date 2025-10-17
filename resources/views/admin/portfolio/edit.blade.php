@extends('admin.layout')

@section('title', 'Editar Portfólio')

@section('admin')
<form action="{{ route('admin.portfolio.update', $portfolio) }}" method="POST" class="space-y-6">
  @csrf
  @method('PUT')
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
      <label class="block text-white/80 mb-2">Título</label>
      <input name="title" class="w-full rounded-lg bg-white/10 border border-white/20 text-white p-3" required value="{{ $portfolio->title }}">
    </div>
    <div>
      <label class="block text-white/80 mb-2">Subtítulo</label>
      <input name="subtitle" class="w-full rounded-lg bg-white/10 border border-white/20 text-white p-3" value="{{ $portfolio->subtitle }}">
    </div>
  </div>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
      <label class="block text-white/80 mb-2">Imagem</label>
      <input name="image" class="w-full rounded-lg bg-white/10 border border-white/20 text-white p-3" value="{{ $portfolio->image }}">
    </div>
    <div>
      <label class="block text-white/80 mb-2">Thumbnail</label>
      <input name="thumbnail" class="w-full rounded-lg bg-white/10 border border-white/20 text-white p-3" value="{{ $portfolio->thumbnail }}">
    </div>
  </div>
  <div>
    <label class="block text-white/80 mb-2">Descrição</label>
    <textarea name="description" rows="4" class="w-full rounded-lg bg-white/10 border border-white/20 text-white p-3">{{ $portfolio->description }}</textarea>
  </div>
  <div>
    <label class="block text-white/80 mb-2">Conteúdo (HTML permitido)</label>
    <textarea name="content" rows="6" class="w-full rounded-lg bg-white/10 border border-white/20 text-white p-3">{{ $portfolio->content }}</textarea>
  </div>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div>
      <label class="block text-white/80 mb-2">Tecnologias (separadas por vírgula)</label>
      <input name="technologies[]" class="w-full rounded-lg bg-white/10 border border-white/20 text-white p-3" value="{{ implode(', ', (array)$portfolio->technologies) }}">
    </div>
    <div>
      <label class="block text-white/80 mb-2">Demo URL</label>
      <input name="demo_url" class="w-full rounded-lg bg-white/10 border border-white/20 text-white p-3" value="{{ $portfolio->demo_url }}">
    </div>
    <div>
      <label class="block text-white/80 mb-2">GitHub URL</label>
      <input name="github_url" class="w-full rounded-lg bg-white/10 border border-white/20 text-white p-3" value="{{ $portfolio->github_url }}">
    </div>
  </div>
  <div class="flex items-center gap-6">
    <label class="inline-flex items-center gap-2 text-white/80">
      <input type="checkbox" name="is_published" value="1" {{ $portfolio->is_published ? 'checked' : '' }}>
      Publicado
    </label>
    <label class="inline-flex items-center gap-2 text-white/80">
      <input type="checkbox" name="is_featured" value="1" {{ $portfolio->is_featured ? 'checked' : '' }}>
      Destaque
    </label>
  </div>
  <div>
    <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-4 py-2 rounded-lg">Salvar</button>
  </div>
</form>
@endsection


