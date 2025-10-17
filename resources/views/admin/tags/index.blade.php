@extends('admin.layout')

@section('title', 'Admin - Tags')

@section('admin')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold">Tags</h1>
    <a href="{{ route('admin.tags.create') }}" class="px-4 py-2 rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow hover:opacity-90">Nova Tag</a>
 </div>

<div class="overflow-hidden rounded-2xl border border-white/10">
    <table class="min-w-full divide-y divide-white/10">
        <thead class="bg-white/5">
            <tr>
                <th class="px-4 py-3 text-left text-sm font-semibold text-white/80">Nome</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-white/80">Slug</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-white/80">Cor</th>
                <th class="px-4 py-3 text-right text-sm font-semibold text-white/80">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/10">
        @forelse($tags as $tag)
            <tr class="hover:bg-white/5">
                <td class="px-4 py-3">{{ $tag->name }}</td>
                <td class="px-4 py-3">{{ $tag->slug }}</td>
                <td class="px-4 py-3">
                    <span class="inline-flex items-center gap-2 text-xs px-2 py-1 rounded bg-white/10">
                        <span class="inline-block w-3 h-3 rounded" style="background-color: {{ $tag->color }}"></span>
                        {{ $tag->color }}
                    </span>
                </td>
                <td class="px-4 py-3">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.tags.edit', $tag) }}" class="px-3 py-1 rounded-lg bg-white/10 hover:bg-white/15">Editar</a>
                        <form method="POST" action="{{ route('admin.tags.destroy', $tag) }}" onsubmit="return confirm('Remover?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 rounded-lg bg-red-500/20 text-red-200 hover:bg-red-500/30">Excluir</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="px-4 py-12 text-center text-white/60">Nenhuma tag cadastrada.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">{{ $tags->links() }}</div>
@endsection


