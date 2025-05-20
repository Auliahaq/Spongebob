@extends('layouts.app')

@section('title', 'Daftar Teman')

@section('content')
<link rel="stylesheet" href="{{ asset('css/teman.css') }}">

<div class="teman-wrapper">
  <h1 class="title">Daftar Teman</h1>

  {{-- Form tambah teman --}}
  <form class="form-header" action="{{ route('teman.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name" placeholder="Nama Teman" required autocomplete="off" />
    <input type="email" name="email" placeholder="Email Teman" required autocomplete="off" />
    <input type="file" name="avatar" accept="image/*">
    <button type="submit" class="btn-add" title="Tambah Teman">+</button>
  </form>

  {{-- Search bar interaktif --}}
  <input 
    type="text" 
    id="search-input" 
    placeholder="Cari teman..." 
    class="search-input" 
    style="margin: 1rem 0; padding: .5rem; width: 100%; max-width: 400px;"
  >

  {{-- Daftar teman --}}
  <ul class="friend-list" id="friend-list">
    @forelse ($friends as $friend)
      <li class="friend-item">
        <div class="friend-info">
          <img src="{{ asset('img/teman/' . $friend->avatar) }}" alt="Avatar" class="avatar">
          <div class="friend-text">
            <p class="name">{{ $friend->name }}</p>
            <p class="email">{{ $friend->email }}</p>
          </div>
        </div>

        <form
          class="delete-form"
          action="{{ route('teman.destroy', $friend->name) }}"
          method="POST"
          onsubmit="return confirm('Yakin ingin menghapus teman ini?');"
        >
          @csrf
          @method('DELETE')
          <button type="submit" class="btn-delete" title="Hapus Teman">&#128465;</button>
        </form>
      </li>
    @empty
      <li>Tidak ada teman untuk ditampilkan.</li>
    @endforelse
  </ul>
</div>

<div class="footer-readmore">
  <h2>Siapkah Anda Untuk Membaca Lebih Banyak</h2>
  <p>
    Rasakan sensasi membaca dalam semesta kata yang membuka pikiran, menghangatkan hati, dan membawamu ke
    tempat-tempat yang hanya bisa dijangkau lewat imajinasi…
  </p>
</div>

{{-- Include script interaktif --}}
<script src="{{ asset('js/search-friends.js') }}"></script>
@endsection
