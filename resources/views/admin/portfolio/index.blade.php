@extends('admin.layout')

@section('title', 'Portfólio')

@section('admin')
<div class="flex items-center justify-between mb-6">
  <h2 class="text-xl font-semibold text-white">Itens do Portfólio</h2>
  <a href="{{ route('admin.portfolio.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-4 py-2 rounded-lg">Novo</a>
  </div>

<div class="overflow-x-auto bg-white/5 border border-white/10 rounded-xl">
  <table class="min-w-full">
    <thead>
      <tr class="text-left text-white/70">
        <th class="px-4 py-3">Título</th>
        <th class="px-4 py-3">Publicado</th>
        <th class="px-4 py-3">Destaque</th>
        <th class="px-4 py-3">Criado em</th>
        <th class="px-4 py-3">Ações</th>
      </tr>
    </thead>
    <tbody>
      @forelse($items as $item)
      <tr class="border-t border-white/10 text-white/90">
        <td class="px-4 py-3 font-medium">{{ $item->title }}</td>
        <td class="px-4 py-3">{{ $item->is_published ? 'Sim' : 'Não' }}</td>
        <td class="px-4 py-3">{{ $item->is_featured ? 'Sim' : 'Não' }}</td>
        <td class="px-4 py-3">{{ $item->created_at->format('d/m/Y') }}</td>
        <td class="px-4 py-3 space-x-2">
          <a href="{{ route('admin.portfolio.edit', $item) }}" class="text-indigo-400 hover:text-indigo-300">Editar</a>
          <form action="{{ route('admin.portfolio.destroy', $item) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button class="text-red-400 hover:text-red-300" onclick="return confirm('Remover?')">Remover</button>
          </form>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="5" class="px-4 py-6 text-center text-white/70">Nenhum item</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>

<div class="mt-4 text-white/70">{{ $items->links() }}</div>
@endsection


