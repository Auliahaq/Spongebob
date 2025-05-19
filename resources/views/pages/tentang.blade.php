@extends('layouts.app')

@section('title', 'Tentang Kami — Lexica')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/tentang.css') }}">
@endpush

@section('content')

<section class="hero">
  <h1>TENTANG <br> KAMI</h1>
  <p>

    Selamat datang di Lexica, ruang di mana literasi menjadi jembatan menuju masa depan yang lebih cerah. Kami adalah tim yang berkomitmen untuk membuka akses pengetahuan dan memberdayakan setiap individu melalui bacaan yang bermakna.
    Di Lexica, kami percaya bahwa literasi bukan sekadar kemampuan membaca dan menulis, tapi kunci untuk memahami, berpikir kritis, dan berani bersuara. Dengan pendekatan yang inklusif dan konten yang relevan, kami hadir untuk menemani perjalanan literasi Anda — kapan saja, di mana saja.


  </p>
</section>

<section class="tim">
  <h2>Kelompok Spongebob</h2>
  <p>masih lorem ipsum</p>

  <div class="cards">
    @foreach (['Kaney', 'Aul', 'Rania', 'Aurel'] as $name)
      <div class="card">
        <div class="card-img"></div>
        <h3>{{ $name }}</h3>
        <p class="role">PAW</p>
        <p class="desc">
          Worem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis.
        </p>
        <div class="sosmed">
        </div>
      </div>
    @endforeach
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
      <a href="{{ route('artikel.show', $artikel->id) }}" class="artikel-link">
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
