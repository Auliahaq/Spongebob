@extends('layouts.guest')

@section('title', 'Login')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/login-register.css') }}">
@endsection

@section('content')
<div class="auth-layout">

  {{-- Gambar Kiri --}}
  <div class="auth-illustration">
    <img src="{{ asset('img/logo-login.png') }}" alt="Ilustrasi Lexica">
  </div>

  {{-- Form Login --}}
  <div class="login-box">
    <h2>Login Akun</h2>

    {{-- Alert error / sukses --}}
    @if (session('error'))
      <div class="error">{{ session('error') }}</div>
    @endif
    @if (session('success'))
      <div class="success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf

      {{-- Input Email --}}
      <input type="email" name="email" placeholder="Email" required value="{{ old('email') }}">

      {{-- Input Password + Toggle --}}
     <div class="password-wrapper">
  <input type="password" name="password" id="password" placeholder="Password" required>
  <span id="togglePassword" class="toggle-password">👁</span>
</div>


      <button type="submit">Login</button>
    </form>

    {{-- Navigasi Tambahan --}}
    <div class="link">
      <a href="{{ route('password.request') }}">Lupa password?</a>
    </div>
    <div class="link">
      Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  // Toggle Password Visibility
  document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    toggle.addEventListener('click', () => {
      const type = password.type === 'password' ? 'text' : 'password';
      password.type = type;
      toggle.textContent = type === 'password' ? '👁' : '🙈';
    });
    </script>

    <script>
    // Efek Hover Gambar
    const img = document.querySelector('.auth-illustration img');
    if (img) {
      img.addEventListener('mousemove', (e) => {
        const rect = img.getBoundingClientRect();
        const x = (e.clientX - rect.left) / rect.width - 0.5;
        const y = (e.clientY - rect.top) / rect.height - 0.5;
        img.style.transform = `scale(1.08) rotateX(${y * 10}deg) rotateY(${x * 10}deg)`;
      });

      img.addEventListener('mouseleave', () => {
        img.style.transform = 'scale(1)';
      });
    }
  });
</script>
@endsection
