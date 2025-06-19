<header class="main-header">
  {{-- Logo --}}
  <a href="{{ route('home') }}" class="logo-circle">
    <img src="{{ asset('img/logo.png') }}" alt="Logo">
  </a>

  {{-- Navigasi Utama --}}
  <nav class="nav-menu">
    <a href="{{ route('home') }}">BERANDA</a>
    <a href="{{ route('artikel.index') }}"
       @guest onclick="guestOnlyNotice(event)" href="javascript:void(0);" @endguest>
       ARTIKEL
    </a>
    <a href="{{ route('tentang') }}">TENTANG KAMI</a>
  </nav>

  {{-- Bagian Kanan Header --}}
  <div class="header-right">
    @auth
      {{-- Jika sudah login, tampilkan avatar --}}
      <div class="profile-circle" onclick="window.location.href='{{ route('profil.edit') }}'" style="cursor: pointer;">
        <img 
          src="{{ Auth::user()->avatar 
              ? asset('storage/' . Auth::user()->avatar) 
              : asset('img/profile.png') }}" 
          alt="Profil" 
          style="object-fit: cover; width: 100%; height: 100%; border-radius: 50%;">
      </div>
    @else
      {{-- Jika belum login, tampilkan Login dan Daftar --}}
      <a href="{{ route('login') }}" class="login-link">Masuk</a>
      <a href="{{ route('register') }}" class="btn-outline" style="margin-left: 0.5rem;">Daftar</a>
    @endauth

    {{-- Tombol Sidebar/Mobile --}}
    @auth
    <button class="menu-button" id="sidebarToggle">
      <i class="fas fa-bars"></i>
    </button>
    @endauth
  </div>
</header>

@guest
<script>
  function guestOnlyNotice(event) {
    event.preventDefault();
    alert("Silakan login terlebih dahulu untuk mengakses artikel.");
  }
</script>
@endguest
