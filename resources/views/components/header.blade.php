<header class="main-header">
    <!-- Logo bundar kiri -->
    <div class="logo-container">
        <div class="logo-circle">
            <img src="{{ asset('img/frame.png') }}" alt="Logo">
        </div>
    </div>

    <!-- Menu Tengah -->
    <nav class="nav-menu">
        <a href="{{ url('/home') }}">BERANDA</a>
        <a href="{{ url('/artikel') }}">ARTIKEL</a>
        <a href="{{ url('/tentang') }}">TENTANG KAMI</a>
    </nav>

    <!-- Profil dan Hamburger -->
    <div class="header-right">
        <div class="profile-circle">
            <img src="{{ asset('img/profile.png') }}" alt="Profil">
        </div>
        <button class="menu-button">
            <i class="fas fa-bars"></i>
        </button>
    </div>
</header>
