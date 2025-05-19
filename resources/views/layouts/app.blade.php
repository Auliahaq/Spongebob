<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{ asset('css/header.css') }}">
  <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  @yield('styles')  
</head>

<body>
  @include('components.header')
  @include('components.sidebar')

  <main>
    @yield('content')
  </main>

  <script src="{{ asset('js/sidebar.js') }}"></script>
</body>
</html>
