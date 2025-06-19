@extends('layouts.guest')

@section('title', 'Daftar')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/login-register.css') }}">
@endsection

@section('content')
<div class="auth-layout">
  <div class="auth-illustration">
    <img src="{{ asset('img/logo-login.png') }}" alt="Lexica Register">
  </div>

  <div class="signup-box">
    <h2>Daftar Akun</h2>

    @if ($errors->any())
      <div class="error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
      @csrf
      <input type="text" name="name" placeholder="Nama" required value="{{ old('name') }}">
      <input type="email" name="email" placeholder="Email" required value="{{ old('email') }}">

      {{-- Input Password --}}
      <div class="password-wrapper">
        <input type="password" name="password" id="reg-password" placeholder="Password" required>
        <!-- <span class="toggle-password" onclick="togglePassword('reg-password')">👁</span> -->
      </div>

      {{-- Konfirmasi Password --}}
      <div class="password-wrapper">
        <input type="password" name="password_confirmation" id="confirm-password" placeholder="Konfirmasi Password" required>
      </div>

      <button type="submit">Daftar</button>
    </form>

    <div class="link">
      Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  function togglePassword(id) {
    const input = document.getElementById(id);
    input.type = input.type === 'password' ? 'text' : 'password';
  }
</script>
