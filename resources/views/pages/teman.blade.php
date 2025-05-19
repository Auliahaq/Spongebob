@extends('layouts.app')

@section('title', 'Daftar Teman')

@section('content')
<style>
  /* Reset dan box sizing */
  * {
    box-sizing: border-box;
  }

  body {
    font-family: 'Poppins', sans-serif;
    background-color: #f6f7fb;
    color: #111827;
    margin: 0;
  }

  .teman-wrapper {
    max-width: 900px;
    margin: 2rem auto 4rem;
    background-color: #f6f7fb;
    border-radius: 20px;
    padding: 2rem 2.5rem 3rem;
    box-shadow: 0 5px 15px rgb(0 0 0 / 0.05);
  }

  h1.title {
    font-weight: 600;
    font-size: 1.25rem;
    margin-bottom: 1.5rem;
    text-align: center;
    color: #111827;
  }

  /* Header form area */
  .form-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
  }

  .form-header input[type="text"],
  .form-header input[type="email"],
  .form-header input[type="url"] {
    flex: 1;
    padding: 0.6rem 1rem;
    border-radius: 30px;
    border: 1.5px solid #d1d5db;
    font-size: 0.9rem;
    color: #374151;
    outline-offset: 3px;
    transition: border-color 0.3s ease;
  }

  .form-header input[type="text"]:focus,
  .form-header input[type="email"]:focus,
  .form-header input[type="url"]:focus {
    border-color: #3b82f6;
  }

  .btn-add {
    width: 40px;
    height: 40px;
    background-color: #3b82f6;
    border: none;
    border-radius: 50%;
    font-size: 1.5rem;
    font-weight: 700;
    color: white;
    cursor: pointer;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: background-color 0.3s ease;
  }

  .btn-add:hover {
    background-color: #2563eb;
  }

  /* List teman */
  ul.friend-list {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  li.friend-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #fff;
    border-radius: 15px;
    padding: 1rem 1.5rem;
    margin-bottom: 1rem;
    box-shadow: 0 3px 6px rgb(0 0 0 / 0.05);
  }

  /* Bagian info teman */
  .friend-info {
    display: flex;
    align-items: center;
    gap: 1rem;
  }

  .friend-info img.avatar {
    width: 56px;
    height: 56px;
    object-fit: cover;
    border-radius: 15px;
    flex-shrink: 0;
  }

  .friend-text {
    display: flex;
    flex-direction: column;
  }

  .friend-text .name {
    font-weight: 700;
    font-size: 1rem;
    color: #111827;
    margin-bottom: 0.2rem;
  }

  .friend-text .email {
    font-size: 0.85rem;
    color: #6b7280;
  }

  /* Tombol hapus */
  form.delete-form {
    margin: 0;
  }

  button.btn-delete {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 1.5rem;
    color: #6b7280;
    transition: color 0.2s ease;
  }

  button.btn-delete:hover {
    color: #ef4444;
  }

  /* Footer */
  .footer-readmore {
    background-color: #112a66;
    color: white;
    text-align: center;
    padding: 3rem 1rem 3rem;
    border-radius: 0 0 20px 20px;
    margin-top: 2rem;
  }

  .footer-readmore h2 {
    margin: 0 0 1rem;
    font-weight: 700;
    font-size: 1.125rem;
    text-transform: uppercase;
    letter-spacing: 0.1em;
  }

  .footer-readmore p {
    margin: 0 0 0.7rem;
    font-size: 0.9rem;
    line-height: 1.4;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
  }

  .footer-readmore p:last-child {
    font-style: italic;
    font-weight: 600;
  }
</style>

<div class="teman-wrapper">
  <h1 class="title">Daftar Teman</h1>

  <!-- Form tambah teman -->
  <form class="form-header" action="{{ route('teman.store') }}" method="POST" novalidate>
    @csrf
    <input type="text" name="name" placeholder="Nama Teman" required autocomplete="off" />
    <input type="email" name="email" placeholder="Email Teman" required autocomplete="off" />
    <input type="file" name="avatar" accept="img/*"> <!-- Input untuk gambar avatar -->
    <button type="submit" class="btn-add" title="Tambah Teman">+</button>
  </form>

  <!-- List teman -->
  <ul class="friend-list">
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
    tempat-tempat yang hanya bisa dijangkau lewat imajinasi, membaca dalam ruang sunyi yang penuh makna, di
    mana setiap kalimat adalah jendela menuju dunia baru yang menunggu untuk ditemukan..
  </p>
  <p>Membaca adalah seni diam yang penuh warna.</p>
</div>
@endsection
