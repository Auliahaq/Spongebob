<header class="main-header">
  <div class="logo-container">
    <div class="logo-circle">
      <img src="{{ asset('img/Frame.png') }}" alt="Logo">
    </div>
  </div>

  <nav class="nav-menu">
    <a href="{{ url('/home') }}">BERANDA</a>
    <a href="{{ url('/artikel') }}">ARTIKEL</a>
    <a href="{{ url('/tentang') }}">TENTANG KAMI</a>
  </nav>

  <div class="header-right">
    <div class="profile-circle">
      <img src="{{ asset('img/profile.png') }}" alt="Profil">
    </div>
    <button class="menu-button" id="sidebarToggle">
      <i class="fas fa-bars"></i>
    </button>
  </div>
</header>
