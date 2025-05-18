@extends('layouts.app')

@section('title', 'Artikel | Lexica')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/artikel.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
@endsection

@section('content')
<main>

  <!-- Hero Section -->
  <section class="hero-section">
    <div class="search-container">
      <h2>CARI BACAAN FAVORITMU GRATIS!</h2>
      <input type="text" placeholder="Cari artikel...">
      <div class="tag-container">
        <button>Hiburan</button>
        <button>Olahraga</button>
        <button>Pendidikan</button>
        <button>Bisnis</button>
        <button>Teknologi</button>
        <button>Politik</button>
      </div>
    </div>
  </section>

  <!-- Highlight Section -->
  @if($highlightArticle)
  <section class="highlight-section">
    <div class="highlight-container">
      <img src="{{ asset($highlightArticle->gambar) }}" alt="{{ $highlightArticle->judul }}" class="highlight-image" />
      <div class="highlight-content">
        <span class="highlight-meta">Terbaru · {{ $highlightArticle->tingkatan }}</span>
        <h3 class="highlight-title">{{ $highlightArticle->judul }}</h3>
        <p class="highlight-desc">{{ \Illuminate\Support\Str::limit($highlightArticle->isi, 150) }}</p>
      </div>
    </div>
  </section>
  @endif

  <!-- Card Section -->
  <section class="cards-section">
    <div class="cards-grid">
      @foreach ($cardsArticles as $index => $article)
        @if ($index === 0)
        <a href="{{ route('artikel.lanjutan', ['id' => $article->id]) }}" class="card-link">
        @endif

        <div class="card-box">
          <div class="card-header">
            <img src="{{ asset($article->gambar) }}" alt="{{ $article->judul }}" class="card-image" />
            <div class="card-text">
              <span class="card-tag">{{ $article->tingkatan }}</span>
              <h4 class="card-title">{{ $article->judul }}</h4>
            </div>
          </div>
          <div class="card-body">
            <p class="card-desc">{{ \Illuminate\Support\Str::limit($article->isi, 200) }}</p>
          </div>
        </div>

        @if ($index === 0)
        </a>
        @endif
      @endforeach
    </div>
  </section>

  <!-- Latest Articles Section -->
  <section class="latest-section">
    <div class="latest-container">
      <h2 class="latest-heading">ARTIKEL TERBARU</h2>
      <div class="latest-grid">
        @foreach ($latestArticles as $article)
        <div class="latest-card">
          <img src="{{ asset($article->gambar) }}" alt="{{ $article->judul }}" class="latest-image" />
          <div class="latest-content">
            <h4 class="latest-title">{{ $article->judul }}</h4>
          </div>
        </div>
        @endforeach
      </div>
      <div class="latest-button-container">
        <button class="latest-button">PORTFOLIO</button>
      </div>
    </div>
  </section>

</main>
@endsection