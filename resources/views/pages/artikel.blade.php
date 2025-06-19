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
        <a href="{{ route('artikel.lanjutan', ['id' => $highlightArticle->id]) }}" class="highlight-link">
            <div class="highlight-container">
            <img src="{{ asset($highlightArticle->gambar) }}" alt="{{ $highlightArticle->judul }}" class="highlight-image" />
            <div class="highlight-content">
                <span class="highlight-meta">Terbaru · {{ $highlightArticle->kategori }}</span>
                <h3 class="highlight-title">{{ $highlightArticle->judul }}</h3>
                <p class="highlight-desc">{{ $highlightArticle->isi }}</p>
            </div>
            </div>
        </a>
    </section>



    
  @endif

  <!-- Card Section -->
  <section class="cards-section">
    <div class="cards-grid">
      @foreach ($cardsArticles as $index => $article)
        <a href="{{ route('artikel.lanjutan', ['id' => $article->id]) }}" class="card-link">
            <div class="card-box">
            <div class="card-header">
                <img src="{{ asset($article->gambar) }}" alt="{{ $article->judul }}" class="card-image" />
                <div class="card-text">
                <span class="card-tag">{{ $article->kategori }}</span>
                <h4 class="card-title">{{ $article->judul }}</h4>
                </div>
            </div>
            <div class="card-body">
                <p class="card-desc">{{ \Illuminate\Support\Str::limit($article->isi, 500) }}</p>
            </div>
            </div>
        </a>
      @endforeach
    </div>
  </section>

  <!-- Latest Articles Section -->
  <section class="latest-section">
    <div class="latest-container">
      <h2 class="latest-heading">ARTIKEL TERBARU</h2>
      <div class="latest-grid">
      @foreach ($latestArticles as $article)
        <a href="{{ route('artikel.lanjutan', ['id' => $article->id]) }}" class="latest-link">
            <div class="latest-card">
            <img src="{{ asset($article->gambar) }}" alt="{{ $article->judul }}" class="latest-image" />
            <div class="latest-content">
                <h4 class="latest-title">{{ $article->judul }}</h4>
            </div>
            </div>
        </a>
      @endforeach
      </div>
      <div class="latest-button-container">
      </div>
    </div>
  </section>

</main>
@endsection