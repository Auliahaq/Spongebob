@extends('layouts.guest')

@section('title', 'Reset Password')

@section('content')
<link rel="stylesheet" href="{{ asset('css/forgotreset-password.css') }}">

<div class="auth-box">
    <h2>Reset Password</h2>

    {{-- Pesan sukses --}}
    @if (session('status'))
        <div class="success">{{ session('status') }}</div>
    @endif

    {{-- Error password --}}
    @error('password')
        <div class="error">{{ $message }}</div>
    @enderror

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        {{-- Token wajib dari URL --}}
        <input type="hidden" name="token" value="{{ $token }}">

        {{-- Email pengguna (wajib untuk validasi reset) --}}
        <input
            type="hidden"
            name="email"
            value="{{ old('email', $email) }}"
        >

        {{-- Password baru --}}
        <input
            type="password"
            name="password"
            placeholder="Password Baru"
            required
        >

        {{-- Konfirmasi password --}}
        <input
            type="password"
            name="password_confirmation"
            placeholder="Konfirmasi Password"
            required
        >

        <button type="submit">Reset Password</button>
    </form>

    <div class="link">
        <a href="{{ route('login') }}">Kembali ke Login</a>
    </div>
</div>
@endsection
