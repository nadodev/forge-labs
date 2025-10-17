@extends('layouts.app')

@section('title', $portfolio->title . ' - Portfólio')

@section('content')
<section class="section">
  <div class="container">
    <div class="hero" >
      <div class="hero-container" style="">
        <div class="hero-content">
          <div class="hero-badge"><span class="badge-text">Projeto do Portfólio</span></div>
          <h1 class="headline" style="margin-bottom: var(--space-md);">{{ $portfolio->title }}</h1>
          @if($portfolio->subtitle)
            <p class="subhead">{{ $portfolio->subtitle }}</p>
          @endif
          <div class="hero-actions">
            @if($portfolio->demo_url)
              <a href="{{ $portfolio->demo_url }}" target="_blank" class="btn secondary">Ver demo</a>
            @endif
            @if($portfolio->github_url)
              <a href="{{ $portfolio->github_url }}" target="_blank" class="btn">GitHub</a>
            @endif
          </div>
        </div>
        @if($portfolio->image)v class="hero-visual" style="height:340px; display:flex; align-items:center; justify-content:center; background: var(--gradient-card);">
          <img src="{{ $portfolio->image }}" alt="{{ $portfolio->title }}" style="max-width:100%; max-height:100%; object-fit: cover; border-radius:16px; border:1px solid hsl(var(--border)/0.4); box-shadow: 0 20px 40px hsl(var(--background)/0.4);">
        </div>
        @else
        <div class="hero-visual" style="height:340px; width:600px;">
          <div class="mockup">
            <div class="mockup-window">
              <div class="mockup-titlebar"><span></span><span></span><span></span></div>
              <div class="mockup-screen">
                <div class="mockup-hero"></div>
                <div class="mockup-cards"><div class="mock-card"></div><div class="mock-card"></div><div class="mock-card"></div></div>
              </div>
            </div>
          </div>
        </div>
        @endif
      </div>
    </div>

    <div class="details-layout">
      <div class="details-content">
        @if($portfolio->description)
        <div class="card" style="margin-bottom: 16px;">
          <div class="card-content">
            <p style="font-size:1.05rem; line-height:1.8;">{!! nl2br(e($portfolio->description)) !!}</p>
          </div>
        </div>
        @endif
        @if($portfolio->content)
        <div class="card" style="margin-bottom: 16px;">
          <div class="card-content">
            {!! $portfolio->content !!}
          </div>
        </div>
        @endif

        @if($portfolio->technologies)
        <div style="margin-top:24px;">
          <h3 class="section-title" style="text-align:left;">Tecnologias</h3>
          <div class="card-tags">
            @foreach($portfolio->technologies as $tech)
              <span class="tag">{{ $tech }}</span>
            @endforeach
          </div>
        </div>
        @endif
      </div>

      <aside class="details-aside">
        <div class="sticky-box">
          <div class="action-buttons">
            @if($portfolio->demo_url)
              <a href="{{ $portfolio->demo_url }}" target="_blank" class="btn secondary full-width">Ver demo</a>
            @endif
            @if($portfolio->github_url)
              <a href="{{ $portfolio->github_url }}" target="_blank" class="btn full-width">GitHub</a>
            @endif
          </div>
          <div style="margin-top:16px; border-top:1px solid hsl(var(--border)); padding-top:16px;">
            <div class="muted" style="margin-bottom:6px;">Publicado</div>
            <div>{{ $portfolio->created_at?->format('d/m/Y') }}</div>
            @if($portfolio->is_featured)
              <div class="status status-disponivel" style="margin-top:12px;">Destaque</div>
            @endif
          </div>
        </div>
      </aside>
    </div>
  </div>
</section>
@endsection


