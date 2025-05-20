@extends('layouts.guest')

@section('title', 'Reset Password')

@section('content')
<link rel="stylesheet" href="{{ asset('css/forgotreset-password.css') }}">
<div class="auth-box">
  <h2>Reset Password</h2>

  {{-- tampilan error/success --}}
  @if(session('status'))
    <div class="success">{{ session('status') }}</div>
  @endif
  @error('password')
    <div class="error">{{ $message }}</div>
  @enderror

  <form method="POST" action="{{ route('password.update') }}">
    @csrf

    {{-- token dari URL --}}
    <input type="hidden" name="token" value="{{ $token }}">
    {{-- email disembunyikan, tapi tetap dikirim --}}
    <input type="hidden" name="email" value="{{ $email }}">

    {{-- hanya password & konfirmasi --}}
    <input type="password"
           name="password"
           placeholder="Password Baru"
           required>

    <input type="password"
           name="password_confirmation"
           placeholder="Konfirmasi Password"
           required>

    <button type="submit">Reset Password</button>
  </form>

  <div class="link">
    <a href="{{ route('login') }}">Kembali ke Login</a>
  </div>
</div>
@endsection
