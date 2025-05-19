@extends('layouts.guest')

@section('title', 'Reset Password')

@section('content')
<link rel="stylesheet" href="{{ asset('css/forgotreset-password.css') }}">

<div class="auth-box">
  <h2>Reset Password</h2>

  <form method="POST" action="{{ route('password.update') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">
    <input type="email" name="email" placeholder="Email" required value="{{ old('email', $email ?? '') }}">
    <input type="password" name="password" placeholder="Password Baru" required>
    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>

    <button type="submit">Reset Password</button>
  </form>

  <div class="link">
    <a href="{{ route('login') }}">Kembali ke Login</a>
  </div>
</div>
@endsection
