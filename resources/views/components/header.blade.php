<header class="bg-[#0B1E4F] w-full py-4 px-6 flex items-center justify-between">
    <!-- Logo kiri -->
    <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-6 h-6">
    </div>

    <!-- Menu Tengah -->
    <nav class="flex space-x-8 text-white text-sm font-semibold tracking-widest">
        <a href="{{ url('/home') }}" class="hover:underline">BERANDA</a>
        <a href="{{ url('/artikel') }}" class="hover:underline">ARTIKEL</a>
        <a href="{{ url('/tentang') }}" class="hover:underline">TENTANG KAMI</a>
    </nav>

    <!-- Profil dan Hamburger -->
    <div class="flex items-center space-x-4">
        <img src="{{ asset('img/profile.jpg') }}" alt="Profil" class="w-8 h-8 rounded-full object-cover">
        <button class="text-white text-2xl focus:outline-none">
            <i class="fas fa-bars"></i>
        </button>
    </div>
</header>
