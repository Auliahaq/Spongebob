@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<div class="login-box">
  <h2>Login Akun</h2>

  @if (session('error'))
    <div class="error">{{ session('error') }}</div>
  @endif

  @if (session('success'))
    <div class="success">{{ session('success') }}</div>
  @endif

  <form method="POST" action="{{ route('login') }}">
    @csrf
    <input type="email" name="email" placeholder="Email" required value="{{ old('email') }}">
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
  </form>
  <div class="text-center mt-2">
    <a href="{{ route('password.request') }}">Lupa password?</a>
  </div>

  <div class="link">
    Belum punya akun?
    <a href="{{ route('register') }}">Daftar di sini</a>
  </div>
</div>
@endsection
