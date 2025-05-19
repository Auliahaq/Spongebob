@extends('layouts.guest')
@section('title', 'Daftar')

@section('content')
<div class="signup-box">
  <h2>Daftar Akun</h2>

  @if ($errors->any())
    <div class="error">{{ $errors->first() }}</div>
  @endif

  <form method="POST" action="{{ route('register') }}">
    @csrf
    <input type="text" name="name" placeholder="Nama" required value="{{ old('name') }}">
    <input type="email" name="email" placeholder="Email" required value="{{ old('email') }}">
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
    <button type="submit">Daftar</button>
  </form>

  <div class="link">
    Sudah punya akun?
    <a href="{{ route('login') }}">Login di sini</a>
  </div>
</div>
@endsection
