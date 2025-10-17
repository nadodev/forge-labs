@extends('layouts.app')

@section('title', 'Catálogo de Sistemas - Geja Systems')

@section('content')
<section class="section">
    <div class="container">
        <h1 class="page-title">Catálogo de Sistemas</h1>
        <div class="catalog-layout">
            <aside class="filters">
                @php
                    $languageIcons = [
                        'api-rest' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="7" width="7" height="5"/><rect x="14" y="7" width="7" height="5"/><path d="M10 9h4"/></svg>',
                        'aws' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 16l8 5 8-5"/><path d="M4 12l8 5 8-5"/><path d="M4 8l8 5 8-5"/></svg>',
                        'laravel' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M3.5 6.5l5-3 5 3v5l-5 3-5-3v-5zm10 0l5-3 5 3v5l-5 3-5-3v-5z"/></svg>',
                    ];
                @endphp
                <form method="GET" action="{{ route('systems.index') }}" id="filterForm">
                    <div class="filter-group">
                        <label for="q">Busca</label>
                        <input id="q" name="q" type="search" placeholder="Buscar sistemas..." value="{{ request('q') }}">
                    </div>
                    <div class="filter-group">
                        <label for="sort">Ordenar por</label>
                        <select id="sort" name="sort" onchange="this.form.submit()">
                            <option value="date" {{ request('sort') == 'date' ? 'selected' : '' }}>Data</option>
                            <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Popularidade</option>
                            <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Preço</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <span class="filter-title">Categoria</span>
                        <div class="chips" id="catChips">
                            @foreach($categories as $category)
                            <label class="chip {{ request('categoria') == $category->slug ? 'active' : '' }}">
                                <input type="radio" name="categoria" value="{{ $category->slug }}" {{ request('categoria') == $category->slug ? 'checked' : '' }} onchange="this.form.submit()">
                                {{ $category->icon }} {{ $category->name }}
                            </label>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="filter-group">
                        <span class="filter-title">Linguagem</span>
                        <div class="chips" id="langChips">
                            @foreach($languages as $key => $label)
                            <label class="chip {{ request('linguagem') == $key ? 'active' : '' }}">
                                <input type="radio" name="linguagem" value="{{ $key }}" {{ request('linguagem') == $key ? 'checked' : '' }} onchange="this.form.submit()">
                                {!! $languageIcons[$key] ?? '' !!} {{ $label }}
                            </label>
                            @endforeach
                        </div>
                    </div>
                    
                   

                    @if(request()->hasAny(['q','categoria','licenca','linguagem','sort']))
                    <div class="filter-group">
                        <a href="{{ route('systems.index') }}" class="btn ghost" style="width:100%;text-align:center;">Limpar filtros</a>
                    </div>
                    @endif
                </form>
            </aside>
            
            <section class="results">
                <div class="results-header">
                    <div class="results-info">
                        <h3 style="display:flex; align-items:center; gap:12px; flex-wrap:wrap;">
                            @php($count = $systems->count())
                            {{ $count }} {{ Str::plural('sistema', $count) }} encontrado{{ $count === 1 ? '' : 's' }}
                            @if(request()->hasAny(['q','categoria','licenca','linguagem','sort']))
                                <a href="{{ route('systems.index') }}" class="btn ghost small" aria-label="Limpar filtros">Limpar filtros</a>
                            @endif
                        </h3>
                        <p class="muted">Filtre e explore nossa coleção de sistemas</p>
                        @if(request()->hasAny(['q','categoria','licenca','linguagem']))
                        <div class="active-filters" style="margin-top:8px; display:flex; gap:8px; flex-wrap:wrap;">
                            @if(request('q'))
                                <span class="pill">Busca: "{{ request('q') }}"</span>
                            @endif
                            @if(request('categoria'))
                                <span class="pill">Categoria: {{ request('categoria') }}</span>
                            @endif
                            @if(request('licenca'))
                                <span class="pill">Licença: {{ request('licenca') }}</span>
                            @endif
                            @if(request('linguagem'))
                                <span class="pill">Linguagem: {{ request('linguagem') }}</span>
                            @endif
                        </div>
                        @endif
                    </div>
                    <div class="view-toggle">
                        <button class="btn toggle active" data-view="grid" aria-pressed="true">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="7" height="7"/>
                                <rect x="14" y="3" width="7" height="7"/>
                                <rect x="14" y="14" width="7" height="7"/>
                                <rect x="3" y="14" width="7" height="7"/>
                            </svg>
                            Grade
                        </button>
                        <button class="btn toggle" data-view="list" aria-pressed="false">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="8" y1="6" x2="21" y2="6"/>
                                <line x1="8" y1="12" x2="21" y2="12"/>
                                <line x1="8" y1="18" x2="21" y2="18"/>
                                <line x1="3" y1="6" x2="3.01" y2="6"/>
                                <line x1="3" y1="12" x2="3.01" y2="12"/>
                                <line x1="3" y1="18" x2="3.01" y2="18"/>
                            </svg>
                            Lista
                        </button>
                    </div>
                </div>
                
                <div id="results" class="cards grid">
                    @forelse($systems as $system)
                    <div class="card system-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                        <div class="system-card-header">
                            <span class="category-chip">{{ $system->category->icon }} {{ $system->category->name }}</span>
                            @if($system->price > 0)
                                <span class="price-ribbon">R$ {{ number_format($system->price, 2, ',', '.') }}</span>
                            @else
                                <span class="price-ribbon free">Gratuito</span>
                            @endif
                        </div>

                        <div class="system-body">
                            <div class="system-icon">
                                <span class="card-icon">{{ $system->icon }}</span>
                            </div>
                            <div class="system-info">
                                <h3 class="card-title"><a href="{{ route('systems.show', $system->slug) }}">{{ $system->name }}</a></h3>
                                <p class="card-description">{{ Str::limit($system->description, 140) }}</p>
                                <div class="card-tags">
                                    @foreach($system->tags as $tag)
                                        <span class="tag" style="background-color: {{ $tag->color }}">{{ $tag->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="system-footer">
                            <div class="card-meta">
                                <div class="rating" title="Média baseada em avaliações aprovadas">
                                    @php($avg = $system->averageRating())
                                    <div class="stars" aria-label="{{ $avg }} de 5">
                                        @for($i = 1; $i <= 5; $i++)
                                            @php($filled = $i <= floor($avg))
                                            <span class="star {{ $filled ? 'filled' : '' }}">⭐</span>
                                        @endfor
                                    </div>
                                    <span class="rating-value">{{ number_format($avg, 2) }}</span>
                                </div>
                                <span class="downloads" title="Total de itens comprados com pagamento aprovado">{{ $system->paidDownloadsCount() }} downloads</span>
                            </div>
                            <div class="card-actions">
                                @if($system->price > 0)
                                <form method="POST" action="{{ route('cart.add', $system) }}">
                                    @csrf
                                    <button class="btn primary small" aria-label="Adicionar ao carrinho">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="9" cy="21" r="1"/>
                                            <circle cx="20" cy="21" r="1"/>
                                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                                        </svg>
                                        Adicionar
                                    </button>
                                </form>
                                @else
                                <a href="https://wa.me/{{ config('app.whatsapp.number') }}?text=Olá! Gostaria de solicitar o sistema: {{ urlencode($system->name) }} - {{ urlencode(route('systems.show', $system->slug)) }}" 
                                   class="btn primary small" target="_blank" aria-label="Solicitar via WhatsApp">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                    </svg>
                                    Solicitar
                                </a>
                                @endif
                                <a href="{{ route('systems.show', $system->slug) }}" class="btn ghost small">Detalhes</a>
                                @if($system->demo_url)
                                <a href="{{ $system->demo_url }}" class="btn secondary small" target="_blank">Demo</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="empty-state">
                        <h3>Nenhum sistema encontrado</h3>
                        <p>Tente ajustar os filtros para encontrar o que procura.</p>
                    </div>
                    @endforelse
                </div>
                
                @if($systems->hasMorePages())
                <div class="pager">
                    <a class="btn ghost" href="{{ $systems->nextPageUrl() }}">Carregar mais</a>
                </div>
                @endif
            </section>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // View toggle
    const viewToggle = document.querySelectorAll('.view-toggle .btn');
    const results = document.getElementById('results');
    
    viewToggle.forEach(btn => {
        btn.addEventListener('click', function() {
            viewToggle.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            const view = this.dataset.view;
            results.className = `cards ${view}`;
        });
    });
    
    // Search with debounce
    const searchInput = document.getElementById('q');
    let searchTimeout;
    
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            document.getElementById('filterForm').submit();
        }, 500);
    });
    
    // Theme toggle
    setupThemeToggle();
});

function setupThemeToggle() {
    const themeToggle = document.getElementById('themeToggle');
    const body = document.body;
    
    const savedTheme = localStorage.getItem('theme') || 'dark';
    body.className = `theme-${savedTheme}`;
    themeToggle.textContent = savedTheme === 'dark' ? '🌙' : '☀️';
    
    themeToggle.addEventListener('click', function() {
        const currentTheme = body.classList.contains('theme-dark') ? 'dark' : 'light';
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        
        body.className = `theme-${newTheme}`;
        themeToggle.textContent = newTheme === 'dark' ? '🌙' : '☀️';
        localStorage.setItem('theme', newTheme);
    });
}
</script>
@endsection
