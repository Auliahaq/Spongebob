<header class="site-header">
  <div class="header-container">
    <!-- Logo -->
    <a href="{{ url('/') }}" class="logo">
      <img src="{{ asset('img/logo-lexica.png') }}" alt="Logo Lexica">
    </a>

    <!-- Navigasi Tengah -->
    <nav class="nav-links">
      <a href="{{ url('/') }}">BERANDA</a>
      <a href="{{ url('/artikel') }}">ARTIKEL</a>
      <a href="{{ url('/tentang-kami') }}">TENTANG KAMI</a>
    </nav>

    <!-- Profil & Hamburger -->
    <div class="header-actions">
      @auth
        <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}" class="profile-img">
      @else
        <img src="{{ asset('img/default-avatar.png') }}" alt="Guest" class="profile-img">
      @endauth
      <button id="sidebarToggle" class="hamburger">
        <img src="{{ asset('img/menu-icon.svg') }}" alt="Menu">
      </button>
    </div>
  </div>
</header>
