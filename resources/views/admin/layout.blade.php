@extends('layouts.app')

@push('head')
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
          darkMode: 'class',
          theme: {extend: {}}
        }
    </script>
    <style>
        /* Admin Panel Styles */
        .btn-primary {
            @apply inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors;
        }
        
        .btn-ghost {
            @apply inline-flex items-center gap-2 px-4 py-2 bg-transparent hover:bg-white/10 text-white border border-white/20 rounded-lg font-medium transition-colors;
        }
        
        .btn-ghost-sm {
            @apply inline-flex items-center gap-1 px-2 py-1 bg-transparent hover:bg-white/10 text-white border border-white/20 rounded font-medium transition-colors text-sm;
        }
        
        .icon-selector-container {
            @apply relative;
        }
        
        .icon-selector-dropdown {
            @apply absolute top-full left-0 right-0 mt-1 bg-gray-800 border border-gray-600 rounded-lg shadow-lg z-50 max-h-60 overflow-y-auto;
        }
        
        .icon-grid {
            @apply grid grid-cols-8 gap-1 p-2;
        }
        
        .icon-item {
            @apply p-2 text-center hover:bg-gray-700 rounded cursor-pointer transition-colors;
        }
        
        .icon-item.selected {
            @apply bg-blue-600 text-white;
        }
        
        .icon-search {
            @apply w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500;
        }
    </style>
@endpush

@section('content')
<section class="py-8">
    <div class="container mx-auto px-6 grid grid-cols-12 gap-6">
        <aside class="col-span-12 md:col-span-3 lg:col-span-2 bg-white/5 dark:bg-white/5 backdrop-blur rounded-xl border border-white/10 p-4 sticky top-6 h-max">
            <nav class="space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-between rounded-lg px-3 py-2 hover:bg-white/10 {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white' : 'text-white/80' }}">Dashboard</a>
                <a href="{{ route('admin.systems.index') }}" class="flex items-center justify-between rounded-lg px-3 py-2 hover:bg-white/10 {{ request()->routeIs('admin.systems.*') ? 'bg-white/10 text-white' : 'text-white/80' }}">Sistemas</a>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center justify-between rounded-lg px-3 py-2 hover:bg-white/10 {{ request()->routeIs('admin.categories.*') ? 'bg-white/10 text-white' : 'text-white/80' }}">Categorias</a>
                <a href="{{ route('admin.tags.index') }}" class="flex items-center justify-between rounded-lg px-3 py-2 hover:bg-white/10 {{ request()->routeIs('admin.tags.*') ? 'bg-white/10 text-white' : 'text-white/80' }}">Tags</a>
                <a href="{{ route('admin.profile.index') }}" class="flex items-center justify-between rounded-lg px-3 py-2 hover:bg-white/10 {{ request()->routeIs('admin.profile.*') ? 'bg-white/10 text-white' : 'text-white/80' }}">Perfil</a>
          <a href="{{ route('admin.stack.index') }}" class="flex items-center justify-between rounded-lg px-3 py-2 hover:bg-white/10 {{ request()->routeIs('admin.stack.*') ? 'bg-white/10 text-white' : 'text-white/80' }}">Stack</a>
          <a href="{{ route('admin.certificates.index') }}" class="flex items-center justify-between rounded-lg px-3 py-2 hover:bg-white/10 {{ request()->routeIs('admin.certificates.*') ? 'bg-white/10 text-white' : 'text-white/80' }}">Certificados</a>
          <a href="{{ route('admin.timeline.index') }}" class="flex items-center justify-between rounded-lg px-3 py-2 hover:bg-white/10 {{ request()->routeIs('admin.timeline.*') ? 'bg-white/10 text-white' : 'text-white/80' }}">Timeline</a>
                <a href="{{ route('admin.portfolio.index') }}" class="flex items-center justify-between rounded-lg px-3 py-2 hover:bg-white/10 {{ request()->routeIs('admin.portfolio.*') ? 'bg-white/10 text-white' : 'text-white/80' }}">Portfólio</a>
                <a href="{{ route('admin.orders.index') }}" class="flex items-center justify-between rounded-lg px-3 py-2 hover:bg-white/10 {{ request()->routeIs('admin.orders.*') ? 'bg-white/10 text-white' : 'text-white/80' }}">Pedidos</a>
                <a href="{{ route('admin.reviews.index') }}" class="flex items-center justify-between rounded-lg px-3 py-2 hover:bg-white/10 {{ request()->routeIs('admin.reviews.*') ? 'bg-white/10 text-white' : 'text-white/80' }}">Avaliações</a>
                <a href="{{ route('admin.messages.index') }}" class="flex items-center justify-between rounded-lg px-3 py-2 hover:bg-white/10 {{ request()->routeIs('admin.messages.*') ? 'bg-white/10 text-white' : 'text-white/80' }}">Mensagens</a>
            </nav>
        </aside>
        <div class="col-span-12 md:col-span-9 lg:col-span-10">
            @if(session('success'))
                <div class="mb-4 rounded-lg border border-emerald-500/20 bg-emerald-500/10 text-emerald-200 p-3 text-sm">
                    {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div class="mb-4 rounded-lg border border-red-500/20 bg-red-500/10 text-red-200 p-3 text-sm">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="bg-white/5 border border-white/10 rounded-2xl p-6">
                @yield('admin')
            </div>
        </div>
    </div>
 </section>
@endsection

@push('scripts')
<script>
// Icon Selector Functionality
function toggleIconSelector(name) {
    const dropdown = document.getElementById(`icon-dropdown-${name}`);
    if (dropdown) {
        dropdown.classList.toggle('hidden');
    }
}

function selectIcon(name, icon) {
    const input = document.getElementById(`icon-input-${name}`);
    if (input) {
        input.value = icon;
    }
    const dropdown = document.getElementById(`icon-dropdown-${name}`);
    if (dropdown) {
        dropdown.classList.add('hidden');
    }
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    if (!event.target.closest('.icon-selector-container')) {
        const dropdowns = document.querySelectorAll('.icon-selector-dropdown');
        dropdowns.forEach(dropdown => {
            dropdown.classList.add('hidden');
        });
    }
});

// Filter icons
function filterIcons(name, searchTerm) {
    const items = document.querySelectorAll(`#icon-dropdown-${name} .icon-item`);
    items.forEach(item => {
        const icon = item.textContent.trim();
        if (icon.includes(searchTerm)) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}
</script>
@endpush


