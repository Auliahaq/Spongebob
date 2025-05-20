@extends('layouts.app')

@section('title', 'Artikel | Lexica')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/artikel-lanjutan.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
@endsection

@section('content')
@php
    use Illuminate\Support\Facades\DB;

    $article_id = request()->get('id', 1);
    $article = DB::table('artikel')->where('id', $article_id)->first();

    if ($article) {
        $title = $article->judul;
        $author = $article->penulis;
        $image = $article->gambar;
        $lanjutan = $article->content_sulit;
        $menengah = $article->content_sedang;
        $pemula = $article->content_mudah;
    } else {
        $title = "Judul Default";
        $author = "Penulis Default";
        $image = "default.png";
        $lanjutan = "Konten lanjutan tidak tersedia.";
        $menengah = "Konten menengah tidak tersedia.";
        $pemula = "Konten pemula tidak tersedia.";
    }

    $active_tab = request()->get('tab', 'lanjutan');
@endphp

<div class="article-header">
    <h2 class="article-title">{{ $title }}</h2>
    <div class="article-tools">
        <div class="tool"><img src="{{ asset('img/collection-icon.png') }}" alt="Koleksi"><span>KOLEKSI</span></div>
        <div class="tool"><img src="{{ asset('img/share-icon.png') }}" alt="Bagikan"><span>BAGIKAN</span></div>
    </div>
</div>

<main class="article-main">
    <div class="article-intro">
        <img src="{{ $article->gambar }}" alt="Ilustrasi artikel">
        <p class="article-meta">{{ $author }}</p>
        <h3>Pilih Tingkatan Literasi Yang Kamu Minati</h3>
    </div>

    <div class="literasi-tabs">
        <button class="tab-btn {{ $active_tab == 'lanjutan' ? 'active' : '' }}" data-target="lanjutan">Lanjutan</button>
        <button class="tab-btn {{ $active_tab == 'menengah' ? 'active' : '' }}" data-target="menengah">Menengah</button>
        <button class="tab-btn {{ $active_tab == 'pemula' ? 'active' : '' }}" data-target="pemula">Pemula</button>
    </div>

    <div class="literasi-content">
        <div id="lanjutan" class="tab-content {{ $active_tab == 'lanjutan' ? 'active' : '' }}">
            <p>{!! $lanjutan !!}</p>
        </div>
        <div id="menengah" class="tab-content {{ $active_tab == 'menengah' ? 'active' : '' }}">
            <p>{!! $menengah !!}</p>
        </div>
        <div id="pemula" class="tab-content {{ $active_tab == 'pemula' ? 'active' : '' }}">
            <p>{!! $pemula !!}</p>
        </div>
    </div>
</main>

<div class="scroll-buttons">
  <button id="scroll-up" title="Kembali ke Atas">
    <img src="{{ asset('images/arrow-up.png') }}" alt="Atas">
  </button>
  <button id="scroll-down" title="Ke Bawah Artikel">
    <img src="{{ asset('images/arrow-down.png') }}" alt="Bawah">
  </button>
</div>

<script>
    document.querySelectorAll('.tab-btn').forEach(button => {
        button.addEventListener('click', () => {
            const target = button.getAttribute('data-target');
            const url = new URL(window.location.href);
            url.searchParams.set('tab', target);
            window.location.href = url.toString();
        });
    });
</script>
@endsection