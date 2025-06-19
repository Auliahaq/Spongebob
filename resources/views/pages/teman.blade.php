@extends('layouts.app')

@section('title', 'Daftar Teman')

@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/teman.css') }}">
@endsection

@section('content')
<div class="teman-wrapper">
  <h1 class="title">Daftar Teman</h1>

  {{-- Tombol Buka Modal --}}
  <button id="btn-open-modal" class="btn-add" title="Tambah Teman">+</button>

  {{-- Notifikasi --}}
  <div id="friend-alert" style="display:none; margin:1rem 0;"></div>

  {{-- Search bar --}}
  <input type="text" id="search-input" placeholder="Cari teman..." class="search-input"
    style="margin: 1rem 0; padding: .5rem; width: 100%; max-width: 400px;" />

  {{-- Permintaan Teman Masuk --}}
  @if(!empty($incomingRequests) && count($incomingRequests) > 0)
    <h3>Permintaan Pertemanan</h3>
    <ul class="friend-list">
      @foreach ($incomingRequests as $request)
        @php $sender = optional($request->user); @endphp
        <li class="friend-item">
          <div class="friend-info">
            <img src="{{ asset('storage/' . ($sender->avatar ?? 'avatars/default.png')) }}" alt="Avatar" class="avatar">
            <div class="friend-text">
              <p class="name">{{ $sender->name ?? 'Tidak dikenal' }}</p>
              <p class="email">{{ $sender->email ?? '-' }}</p>
            </div>
          </div>
          <form action="{{ route('teman.accept', $request->id) }}" method="POST" style="display:inline;">
            @csrf
            <button class="btn-accept">Terima</button>
          </form>
          <form action="{{ route('teman.decline', $request->id) }}" method="POST" style="display:inline;">
            @csrf
            <button class="btn-decline">Tolak</button>
          </form>
        </li>
      @endforeach
    </ul>
  @endif

  {{-- Daftar Teman --}}
  <ul class="friend-list" id="friend-list">
    @forelse ($friends as $friend)
      @php
        $teman = $friend->user_id === auth()->id() ? $friend->friendUser : $friend->user;
      @endphp
      <li class="friend-item">
        <div class="friend-info">
          <img src="{{ asset('storage/' . ($teman->avatar ?? 'avatars/default.png')) }}" alt="Avatar" class="avatar">
          <div class="friend-text">
            <p class="name">{{ $teman->name }}</p>
            <p class="email">{{ $teman->email }}</p>
          </div>
        </div>
        <form class="delete-form" action="{{ route('teman.destroy', $teman->name) }}" method="POST"
          onsubmit="return confirm('Yakin ingin menghapus teman ini?');">
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

{{-- MODAL TAMBAH TEMAN --}}
<div id="modalTambahTeman" class="modal hidden">
  <div class="modal-content">
    <span class="close" id="btn-close-modal">&times;</span>
    <h3>Tambah Teman</h3>
    <form id="formTambahTeman" method="POST" action="{{ route('teman.send') }}">
  @csrf
  <input type="email" name="email" id="email-teman" placeholder="Email Teman (yang sudah terdaftar)" required>
  <button type="submit" class="btn-submit">Kirim Permintaan</button>
</form>

  </div>
</div>

<div class="footer-readmore">
  <h2>Siapkah Anda Untuk Membaca Lebih Banyak</h2>
  <p>Rasakan sensasi membaca dalam semesta kata yang membuka pikiran, menghangatkan hati, dan membawamu ke tempat-tempat yang hanya bisa dijangkau lewat imajinasi…</p>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/search-friends.js') }}"></script>
<script src="{{ asset('js/friends.js') }}"></script>
<script>
  // Modal logika
  const modal = document.getElementById('modalTambahTeman');
  const openBtn = document.getElementById('btn-open-modal');
  const closeBtn = document.getElementById('btn-close-modal');

  openBtn.addEventListener('click', () => modal.classList.remove('hidden'));
  closeBtn.addEventListener('click', () => modal.classList.add('hidden'));
  window.addEventListener('click', (e) => {
    if (e.target === modal) modal.classList.add('hidden');
  });
</script>
@endsection
