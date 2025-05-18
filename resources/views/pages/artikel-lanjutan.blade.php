@extends('layouts.app')

<?php
// You can add session management here
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
session_start();

// Example database connection (uncomment and modify as needed)

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lexica_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Example of getting article data (modify according to your database structure)

$article_id = isset($_GET['id']) ? $_GET['id'] : 1;
$sql = "SELECT * FROM artikel WHERE id = $article_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $article = $result->fetch_assoc();
    $title = $article['judul'];
    $author = $article['author'];
    $image = $article['gambar'];
    // Get content for each literacy level
    $lanjutan_content = $article['lanjutan_content'];
    $menengah_content = $article['menengah_content'];
    $pemula_content = $article['pemula_content'];
} else {
    // Default values if article not found
    $title = "PENGARUH PENDIDIKAN KESEHATAN TERHADAP PERILAKU HIDUP BERSIH DAN SEHAT PADA REMAJA";
    $author = "Kontan -- Ringgana Wandy Wiguna";
    $image = "anak-sampah.png";
    $lanjutan_content = "<strong>ABSTRAK:</strong> Penelitian ini bertujuan untuk mengevaluasi pengaruh pendidikan kesehatan terhadap perilaku hidup bersih dan sehat (PHBS) pada remaja... [isi lanjutan]";
    $menengah_content = "<strong>MENENGAH:</strong> Dalam tahapan menengah, remaja mulai menunjukkan pemahaman lebih baik terhadap PHBS... [isi menengah]";
    $pemula_content = "<strong>PEMULA:</strong> Pengenalan awal pentingnya kebersihan pribadi dan lingkungan mulai dikenalkan melalui kegiatan sederhana... [isi pemula]";
}


// For now, using hardcoded values
// $title = "PENGARUH PENDIDIKAN KESEHATAN TERHADAP PERILAKU HIDUP BERSIH DAN SEHAT PADA REMAJA";
// $author = "Kontan -- Ringgana Wandy Wiguna";
// $image = "anak-sampah.png";
// $lanjutan_content = "<strong>ABSTRAK:</strong> Penelitian ini bertujuan untuk mengevaluasi pengaruh pendidikan kesehatan terhadap perilaku hidup bersih dan sehat (PHBS) pada remaja... [isi lanjutan]";
// $menengah_content = "<strong>MENENGAH:</strong> Dalam tahapan menengah, remaja mulai menunjukkan pemahaman lebih baik terhadap PHBS... [isi menengah]";
// $pemula_content = "<strong>PEMULA:</strong> Pengenalan awal pentingnya kebersihan pribadi dan lingkungan mulai dikenalkan melalui kegiatan sederhana... [isi pemula]";

