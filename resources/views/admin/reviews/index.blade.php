@extends('admin.layout')

@section('title', 'Admin - Avaliações')

@section('admin')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold">Avaliações</h1>
 </div>

<div class="overflow-hidden rounded-2xl border border-white/10">
    <table class="min-w-full divide-y divide-white/10">
        <thead class="bg-white/5">
            <tr>
                <th class="px-4 py-3 text-left text-sm font-semibold text-white/80">Autor</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-white/80">Sistema</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-white/80">Nota</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-white/80">Status</th>
                <th class="px-4 py-3 text-right text-sm font-semibold text-white/80">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/10">
        @forelse($reviews as $review)
            <tr class="hover:bg-white/5">
                <td class="px-4 py-3">{{ $review->author_name }}</td>
                <td class="px-4 py-3">{{ $review->system->name }}</td>
                <td class="px-4 py-3">{{ $review->rating }}</td>
                <td class="px-4 py-3">
                    <span class="text-xs px-2 py-1 rounded {{ $review->is_approved ? 'bg-emerald-500/20 text-emerald-200' : 'bg-amber-500/20 text-amber-200' }}">{{ $review->is_approved ? 'Aprovada' : 'Pendente' }}</span>
                </td>
                <td class="px-4 py-3">
                    <div class="flex items-center justify-end gap-2">
                        @if(!$review->is_approved)
                        <form method="POST" action="{{ route('admin.reviews.approve', $review) }}">
                            @csrf
                            <button type="submit" class="px-3 py-1 rounded-lg bg-emerald-500/20 text-emerald-200 hover:bg-emerald-500/30">Aprovar</button>
                        </form>
                        @endif
                        <form method="POST" action="{{ route('admin.reviews.destroy', $review) }}" onsubmit="return confirm('Remover?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 rounded-lg bg-red-500/20 text-red-200 hover:bg-red-500/30">Excluir</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="px-4 py-12 text-center text-white/60">Nenhuma avaliação encontrada.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">{{ $reviews->links() }}</div>
@endsection


