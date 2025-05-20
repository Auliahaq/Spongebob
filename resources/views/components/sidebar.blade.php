<aside class="sidebar" id="sidebar">
  <div class="sidebar-header">
    <img src="{{ asset('img/profile.png') }}" alt="Profile" class="sidebar-avatar">
    <div class="sidebar-user-info">
      <p class="sidebar-name">{{ auth()->user()->name }}</p>
      <p class="sidebar-email">{{ auth()->user()->email }}</p>
    </div>
  </div>

  <nav class="sidebar-menu">
    <a href="{{ url('/teman') }}" class="sidebar-link">Teman</a>
    <a href="{{ url('/koleksi') }}" class="sidebar-link">Koleksi</a>
    <a href="{{ url('/performa') }}" class="sidebar-link">Performaku</a>

    {{-- Link Keluar --}}
    <a href="#"
       class="sidebar-link"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
      Keluar
    </a>

    {{-- Form logout tersembunyi --}}
    <form id="logout-form"
          action="{{ route('logout') }}"
          method="POST"
          style="display: none;">
      @csrf
    </form>
  </nav>
</aside>

<div id="sidebar-overlay"></div>
