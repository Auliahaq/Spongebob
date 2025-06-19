@extends('layouts.app')

@section('title', 'Beranda — Lexica')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')

<!-- Hero Section -->
<div class="hero">
  <div class="intro">
    <h1>LEXICA</h1>
    <img src="{{ asset('img/home-lexica-splash.png') }}" alt="Lexica Hero" class="hero-img">
    <p class="quote">"Kata demi kata, aku menyusun jendela menuju semesta yang belum kutahu."</p>
  </div>
</div>

<!-- Literasi Section -->
<section class="literasi">
  <div class="literasi-box">
    <h2>LITERASI ADALAH HAK SEMUA ORANG</h2>
    <p>
      Setiap individu berhak untuk bisa membaca, menulis, memahami, dan berpikir kritis.
      Bukan cuma soal buku atau teks, tapi tentang kemampuan untuk memahami dunia, menilai informasi, dan menyuarakan pendapat.
      Di era digital yang serba cepat ini, literasi jadi kunci untuk bertahan dan berkembang.
      Maka dari itu, kami hadir untuk membuka akses, menjembatani kesenjangan, dan memastikan bahwa tak ada satu pun yang tertinggal.
      Karena literasi bukan soal siapa kamu, dari mana asalmu, atau apa statusmu — tapi hak dasar yang harus dimiliki semua orang.
    </p>
  </div>
</section>

<!-- Riset Section -->
<section class="riset">
  <h3>BERDASARKAN RISET DITEMUKAN BAHWA</h3>
  <div class="stats">
    <div class="stat"><strong>LITERASI BACA-TULIS</strong><br>68% responden</div>
    <div class="stat"><strong>LITERASI NUMERASI</strong><br>54% responden</div>
    <div class="stat"><strong>LITERASI DIGITAL</strong><br>72% responden aktif</div>
    <div class="stat"><strong>LITERASI FINANSIAL</strong><br>Hanya 31% responden</div>
  </div>
</section>

<!-- Artikel Section -->
<section class="artikel">
  <h3>ARTIKEL TERBARU</h3>
  <div class="artikel-list">
    @foreach ($artikels as $artikel)
      <div class="artikel-item">
        <img src="{{ asset($artikel->gambar ?? 'img/default.jpg') }}" alt="{{ $artikel->judul }}">
        <h4>
          <a
            href="{{ auth()->check() ? route('artikel.show', $artikel->id) : 'javascript:void(0)' }}"
            class="artikel-link"
            @guest onclick="alert('Silakan login terlebih dahulu untuk membaca artikel lengkap.')" @endguest
          >
            {{ strtoupper(Str::words($artikel->judul, 2, '...')) }}
          </a>
        </h4>
        <p>{{ Str::limit($artikel->content_mudah, 80, '...') }}</p>
      </div>
    @endforeach
  </div>
</section>

<!-- CTA -->
<section class="cta">
  <h4>SIAPKAH ANDA UNTUK MEMBACA LEBIH BANYAK</h4>
  <p>Rasakan sensasi membaca dalam semesta kata yang membuka pikiran...</p>
  <button>PORTFOLIO</button>
  <p class="footer-quote">Aku jatuh cinta pada huruf, karena mereka tak pernah bohong.</p>
</section>

@endsection
