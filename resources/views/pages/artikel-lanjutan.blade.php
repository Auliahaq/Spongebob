@extends('layouts.app')

@section('title', 'Artikel | Lexica')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/artikel-lanjutan.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
@endsection

@section('content')
@php
    // Data dari controller
    $title      = $article->judul;
    $author     = $article->penulis;
    $imagePath  = $article->gambar ?: 'img/default.jpg';
    $lanjutan   = $article->content_sulit;
    $menengah   = $article->content_sedang;
    $pemula     = $article->content_mudah;
    $activeTab  = $active_tab;    // 'lanjutan'|'menengah'|'pemula'
    $readLevels = $readLevels ?? []; // mis. ['lanjutan', 'pemula']
@endphp

<div class="article-header">
  <h2 class="article-title">{{ $title }}</h2>
  <div class="article-tools">
    <div class="tool">
      <div class="tool-icon"><img src="{{ asset('img/koleksi.png') }}" alt="Koleksi"></div>
      <span>Tambahkan ke koleksi</span>
    </div>
    <div class="tool">
      <div class="tool-icon"><img src="{{ asset('img/share.webp') }}" alt="Bagikan"></div>
      <span>Bagikan</span>
    </div>
  </div>
</div>

<main class="article-main">
  <div class="article-intro">
    <img src="{{ asset($imagePath) }}" alt="Ilustrasi Artikel" class="article-image">
    <p class="article-meta">Oleh {{ $author }}</p>
    <h3>Pilih Tingkatan Literasi yang Kamu Minati</h3>
  </div>

  <div class="literasi-tabs">
  <a href="{{ route('artikel.lanjutan', ['id'=>$article->id, 'tab'=>'lanjutan']) }}"
     class="tab-btn {{ $active_tab=='lanjutan' ? 'active' : '' }}">
    Lanjutan
  </a>
  <a href="{{ route('artikel.lanjutan', ['id'=>$article->id, 'tab'=>'menengah']) }}"
     class="tab-btn {{ $active_tab=='menengah' ? 'active' : '' }}">
    Menengah
  </a>
  <a href="{{ route('artikel.lanjutan', ['id'=>$article->id, 'tab'=>'pemula']) }}"
     class="tab-btn {{ $active_tab=='pemula'   ? 'active' : '' }}">
    Pemula
  </a>
</div>


  <div class="literasi-content">
    <div id="lanjutan" class="tab-content {{ $activeTab=='lanjutan' ? 'active':'' }}">{!! $lanjutan !!}</div>
    <div id="menengah" class="tab-content {{ $activeTab=='menengah' ? 'active':'' }}">{!! $menengah !!}</div>
    <div id="pemula"   class="tab-content {{ $activeTab=='pemula'   ? 'active':'' }}">{!! $pemula   !!}</div>
  </div>

  <form action="{{ route('artikel.markRead') }}" method="POST" class="selesai-baca-container">
    @csrf
    <input type="hidden" name="artikel_id" value="{{ $article->id }}">
    <input type="hidden" name="level"      value="{{ $activeTab }}">

    @if(in_array($activeTab, $readLevels))
      <button type="button" class="selesai-baca-btn" disabled>✓ Sudah Dibaca</button>
    @else
      <button type="submit" class="selesai-baca-btn">Selesai Membaca</button>
    @endif
  </form>
</main>

<div class="right-buttons">
  <button id="AI" title="AI"><img src="{{ asset('img/headphone.png') }}" alt="AI"></button>
  <button id="scroll-up" title="Ke Atas"><img src="{{ asset('img/arrow.jpg') }}" alt="Atas"></button>
</div>

<script>
  // Tab switching
  document.querySelectorAll('.tab-btn').forEach(btn=>{
    btn.addEventListener('click',()=>{
      const tab = btn.dataset.target;
      const url = new URL(window.location.href);
      url.searchParams.set('tab', tab);
      window.location.href = url;
    });
  });
  // Scroll to top
  document.getElementById('scroll-up').addEventListener('click',()=>{
    window.scrollTo({ top:0, behavior:'smooth' });
  });
</script>
@endsection
