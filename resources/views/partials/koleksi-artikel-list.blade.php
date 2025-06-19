@section('styles')
<link rel="stylesheet" href="{{ asset('css/koleksi.css') }}">
@endsection

@forelse($artikels as $artikel)
    <div class="koleksi-item">
        <div class="koleksi-info">
            <img 
                src="{{ $artikel->gambar ? asset($artikel->gambar) : asset('img/default.jpg') }}" 
                alt="Gambar Artikel"
                class="avatar"
            >
            <div class="koleksi-text">
                <p class="koleksi-name">{{ $artikel->judul }}</p>
                <p class="koleksi-author">{{ $artikel->penulis }}</p>
            </div>
        </div>
        <a href="{{ route('artikel.lanjutan', ['id' => $artikel->id]) }}" class="btn-lihat">Lihat Artikel</a>
    </div>
@empty
    <div class="empty-message">
        <p>Tidak ditemukan.</p>
    </div>
@endforelse