// Get the active tab (default to lanjutan if not specified)
$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'lanjutan';
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Detail Artikel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap"
      rel="stylesheet"
    />
    <!-- <style>
      body {
        font-family: 'Inter', sans-serif;
      }
      
      .article-header {
        background-color: #0B1E4F;
        color: white;
        padding: 2rem 1.5rem;
        text-align: center;
      }
      
      .article-title {
        font-size: 1.5rem;
        font-weight: 700;
        line-height: 1.3;
        margin-bottom: 1.5rem;
      }
      
      .article-tools {
        display: flex;
        justify-content: center;
        gap: 1.5rem;
      }
      
      .tool {
        display: flex;
        flex-direction: column;
        align-items: center;
        font-size: 0.75rem;
      }
      
      .article-intro {
        max-width: 800px;
        margin: 2rem auto;
        padding: 0 1rem;
      }
      
      .article-intro img {
        width: 100%;
        height: auto;
        margin-bottom: 1rem;
      }
      
      .article-meta {
        color: #666;
        font-size: 0.875rem;
        margin-bottom: 2rem;
      }
      
      .literasi-tabs {
        display: flex;
        justify-content: center;
        max-width: 800px;
        margin: 0 auto 1rem;
        gap: 1rem;
        padding: 0 1rem;
      }
      
      .tab-btn {
        background-color: #E0E0E0;
        padding: 0.5rem 1.5rem;
        border-radius: 4px;
        font-weight: 600;
        transition: all 0.3s;
      }
      
      .tab-btn.active {
        background-color: #0B1E4F;
        color: white;
      }
      
      .literasi-content {
        max-width: 800px;
        margin: 0 auto 3rem;
        padding: 1.5rem;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      }
      
      .tab-content {
        display: none;
      }
      
      .tab-content.active {
        display: block;
      }
      
      .active-link {
        position: relative;
      }
      
      .active-link:after {
        content: '';
        position: absolute;
        bottom: -1rem;
        left: 50%;
        transform: translateX(-50%);
        width: 4px;
        height: 4px;
        background-color: white;
        border-radius: 50%;
      }
      
      /* Sidebar styles */
      #sidebar {
        transition: transform 0.3s ease-in-out;
      }
      
      .menu-item {
        padding: 0.75rem 1rem;
        border-radius: 4px;
        font-weight: 500;
        text-align: left;
        transition: background-color 0.2s;
      }
      
      .menu-item:hover {
        background-color: #f3f4f6;
      }
    </style> -->
    <link rel="stylesheet" href="artikel-detail.css">
  </head>

  <body class="bg-[#E9EBEC] min-h-screen flex flex-col relative">
    <!-- Navbar - matching the index.html style -->
    <nav class="bg-[#0B1E4F] flex items-center justify-between px-4 md:px-8 py-4 border-b border-[#1A2E6E] relative z-30">
      <div class="flex items-center space-x-4">
        <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center">
          <img
            alt="Icon of an open book"
            class="w-6 h-6"
            src="https://storage.googleapis.com/a1aa/image/cf704e49-7948-4f9c-cf4d-49a99f94ce81.jpg"
          />
        </div>
      </div>
      <div class="flex-1 flex justify-center space-x-8 text-white text-xs font-semibold tracking-widest">
        <a href="homepage.php" class="hover:underline nav-link">BERANDA</a>
        <a href="artikel.php" class="hover:underline nav-link active-link">ARTIKEL</a>
        <a href="aboutus.php" class="hover:underline nav-link">TENTANG KAMI</a>
      </div>
      <div class="flex items-center space-x-6 ml-auto">
        <?php if(isset($_SESSION['user'])): ?>
        <img
          alt="User profile"
          class="w-8 h-8 rounded-full object-cover hidden sm:block"
          src="<?php echo isset($_SESSION['profile_img']) ? $_SESSION['profile_img'] : 'https://storage.googleapis.com/a1aa/image/a0344b43-aba6-4fc2-e4a7-c8f861a01589.jpg'; ?>"
        />
        <?php endif; ?>
        <button aria-label="Menu" id="menuButton" class="text-white text-2xl focus:outline-none">
          <i class="fas fa-bars"></i>
        </button>
      </div>
    </nav>

    <!-- Article Header -->
    <div class="article-header">
      <h2 class="article-title">
        <?php echo $title; ?>
      </h2>
      <div class="article-tools">
        <div class="tool">
          <img src="save-icon.png" alt="Simpan">
          <span>SIMPAN</span>
        </div>
        <div class="tool">
          <img src="collection-icon.png" alt="Koleksi">
          <span>KOLEKSI</span>
        </div>
        <div class="tool">
          <img src="share-icon.png" alt="Bagikan">
          <span>BAGIKAN</span>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <main class="flex-grow relative z-10">
      <!-- Intro: Gambar & Judul -->
      <div class="article-intro">
        <img src="<?php echo $image; ?>" alt="Ilustrasi artikel">
        <p class="article-meta"><?php echo $author; ?></p>
        <h3>Pilih Tingkatan Literasi Yang Kamu Minati</h3>
      </div>

      <!-- Tab Pilihan -->
      <div class="literasi-tabs">
        <button class="tab-btn <?php echo $active_tab == 'lanjutan' ? 'active' : ''; ?>" data-target="lanjutan">Lanjutan</button>
        <button class="tab-btn <?php echo $active_tab == 'menengah' ? 'active' : ''; ?>" data-target="menengah">Menengah</button>
        <button class="tab-btn <?php echo $active_tab == 'pemula' ? 'active' : ''; ?>" data-target="pemula">Pemula</button>
      </div>

      <!-- Isi Berdasarkan Tab -->
      <div class="literasi-content">
        <div id="lanjutan" class="tab-content <?php echo $active_tab == 'lanjutan' ? 'active' : ''; ?>">
          <p><?php echo $lanjutan_content; ?></p>
        </div>
        <div id="menengah" class="tab-content <?php echo $active_tab == 'menengah' ? 'active' : ''; ?>">
          <p><?php echo $menengah_content; ?></p>
        </div>
        <div id="pemula" class="tab-content <?php echo $active_tab == 'pemula' ? 'active' : ''; ?>">
          <p><?php echo $pemula_content; ?></p>
        </div>
      </div>
    </main>

    <!-- Sidebar matching the index.html style -->
    <aside id="sidebar" class="fixed top-0 right-0 h-full w-72 bg-white shadow-lg transform translate-x-full z-40 flex flex-col" aria-hidden="true">
      <div class="px-6 py-5 border-b border-gray-300 flex items-center space-x-4">
        <?php if(isset($_SESSION['user'])): ?>
          <img src="<?php echo isset($_SESSION['profile_img']) ? $_SESSION['profile_img'] : 'https://storage.googleapis.com/a1aa/image/a0344b43-aba6-4fc2-e4a7-c8f861a01589.jpg'; ?>" class="w-12 h-12 rounded-full object-cover" alt="User avatar" />
          <div>
            <p class="font-bold text-gray-900"><?php echo $_SESSION['user']['name']; ?></p>
            <p class="text-xs text-gray-500"><?php echo $_SESSION['user']['email']; ?></p>
          </div>
        <?php else: ?>
          <img src="https://storage.googleapis.com/a1aa/image/a0344b43-aba6-4fc2-e4a7-c8f861a01589.jpg" class="w-12 h-12 rounded-full object-cover" alt="User avatar" />
          <div>
            <p class="font-bold text-gray-900">Rafi Natanginrat</p>
            <p class="text-xs text-gray-500">rafi@example.com</p>
          </div>
        <?php endif; ?>
      </div>
      <nav class="flex flex-col mt-4 space-y-1 px-4">
        <button class="menu-item" data-menu="simpanan" onclick="window.location.href='simpanan.php'">Simpanan</button>
        <button class="menu-item" id="menuTeman" data-menu="teman" onclick="window.location.href='teman.php'">Teman</button>
        <button class="menu-item" data-menu="koleksi" onclick="window.location.href='koleksi.php'">Koleksi</button>
        <button class="menu-item" data-menu="performaku" onclick="window.location.href='performaku.php'">Performaku</button>
        <?php if(isset($_SESSION['user'])): ?>
          <button class="menu-item" data-menu="keluar" onclick="logout()">Keluar</button>
        <?php else: ?>
          <button class="menu-item" data-menu="login" onclick="window.location.href='login.php'">Login</button>
        <?php endif; ?>
      </nav>
    </aside>

    <!-- Overlay -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-30 opacity-0 pointer-events-none z-30 transition-opacity"></div>

    <script>
      // Tab functionality
      const tabs = document.querySelectorAll('.tab-btn');
      const contents = document.querySelectorAll('.tab-content');

      tabs.forEach(btn => {
        btn.addEventListener('click', () => {
          // Update URL without page reload
          const newUrl = window.location.pathname + '?tab=' + btn.dataset.target;
          history.pushState({}, '', newUrl);
          
          tabs.forEach(b => b.classList.remove('active'));
          contents.forEach(c => c.classList.remove('active'));

          btn.classList.add('active');
          document.getElementById(btn.dataset.target).classList.add('active');
        });
      });

      // Sidebar functionality (matching index.html)
      const menuButton = document.getElementById('menuButton');
      const sidebar = document.getElementById('sidebar');
      const overlay = document.getElementById('overlay');

      function toggleSidebar() {
        const isOpen = sidebar.classList.contains('translate-x-0');
        
        if (isOpen) {
          sidebar.classList.remove('translate-x-0');
          sidebar.classList.add('translate-x-full');
          overlay.classList.add('opacity-0', 'pointer-events-none');
          overlay.classList.remove('opacity-100', 'pointer-events-auto');
        } else {
          sidebar.classList.remove('translate-x-full');
          sidebar.classList.add('translate-x-0');
          overlay.classList.remove('opacity-0', 'pointer-events-none');
          overlay.classList.add('opacity-100', 'pointer-events-auto');
        }
      }

      menuButton.addEventListener('click', toggleSidebar);
      overlay.addEventListener('click', toggleSidebar);
      
      <?php if(isset($_SESSION['user'])): ?>
      function logout() {
        // Send logout request to server
        fetch('logout.php', {
          method: 'POST'
        }).then(() => {
          window.location.href = 'login.php';
        });
      }
      <?php endif; ?>
    </script>
  </body>
</html>