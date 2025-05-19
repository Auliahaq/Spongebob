<aside class="sidebar" id="sidebar">
  <div class="sidebar-header">
    <img src="{{ asset('img/profile.png') }}" alt="Profile" class="sidebar-avatar">
    <div class="sidebar-user-info">
      <p class="sidebar-name">Rafi Natanginrat</p>
      <p class="sidebar-email">rafi@example.com</p>
    </div>
  </div>

  <nav class="sidebar-menu">
    <a href="{{ url('/teman') }}" class="sidebar-link">Teman</a>
    <a href="{{ url('/koleksi') }}" class="sidebar-link">Koleksi</a>
    <a href="{{ url('/performa') }}" class="sidebar-link">Performaku</a>
    <a href="#" class="sidebar-link logout">Keluar</a>
  </nav>
</aside>

<div id="sidebar-overlay"></div>
