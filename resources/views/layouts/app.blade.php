<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{ asset('css/header.css') }}">
  @auth
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
  @endauth

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  @yield('styles')
</head>

<body>
  {{-- Header Selalu Tampil --}}
  @include('components.header')

  {{-- Sidebar Hanya untuk yang Login --}}
  @auth
    @include('components.sidebar')
  @endauth

  <main>
    @yield('content')
  </main>

  {{-- JS Sidebar hanya jika login --}}
  @auth
    <script src="{{ asset('js/sidebar.js') }}"></script>
  @endauth

  {{-- Tambahan Script dari halaman --}}
  @yield('scripts')
</body>
</html>
