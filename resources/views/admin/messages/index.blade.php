@extends('admin.layout')

@section('title', 'Admin - Mensagens')

@section('admin')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold">Mensagens</h1>
 </div>

<div class="overflow-hidden rounded-2xl border border-white/10">
    <table class="min-w-full divide-y divide-white/10">
        <thead class="bg-white/5">
            <tr>
                <th class="px-4 py-3 text-left text-sm font-semibold text-white/80">Nome</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-white/80">Email</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-white/80">Motivo</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-white/80">Data</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-white/80">Lida</th>
                <th class="px-4 py-3 text-right text-sm font-semibold text-white/80">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/10">
        @forelse($messages as $m)
            <tr class="hover:bg-white/5">
                <td class="px-4 py-3">{{ $m->name }}</td>
                <td class="px-4 py-3">{{ $m->email }}</td>
                <td class="px-4 py-3"><span class="text-xs px-2 py-1 rounded bg-white/10">{{ $m->contact_reason }}</span></td>
                <td class="px-4 py-3">{{ $m->created_at->format('d/m/Y H:i') }}</td>
                <td class="px-4 py-3">
                    <span class="text-xs px-2 py-1 rounded {{ $m->is_read ? 'bg-emerald-500/20 text-emerald-200' : 'bg-amber-500/20 text-amber-200' }}">{{ $m->is_read ? 'Sim' : 'Não' }}</span>
                </td>
                <td class="px-4 py-3">
                    <div class="flex items-center justify-end gap-2">
                        @if(!$m->is_read)
                        <form method="POST" action="{{ route('admin.messages.read', $m) }}">
                            @csrf
                            <button type="submit" class="px-3 py-1 rounded-lg bg-emerald-500/20 text-emerald-200 hover:bg-emerald-500/30">Marcar como lida</button>
                        </form>
                        @endif
                        <form method="POST" action="{{ route('admin.messages.destroy', $m) }}" onsubmit="return confirm('Remover?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 rounded-lg bg-red-500/20 text-red-200 hover:bg-red-500/30">Excluir</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="px-4 py-12 text-center text-white/60">Nenhuma mensagem encontrada.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">{{ $messages->links() }}</div>
@endsection


