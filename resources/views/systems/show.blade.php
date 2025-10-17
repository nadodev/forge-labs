@extends('layouts.app')

@section('title', $system->name . ' - Geja Systems')

@section('content')
<section class="hero system-hero">
    <div class="container">
        <div class="system-hero-content">
            <div class="system-badge">{{ $system->category?->name ?? 'Sem categoria' }}</div>
            <h1 class="headline">{{ $system->name }}</h1>
            <p class="system-description">{{ $system->description }}</p>
            <div class="system-meta">
                <div class="meta-item">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="22,12 18,12 15,21 9,3 6,12 2,12"/>
                    </svg>
                    <span>{{ $system->downloads_count }} downloads</span>
                </div>
                <div class="meta-item">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/>
                    </svg>
                    <span>{{ $system->rating }}/5</span>
                </div>
                <div class="meta-item">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12,6 12,12 16,14"/>
                    </svg>
                    <span>Atualizado {{ $system->updated_at->format('d/m/Y') }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-media">
        <div class="hero-image-placeholder">
            <span class="hero-icon">{{ $system->icon }}</span>
        </div>
        <div class="overlay-gradient"></div>
    </div>
</section>

<section class="container section details-layout">
    <article class="details-content">
        <div class="tabs" id="detailTabs">
            <button data-tab="descricao" class="active">Descrição</button>
            <button data-tab="recursos">Recursos</button>
            <button data-tab="tecnologias">Tecnologias</button>
            <button data-tab="feedbacks">Feedbacks</button>
        </div>
        
        <div id="tab-descricao" class="tab-panel active">
            <p>{{ $system->full_description }}</p>
        </div>
        
        <div id="tab-recursos" class="tab-panel">
            <ul class="features-list">
                @foreach($system->features ?? [] as $feature)
                <li class="feature-item">
                    <span class="feature-icon">✓</span>
                    {{ $feature }}
                </li>
                @endforeach
            </ul>
        </div>
        
        <div id="tab-tecnologias" class="tab-panel">
            <div class="chip-row">
                @foreach($system->technologies ?? [] as $tech)
                <span class="chip tech-chip">{{ $tech }}</span>
                @endforeach
            </div>
        </div>
        
        <div id="tab-feedbacks" class="tab-panel">
            <div class="reviews">
                @forelse($reviews as $review)
                <div class="review">
                    <div class="review-header">
                        <div class="review-author">
                            <h4>{{ $review->author_name }}</h4>
                            <div class="review-rating">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="star {{ $i <= $review->rating ? 'filled' : '' }}">⭐</span>
                                @endfor
                            </div>
                        </div>
                        <span class="review-date">{{ $review->created_at->format('d/m/Y') }}</span>
                    </div>
                    <p class="review-comment">{{ $review->comment }}</p>
                </div>
                @empty
                <p class="muted">Ainda não há avaliações para este sistema.</p>
                @endforelse
            </div>
        </div>

        @if($system->screenshots && count($system->screenshots) > 0)
        <div class="gallery">
            <h3>Galeria de Screenshots</h3>
            <div class="gallery-grid">
                @foreach($system->screenshots as $image)
                <div class="gallery-item" onclick="openLightbox('{{ $image }}')">
                    <img src="{{ $image }}" alt="Screenshot {{ $loop->index + 1 }}" loading="lazy">
                </div>
                @endforeach
            </div>
        </div>
        @endif

        @if(count($relatedSystems) > 0)
        <section class="related">
            <h3>Sistemas relacionados</h3>
            <div class="cards">
                @foreach($relatedSystems as $related)
                <div class="card system-card">
                    <div class="card-image">
                        <div class="card-image-placeholder">
                            <span class="card-icon">{{ $related->icon }}</span>
                        </div>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">{{ $related->name }}</h4>
                        <p class="card-description">{{ $related->description }}</p>
                        <div class="card-footer">
                            <div class="rating">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="star {{ $i <= $related->rating ? 'filled' : '' }}">⭐</span>
                                @endfor
                                <span class="rating-value">{{ $related->rating }}</span>
                            </div>
                            <div class="card-price">
                                @if($related->price > 0)
                                    <span class="price">R$ {{ number_format($related->price, 2, ',', '.') }}</span>
                                @else
                                    <span class="price free">Gratuito</span>
                                @endif
                            </div>
                        </div>
                        <a href="{{ route('systems.show', $related->slug) }}" class="btn primary small">Ver detalhes</a>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif
    </article>

    <aside class="details-aside">
        <div class="sticky-box">
            <div class="pricing-section">
                <div class="price" id="sysPrice">
                    @if($system->price > 0)
                        R$ {{ number_format($system->price, 2, ',', '.') }}
                    @else
                        Gratuito
                    @endif
                </div>
                <div class="status status-{{ $system->status }}" id="sysStatus">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12,6 12,12 16,14"/>
                    </svg>
                    {{ ucfirst($system->status) }}
                </div>
            </div>
            
            <div class="system-info">
                <div class="info-item">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12,6 12,12 16,14"/>
                    </svg>
                    <div class="info-content">
                        <span class="info-label">Atualizado</span>
                        <span class="info-value">{{ $system->updated_at->format('d/m/Y') }}</span>
                    </div>
                </div>
                <div class="info-item">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="22,12 18,12 15,21 9,3 6,12 2,12"/>
                    </svg>
                    <div class="info-content">
                        <span class="info-label">Downloads</span>
                        <span class="info-value">{{ $system->downloads_count }}</span>
                    </div>
                </div>
                <div class="info-item">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/>
                    </svg>
                    <div class="info-content">
                        <span class="info-label">Avaliação</span>
                        <span class="info-value">{{ $system->rating }}/5</span>
                    </div>
                </div>
            </div>
            
            <div class="action-buttons">
                @if($system->price > 0)
                <form method="POST" action="{{ route('cart.add', $system) }}">
                    @csrf
                    <button type="submit" class="btn primary full-width" id="btnAddCart">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="9" cy="21" r="1"/>
                        <circle cx="20" cy="21" r="1"/>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                    </svg>
                    Adicionar ao carrinho
                    </button>
                </form>
                @else
                <a href="https://wa.me/{{ config('app.whatsapp.number') }}?text=Olá! Gostaria de solicitar o sistema: {{ urlencode($system->name) }} - {{ urlencode(route('systems.show', $system->slug)) }}" 
                   class="btn primary full-width" target="_blank" id="btnWhatsApp">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                    </svg>
                    Solicitar via WhatsApp
                </a>
                @endif
                @if($system->demo_url)
                <a href="{{ $system->demo_url }}" class="btn secondary full-width" id="btnDemo" target="_blank">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                        <polyline points="15,3 21,3 21,9"/>
                        <line x1="10" y1="14" x2="21" y2="3"/>
                    </svg>
                    Testar demo
                </a>
                @endif
                <a href="{{ route('contact') }}" class="btn ghost full-width">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                    </svg>
                    Solicitar personalização
                </a>
            </div>
        </div>
    </aside>
</section>

<!-- Lightbox Modal -->
<div id="lightbox" class="lightbox" onclick="closeLightbox()">
    <div class="lightbox-content">
        <img id="lightboxImage" src="" alt="">
        <button class="lightbox-close" onclick="closeLightbox()">&times;</button>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab functionality
    const tabs = document.querySelectorAll('#detailTabs button');
    const panels = document.querySelectorAll('.tab-panel');
    
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const targetTab = this.dataset.tab;
            
            // Remove active from all tabs and panels
            tabs.forEach(t => t.classList.remove('active'));
            panels.forEach(p => p.classList.remove('active'));
            
            // Add active to clicked tab and corresponding panel
            this.classList.add('active');
            document.getElementById(`tab-${targetTab}`).classList.add('active');
        });
    });
    
    // Theme toggle
    setupThemeToggle();
});

function openLightbox(imageSrc) {
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightboxImage');
    
    lightboxImage.src = imageSrc;
    lightbox.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    const lightbox = document.getElementById('lightbox');
    lightbox.style.display = 'none';
    document.body.style.overflow = 'auto';
}

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
