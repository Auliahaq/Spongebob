@extends('layouts.app')
@section('title', 'Artikel | Lexica')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/artikel-lanjutan.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
@endsection

@section('content')

@if(session('success'))
  <div class="alert alert-success" style="background:#d1e7dd; padding:10px; color:#0f5132; border:1px solid #badbcc; border-radius:6px; margin-bottom:15px;">
    {{ session('success') }}
  </div>
@endif

@php
    $title      = $article->judul;
    $author     = $article->penulis;
    $imagePath  = $article->gambar ?: 'img/default.jpg';
    $lanjutan   = $article->content_sulit;
    $menengah   = $article->content_sedang;
    $pemula     = $article->content_mudah;
    $activeTab  = $active_tab;
    $readLevels = $readLevels ?? [];
@endphp

<div class="article-header">
  <h2 class="article-title">{{ $title }}</h2>
  <div class="article-tools">
    
    <!-- Tambahkan ke Koleksi -->
    <form action="{{ route('koleksi.tambahArtikel') }}" method="POST" style="display: inline-block;">
      @csrf
      <input type="hidden" name="artikel_id" value="{{ $article->id }}">
      <button type="submit" class="tool" style="background: none; border: none; cursor: pointer; padding: 0;">
        <div class="tool-icon"><img src="{{ asset('img/koleksi.png') }}" alt="Koleksi"></div>
        <span>Tambahkan ke koleksi</span>
      </button>
    </form>

    <!-- Bagikan -->
    <div class="tool">
      <div class="tool-icon"><img src="{{ asset('img/share.webp') }}" alt="Bagikan"></div>
      <span>Bagikan</span>
    </div>

  </div>
</div>

<main class="article-main">
  <div class="article-intro">
    <img src="{{ asset($imagePath) }}" alt="Ilustrasi Artikel" class="article-image">
    <p class="article-meta">Oleh {{ $author }}</p>
    <h3>Pilih Tingkatan Literasi yang Kamu Minati</h3>
  </div>

  <div class="literasi-tabs">
    <a href="{{ route('artikel.lanjutan', ['id'=>$article->id, 'tab'=>'lanjutan']) }}" class="tab-btn {{ $active_tab=='lanjutan' ? 'active' : '' }}">Lanjutan</a>
    <a href="{{ route('artikel.lanjutan', ['id'=>$article->id, 'tab'=>'menengah']) }}" class="tab-btn {{ $active_tab=='menengah' ? 'active' : '' }}">Menengah</a>
    <a href="{{ route('artikel.lanjutan', ['id'=>$article->id, 'tab'=>'pemula']) }}" class="tab-btn {{ $active_tab=='pemula' ? 'active' : '' }}">Pemula</a>
  </div>

  <div class="literasi-content">
    <div id="lanjutan" class="tab-content {{ $activeTab=='lanjutan' ? 'active':'' }}">{!! $lanjutan !!}</div>
    <div id="menengah" class="tab-content {{ $activeTab=='menengah' ? 'active':'' }}">{!! $menengah !!}</div>
    <div id="pemula"   class="tab-content {{ $activeTab=='pemula'   ? 'active':'' }}">{!! $pemula   !!}</div>
  </div>

  <form action="{{ route('artikel.markRead') }}" method="POST" class="selesai-baca-container">
    @csrf
    <input type="hidden" name="artikel_id" value="{{ $article->id }}">
    <input type="hidden" name="level"      value="{{ $activeTab }}">

    @if(in_array($activeTab, $readLevels))
      <button type="button" class="selesai-baca-btn" disabled>✓ Sudah Dibaca</button>
    @else
      <button type="submit" class="selesai-baca-btn">Selesai Membaca</button>
    @endif
  </form>
</main>

<div class="right-buttons">
  <button id="AI" title="AI"><img src="{{ asset('img/headphone.png') }}" alt="AI"></button>
  <button id="scroll-up" title="Ke Atas"><img src="{{ asset('img/arrow.jpg') }}" alt="Atas"></button>
</div>

<!-- Modal Tanya AI -->
<div id="chatModal" class="chat-modal hidden fixed bottom-20 right-10 z-50 bg-white rounded-lg shadow-lg w-80 border border-gray-200">
  <div class="flex justify-between items-center p-3 border-b">
    <strong>Lexica AI : Asisten Membaca</strong>
    <button onclick="closeChat()" class="text-xl font-bold">&times;</button>
  </div>
  <div class="p-4">
    <textarea id="ai-question" placeholder="Ada yang ingin ditanyakan?" class="w-full p-2 border rounded" rows="4"></textarea>
    <button id="ask-ai-btn" class="mt-2 w-full bg-blue-600 text-white py-2 rounded">Tanyakan pada kami</button>
    <div id="ai-answer" class="mt-4 text-sm text-gray-700 whitespace-pre-line"></div>
  </div>
</div>

<script>
  // Tab switching
  document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const tab = btn.dataset.target;
      const url = new URL(window.location.href);
      url.searchParams.set('tab', tab);
      window.location.href = url;
    });
  });

  // Scroll to top
  document.getElementById('scroll-up').addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });

  // Modal toggle
  const modal = document.getElementById('chatModal');
  const toggleBtn = document.getElementById('AI');
  const closeChat = () => modal.classList.add('hidden');
  toggleBtn.addEventListener('click', () => modal.classList.toggle('hidden'));

  // AI Ask
  document.getElementById('ask-ai-btn').addEventListener('click', async () => {
    const question = document.getElementById('ai-question').value.trim();
    const answerBox = document.getElementById('ai-answer');
    if (!question) {
      answerBox.innerText = "Pertanyaan tidak boleh kosong.";
      return;
    }

    answerBox.innerText = "⏳ Memproses jawaban...";
    try {
      const response = await fetch("{{ route('ai.ask') }}", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ question })
      });

      const data = await response.json();
      answerBox.innerText = data.answer || "Tidak ada jawaban yang tersedia.";
    } catch (error) {
      answerBox.innerText = "⚠️ Gagal mendapatkan jawaban.";
    }
  });

  // Hilangkan alert sukses setelah 5 detik
  setTimeout(() => {
    const alert = document.querySelector('.alert-success');
    if (alert) alert.remove();
  }, 5000);
</script>
@endsection
