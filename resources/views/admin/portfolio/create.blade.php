@extends('admin.layout')

@section('title', 'Novo Portfólio')

@section('admin')
<form action="{{ route('admin.portfolio.store') }}" method="POST" class="space-y-6">
  @csrf
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
      <label class="block text-white/80 mb-2">Título</label>
      <input name="title" class="w-full rounded-lg bg-white/10 border border-white/20 text-white p-3" required>
    </div>
    <div>
      <label class="block text-white/80 mb-2">Subtítulo</label>
      <input name="subtitle" class="w-full rounded-lg bg-white/10 border border-white/20 text-white p-3">
    </div>
  </div>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
      <label class="block text-white/80 mb-2">Imagem</label>
      <input name="image" class="w-full rounded-lg bg-white/10 border border-white/20 text-white p-3" placeholder="URL da imagem">
    </div>
    <div>
      <label class="block text-white/80 mb-2">Thumbnail</label>
      <input name="thumbnail" class="w-full rounded-lg bg-white/10 border border-white/20 text-white p-3" placeholder="URL do thumb">
    </div>
  </div>
  <div>
    <label class="block text-white/80 mb-2">Descrição</label>
    <textarea name="description" rows="4" class="w-full rounded-lg bg-white/10 border border-white/20 text-white p-3"></textarea>
  </div>
  <div>
    <label class="block text-white/80 mb-2">Conteúdo (HTML permitido)</label>
    <textarea name="content" rows="6" class="w-full rounded-lg bg-white/10 border border-white/20 text-white p-3"></textarea>
  </div>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div>
      <label class="block text-white/80 mb-2">Tecnologias (separadas por vírgula)</label>
      <input name="technologies[]" class="w-full rounded-lg bg-white/10 border border-white/20 text-white p-3" placeholder="Ex: Laravel, Vue, MySQL">
    </div>
    <div>
      <label class="block text-white/80 mb-2">Demo URL</label>
      <input name="demo_url" class="w-full rounded-lg bg-white/10 border border-white/20 text-white p-3" placeholder="https://">
    </div>
    <div>
      <label class="block text-white/80 mb-2">GitHub URL</label>
      <input name="github_url" class="w-full rounded-lg bg-white/10 border border-white/20 text-white p-3" placeholder="https://">
    </div>
  </div>
  <div class="flex items-center gap-6">
    <label class="inline-flex items-center gap-2 text-white/80">
      <input type="checkbox" name="is_published" value="1" checked>
      Publicado
    </label>
    <label class="inline-flex items-center gap-2 text-white/80">
      <input type="checkbox" name="is_featured" value="1">
      Destaque
    </label>
  </div>
  <div>
    <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-4 py-2 rounded-lg">Salvar</button>
  </div>
</form>
@endsection


