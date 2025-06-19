@extends('layouts.guest')

@section('title', 'Selamat Datang di Lexica')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">
@endsection

@section('content')
<div class="hero-section">
  <h1>Selamat Datang di <span class="highlight">Lexica</span></h1>
  <p>Platform membaca modern untuk semua tingkat literasi.</p>
  <div class="cta-buttons">
    <a href="{{ route('login') }}" class="btn-primary">Masuk</a>
    <a href="{{ route('register') }}" class="btn-outline">Daftar Gratis</a>
  </div>
</div>

<div class="fitur-section">
  <h2>Mengapa Lexica?</h2>
  <ul>
    <li>✓ Pilihan artikel dengan tingkat kesulitan berbeda</li>
    <li>✓ Tracking performa membaca</li>
    <li>✓ Fitur AI untuk membantu pemahaman</li>
  </ul>
</div>
@endsection
