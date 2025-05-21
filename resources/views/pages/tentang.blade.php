@extends('layouts.app')

@section('title', 'Tentang Kami — Lexica')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/tentang.css') }}">
@endsection

@section('content')

  {{-- Hero Section --}}
  <section class="hero">
    <h1>TENTANG <br> KAMI</h1>
    <p>
      Selamat datang di Lexica, ruang di mana literasi menjadi jembatan menuju masa depan yang lebih cerah. 
      Kami adalah tim yang berkomitmen untuk membuka akses pengetahuan dan memberdayakan setiap individu melalui bacaan yang bermakna.
      Di Lexica, kami percaya bahwa literasi bukan sekadar kemampuan membaca dan menulis, tapi kunci untuk memahami, berpikir kritis, dan berani bersuara. 
      Dengan pendekatan yang inklusif dan konten yang relevan, kami hadir untuk menemani perjalanan literasi Anda — kapan saja, di mana saja.
    </p>
  </section>

  {{-- Team Section --}}
  <section class="tim">
    <h2>Kelompok Spongebob</h2>
     <p>
    Halo semuanya! 👋<br>
    Kami adalah Kelompok 4 “Spongebob”.
  </p>
  <p>
    Aplikasi ini kami kembangkan sebagai tugas akhir Mata Kuliah 
    Pengembangan Aplikasi Web.
  </p>
    <div class="cards">
      @php
        // Jika nanti di-pass dari Controller, pindpahkan array ini ke sana.
        $team = [
          ['name'=>'Kaneysa Nadetta Julief', 'role'=>'',    'img'=>'kaney.jpg',  'bio'=>'235150200111067'],
          ['name'=>'Aulia Haq',   'role'=>'',    'img'=>'aul.jpg',    'bio'=>'235150201111079'],
          ['name'=>'Rania Putri Zayyanti', 'role'=>'',    'img'=>'rania.jpg',  'bio'=>'235150201111073'],
          ['name'=>'Aurelia Salsabilla Yunanto Putri', 'role'=>'',    'img'=>'aurel.jpg',  'bio'=>'235150201Z111075'],
        ];
      @endphp

      @foreach ($team as $member)
        <div class="card">
          <img 
            src="{{ asset('img/team/' . $member['img']) }}"
            alt="{{ $member['name'] }}"
            class="card-img"
          >

          <h3>{{ $member['name'] }}</h3>
          <p class="role">{{ $member['role'] }}</p>
          <p class="desc">
            {{ $member['bio'] }}
          </p>

          <div class="sosmed">
            {{-- Contoh ikon sosmed:
              <a href="#"><i class="fab fa-twitter"></i></a> --}}
          </div>
        </div>
      @endforeach
    </div>
  </section>

  {{-- Artikel Section --}}
  @isset($artikels)
    <section class="artikel">
      <h3>ARTIKEL TERBARU</h3>

      @if ($artikels->isEmpty())
        <p>Tidak ada artikel untuk ditampilkan.</p>
      @else
        <div class="artikel-list">
          @foreach ($artikels as $artikel)
            <div class="artikel-item">
              <img 
                src="{{ asset($artikel->gambar ?? 'img/default.jpg') }}" 
                alt="{{ $artikel->judul }}"
                class="artikel-img"
              >

              <h4>
                <a 
                  href="{{ route('artikel.show', $artikel->id) }}" 
                  class="artikel-link"
                >
                  {{ Str::upper(Str::words($artikel->judul, 2, '...')) }}
                </a>
              </h4>

              <p>{{ Str::limit($artikel->content_mudah, 80, '...') }}</p>
            </div>
          @endforeach
        </div>
      @endif
    </section>
  @endisset

  {{-- CTA Section --}}
  <section class="cta">
    <h4>SIAPKAH ANDA UNTUK MEMBACA LEBIH BANYAK</h4>
    <p>Rasakan sensasi membaca dalam semesta kata yang membuka pikiran...</p>
    <button type="button" class="btn-portfolio">PORTFOLIO</button>
    <p class="footer-quote">&ldquo;Aku jatuh cinta pada huruf, karena mereka tak pernah bohong.&rdquo;</p>
  </section>

@endsection
