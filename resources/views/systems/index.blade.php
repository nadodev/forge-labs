@extends('layouts.app')

@section('title', 'Catálogo de Sistemas - Geja Systems')

@section('content')
<section class="section">
    <div class="container">
        <h1 class="page-title">Catálogo de Sistemas</h1>
        <div class="catalog-layout">
            <aside class="filters">
                <form method="GET" action="{{ route('systems.index') }}" id="filterForm">
                    <div class="filter-group">
                        <label for="q">Busca</label>
                        <input id="q" name="q" type="search" placeholder="Buscar sistemas..." value="{{ request('q') }}">
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
                        <span class="filter-title">Tipo de Licença</span>
                        <div class="chips" id="licChips">
                            @foreach($licenses as $key => $label)
                            <label class="chip {{ request('licenca') == $key ? 'active' : '' }}">
                                <input type="radio" name="licenca" value="{{ $key }}" {{ request('licenca') == $key ? 'checked' : '' }} onchange="this.form.submit()">
                                {{ $label }}
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
                                {{ $label }}
                            </label>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="filter-group">
                        <label for="sort">Ordenar por</label>
                        <select id="sort" name="sort" onchange="this.form.submit()">
                            <option value="date" {{ request('sort') == 'date' ? 'selected' : '' }}>Data</option>
                            <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Popularidade</option>
                            <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Preço</option>
                        </select>
                    </div>
                </form>
            </aside>
            
            <section class="results">
                <div class="results-header">
                    <div class="results-info">
                        <h3>{{ $systems->count() }} sistemas encontrados</h3>
                        <p class="muted">Filtre e explore nossa coleção de sistemas</p>
                    </div>
                    <div class="view-toggle">
                        <button class="btn toggle active" data-view="grid">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="7" height="7"/>
                                <rect x="14" y="3" width="7" height="7"/>
                                <rect x="14" y="14" width="7" height="7"/>
                                <rect x="3" y="14" width="7" height="7"/>
                            </svg>
                            Grade
                        </button>
                        <button class="btn toggle" data-view="list">
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
                        <div class="card-image">
                            <div class="card-image-placeholder">
                                <span class="card-icon">{{ $system->icon }}</span>
                            </div>
                            <div class="card-overlay">
                                <div class="card-actions">
                                    <a href="{{ route('systems.show', $system->slug) }}" class="btn primary small">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                            <circle cx="12" cy="12" r="3"/>
                                        </svg>
                                        Ver detalhes
                                    </a>
                                    @if($system->demo_url)
                                    <a href="{{ $system->demo_url }}" class="btn secondary small" target="_blank">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                                            <polyline points="15,3 21,3 21,9"/>
                                            <line x1="10" y1="14" x2="21" y2="3"/>
                                        </svg>
                                        Demo
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-header">
                                <div class="card-badge">{{ $system->category->name }}</div>
                                <h3 class="card-title">{{ $system->name }}</h3>
                            </div>
                            <p class="card-description">{{ $system->description }}</p>
                            <div class="card-tags">
                                @foreach($system->tags as $tag)
                                <span class="tag" style="background-color: {{ $tag->color }}">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                            <div class="card-footer">
                                <div class="card-meta">
                                    <div class="rating">
                                        <div class="stars">
                                            @for($i = 1; $i <= 5; $i++)
                                                <span class="star {{ $i <= $system->rating ? 'filled' : '' }}">⭐</span>
                                            @endfor
                                        </div>
                                        <span class="rating-value">{{ $system->rating }}</span>
                                    </div>
                                    <span class="downloads">{{ $system->downloads_count }} downloads</span>
                                </div>
                                <div class="card-price">
                                    @if($system->price > 0)
                                        <span class="price">R$ {{ number_format($system->price, 2, ',', '.') }}</span>
                                    @else
                                        <span class="price free">Gratuito</span>
                                    @endif
                                </div>
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
                
                @if($systems->count() > 0)
                <div class="pager">
                    <button class="btn ghost" id="loadMore">Carregar mais</button>
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
