@extends('layouts.app')

@section('title', 'Koleksi Saya')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/koleksi.css') }}">
@endsection

@section('content')
<div class="koleksi-wrapper">
    <h2>Artikel dalam Koleksimu</h2>

    <!-- AJAX Search Form -->
    <div class="koleksi-search">
        <input type="text" id="searchInput" placeholder="Cari judul artikel..." value="{{ $search ?? '' }}">
        <button type="button" id="searchBtn">Cari</button>
    </div>

    <!-- Kontainer AJAX hasil -->
    <div class="koleksi-list" id="koleksiList">
        @include('partials.koleksi-artikel-list', ['artikels' => $artikels])
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#searchBtn').on('click', function () {
        const query = $('#searchInput').val();

        $.ajax({
            url: "{{ route('koleksi.ajaxSearch') }}",
            method: 'GET',
            data: { query },
            success: function (res) {
                $('#koleksiList').html(res.html);
            },
            error: function () {
                alert("❌ Gagal memuat hasil pencarian.");
            }
        });
    });

    // BONUS: auto search saat tekan Enter
    $('#searchInput').on('keypress', function (e) {
        if (e.which === 13) {
            e.preventDefault();
            $('#searchBtn').click();
        }
    });
</script>
@endsection
