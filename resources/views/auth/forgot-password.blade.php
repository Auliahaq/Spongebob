@extends('layouts.guest')

@section('title', 'Lupa Password')

@section('content')
<link rel="stylesheet" href="{{ asset('css/forgotreset-password.css') }}">

<div class="auth-box">
  <h2>Lupa Password</h2>

  @if (session('status'))
    <div class="success">{{ session('status') }}</div>
  @endif

  <form method="POST" action="{{ route('password.email') }}">
    @csrf
    <input type="email" name="email" placeholder="Masukkan Email Anda" required>
    <button type="submit">Kirim Link Reset</button>
  </form>

  <div class="link">
    <a href="{{ route('login') }}">Kembali ke Login</a>
  </div>
</div>
@endsection
