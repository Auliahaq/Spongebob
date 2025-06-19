<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('css/login-register.css') }}">

    @stack('styles')
</head>
<body>
    @yield('content')

    @stack('scripts')
</body>
</html>
