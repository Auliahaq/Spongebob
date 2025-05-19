@extends('layouts.app')

@section('title', 'Performa Membacaku')

@section('content')
<link rel="stylesheet" href="{{ asset('css/performa.css') }}">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  window.chartData = {
    kategoriLabels: @json($kategoriLabels),
    kategoriData: @json($kategoriData),
    tingkatLabels: @json($tingkatLabels),
    tingkatData: @json($tingkatData)
  };
</script>
<script src="{{ asset('js/chart-script.js') }}"></script>

<div class="performa-membacaku">
  <div class="frame">
    <div class="text-wrapper-2">Performa Membacaku</div>
    <div class="text-wrapper-3">Analisis Grafik</div>

    <div class="container-bacaan">
      <div class="bacaan-item">
        <div class="ikon">
          <img class="ellipse-bg" src="{{ asset('img/Ellipse-4.png') }}" />
          <img class="ikon-atas" src="{{ asset('img/Vector.png') }}" />
        </div>
        <div class="deskripsi">
          <div class="judul">Total Bacaan</div>
          <div class="jumlah">3 ARTIKEL</div>
        </div>
      </div>
<!-- Bacaan Lanjutan -->
      <div class="bacaan-item">
        <div class="ikon">
          <img class="ellipse-bg" src="{{ asset('img/Ellipse-4.png') }}" alt="Lingkaran">
          <img class="ikon-atas" src="{{ asset('img/Vector2.png') }}" alt="Ikon Lanjutan">
        </div>
        <div class="deskripsi">
          <div class="judul">Bacaan Lanjutan</div>
          <div class="jumlah">3 ARTIKEL</div>
        </div>
      </div>

      <!-- Bacaan Menengah -->
      <div class="bacaan-item">
        <div class="ikon">
          <img class="ellipse-bg" src="{{ asset('img/Ellipse-4.png') }}" alt="Lingkaran">
          <img class="ikon-atas" src="{{ asset('img/menengah.png') }}" alt="Ikon Menengah">
        </div>
        <div class="deskripsi">
          <div class="judul">Bacaan Menengah</div>
          <div class="jumlah">3 ARTIKEL</div>
        </div>
      </div>

      <!-- Bacaan Pemula -->
      <div class="bacaan-item">
        <div class="ikon">
          <img class="ellipse-bg" src="{{ asset('img/Ellipse-4.png') }}" alt="Lingkaran">
          <img class="ikon-atas" src="{{ asset('img/pemula.png') }}" alt="Ikon Pemula">
        </div>
        <div class="deskripsi">
          <div class="judul">Bacaan Pemula</div>
          <div class="jumlah">3 ARTIKEL</div>
        </div>
      </div>    </div>

    <div class="overlap-7">
      <div class="reads-based-on">READS BASED ON CATEGORY</div>
      <div class="chart-wrapper"><canvas id="chartKategori"></canvas></div>

      <div class="reads-based-on-diff">READS BASED ON DIFF</div>
      <div class="chart-wrapper"><canvas id="chartTingkat"></canvas></div>

      <div class="bawah">
        <div class="box-content">
          <p class="siapkah-anda-untuk">SIAPKAH ANDA UNTUK MEMBACA LEBIH BANYAK</p>
          <p class="p">Rasakan membaca seperti bermain sosial media</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
