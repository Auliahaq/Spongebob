@extends('layouts.app')

@section('title', 'Tentang Kami — Lexica')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/tentang.css') }}">
@endpush

@section('content')

<section class="hero">
  <h1>TENTANG <br> KAMI</h1>
  <p>
    Selamat datang di [Nama Website], tempat di mana inovasi bertemu dengan kenyamanan! Kami adalah tim yang berdedikasi
    untuk memberikan solusi terbaik di bidang [industri atau layanan yang Anda tawarkan, misalnya: desain grafis,
    pendidikan online, teknologi, dll.]. Kami percaya bahwa setiap individu atau perusahaan memiliki potensi untuk
    berkembang dengan menggunakan alat dan pengetahuan yang tepat.
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
          <span>📘</span>
          <span>🐦</span>
          <span>📷</span>
        </div>
      </div>
    @endforeach
  </div>
</section>

<section class="artikel">
  <h2>ARTIKEL TERBARU</h2>
  <div class="artikel-list">
    <div class="artikel-item">
      <img src="{{ asset('img/tech.jpg') }}" alt="Teknologi">
      <h3>TEKNOLOGI</h3>
      <p>Apakah processor laptop MSI cukup untuk mahasiswa Teknik Informatika?</p>
    </div>
    <div class="artikel-item">
      <img src="{{ asset('img/seni.jpg') }}" alt="Seni">
      <h3>SENI</h3>
      <p>Karya van Gogh mana yang disukai masyarakat umum? apakah Starry Night?</p>
    </div>
    <div class="artikel-item">
      <img src="{{ asset('img/health.jpg') }}" alt="Kesehatan">
      <h3>KESEHATAN</h3>
      <p>Apa yang terjadi jika gigi kita berlubang sangat parah?</p>
    </div>
  </div>
</section>

<section class="cta">
  <h3>SIAPKAH ANDA UNTUK MEMBACA LEBIH BANYAK</h3>
  <p>Rasakan sensasi membaca dalam semesta kata yang membuka pikiran, menghangatkan hati, dan membawamu ke tempat-tempat yang hanya bisa</p>
  <button>PORTFOLIO</button>
  <p class="quote">Aku jatuh cinta pada huruf, karena mereka tak pernah bohong.</p>
</section>
@endsection
