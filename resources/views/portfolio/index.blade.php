@extends('layouts.app')

@section('title', 'Portfólio - Geja Systems')

@section('content')
<section class="section">
  <div class="container">
    <h1 class="page-title">Portfólio</h1>
    <p class="subhead">Projetos e sistemas não comercializados, selecionados do meu trabalho.</p>

    <div class="portfolio-grid">
      @forelse($items as $item)
      <article class="portfolio-card">
        @if($item->image)
        <div class="portfolio-image">
          <img src="{{ $item->image }}" alt="{{ $item->title }}">
        </div>
        @else
        <div class="portfolio-image portfolio-placeholder">
          <span class="portfolio-icon">🧩</span>
        </div>
        @endif
        
        <div class="portfolio-content">
          <div class="portfolio-header">
            <div class="portfolio-badge">Portfólio</div>
            <h3 class="portfolio-title">
              <a href="{{ route('portfolio.show', $item->slug) }}">{{ $item->title }}</a>
            </h3>
          </div>
          
          <p class="portfolio-description">
            {{ $item->subtitle ?: Str::limit($item->description, 120) }}
          </p>
          
          @if($item->technologies)
          <div class="portfolio-technologies">
            @foreach($item->technologies as $tech)
              <span class="tech-tag">{{ $tech }}</span>
            @endforeach
          </div>
          @endif
          
          <div class="portfolio-actions">
            <a href="{{ route('portfolio.show', $item->slug) }}" class="btn primary small">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                <circle cx="12" cy="12" r="3"/>
              </svg>
              Ver detalhes
            </a>
            
            <div class="portfolio-links">
              @if($item->demo_url)
                <a href="{{ $item->demo_url }}" target="_blank" class="portfolio-link" title="Ver demo">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                    <polyline points="15,3 21,3 21,9"/>
                    <line x1="10" y1="14" x2="21" y2="3"/>
                  </svg>
                </a>
              @endif
              @if($item->github_url)
                <a href="{{ $item->github_url }}" target="_blank" class="portfolio-link" title="Ver código">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"/>
                  </svg>
                </a>
              @endif
            </div>
          </div>
        </div>
      </article>
      @empty
      <div class="empty-state">
        <h3>Sem itens no portfólio ainda</h3>
        <p>Em breve adicionarei novos projetos.</p>
      </div>
      @endforelse
    </div>

    @if($items->hasPages())
    <div class="pager">
      {{ $items->links() }}
    </div>
    @endif
  </div>
</section>
@endsection


