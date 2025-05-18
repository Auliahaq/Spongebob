@extends('layouts.app')

@section('title', 'Beranda — Lexica')

@section('content')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">

<div class="hero">
  <div class="intro">
    <h1>LEXICA</h1>
    <img src="{{ asset('img/home-lexica-splash.png') }}" alt="Lexica Hero" class="hero-img">
    <p class="quote">"Kata demi kata, aku menyusun jendela menuju semesta yang belum kutahu."</p>
  </div>
</div>

<section class="section literasi">
  <div class="literasi-box">
    <h2>LITERASI ADALAH HAK SEMUA ORANG</h2>
    <p>
      Setiap individu berhak untuk bisa membaca, menulis, memahami, dan berpikir kritis. Bukan cuma soal buku atau teks, tapi tentang kemampuan untuk memahami dunia, menilai informasi, dan menyuarakan pendapat. Di era digital yang serba cepat ini, literasi jadi kunci untuk bertahan dan berkembang. Maka dari itu, kami hadir untuk membuka akses, menjembatani kesenjangan, dan memastikan bahwa tak ada satu pun yang tertinggal. Karena literasi bukan soal siapa kamu, dari mana asalmu, atau apa statusmu — tapi hak dasar yang harus dimiliki semua orang.
    </p>
  </div>
</section>


<section class="section riset">
  <h3>BERDASARKAN RISET DITEMUKAN BAHWA</h3>
  <div class="stats">
    <div class="stat"><strong>Literasi Baca-Tulis</strong><br>68% responden</div>
    <div class="stat"><strong>Literasi Numerasi</strong><br>54% responden</div>
    <div class="stat"><strong>Literasi Digital</strong><br>72% responden aktif</div>
    <div class="stat"><strong>Literasi Finansial</strong><br>Hanya 31% responden</div>
  </div>
</section>

<section class="artikel-section">
  <div class="artikel">
    <h3>ARTIKEL TERBARU</h3>
    <div class="artikel-list">
      <!-- Artikel Items -->
    </div>
  </div>
</section>

<section class="call-to-action-section">
  <div class="call-to-action">
    <h4>SIAPKAH ANDA UNTUK MEMBACA LEBIH BANYAK</h4>
    <p>Rasakan sensasi membaca...</p>
    <button>PORTFOLIO</button>
    <p class="footer-quote">Aku jatuh cinta pada huruf...</p>
  </div>
</section>
