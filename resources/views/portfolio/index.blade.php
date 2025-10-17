@extends('layouts.app')

@section('title', 'Portfólio - Geja Systems')

@section('content')
<section class="section">
  <div class="container">
    <h1 class="page-title">Portfólio</h1>
    <p class="subhead">Projetos e sistemas não comercializados, selecionados do meu trabalho.</p>

    <div class="cards grid" style="grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.5rem;">
      @forelse($items as $item)
      <article class="card portfolio-card" style="height: fit-content; overflow: hidden;">
        @if($item->image)
        <div class="card-image" style="height: 200px; overflow: hidden;">
          <img src="{{ $item->image }}" alt="{{ $item->title }}" style="width: 100%; height: 100%; object-fit: cover;">
        </div>
        @else
        <div class="card-image" style="height: 200px; background: var(--gradient-card); display: flex; align-items: center; justify-content: center;">
          <span class="card-icon" style="font-size: 3rem; opacity: 0.6;">🧩</span>
        </div>
        @endif
        <div class="card-content" style="padding: 1.5rem;">
          <div class="card-header" style="margin-bottom: 1rem;">
            <div class="card-badge" style="margin-bottom: 0.5rem;">Portfólio</div>
            <h3 class="card-title" style="margin: 0; font-size: 1.25rem; line-height: 1.4;">
              <a href="{{ route('portfolio.show', $item->slug) }}" style="color: inherit; text-decoration: none;">{{ $item->title }}</a>
            </h3>
          </div>
          <p class="card-description" style="margin-bottom: 1rem; font-size: 0.95rem; line-height: 1.5; color: hsl(var(--muted-foreground));">
            {{ $item->subtitle ?: Str::limit($item->description, 120) }}
          </p>
          @if($item->technologies)
          <div class="card-tags" style="margin-bottom: 1.5rem;">
            @foreach($item->technologies as $tech)
              <span class="tag" style="font-size: 0.8rem; padding: 0.25rem 0.5rem;">{{ $tech }}</span>
            @endforeach
          </div>
          @endif
          <div class="card-footer" style="margin-top: auto;">
            <div class="card-actions" style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
              <a href="{{ route('portfolio.show', $item->slug) }}" class="btn ghost small">Detalhes</a>
              @if($item->demo_url)
                <a href="{{ $item->demo_url }}" target="_blank" class="btn secondary small">Demo</a>
              @endif
              @if($item->github_url)
                <a href="{{ $item->github_url }}" target="_blank" class="btn small">GitHub</a>
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


