@extends('layouts.app')

@section('content')
    <div class="koleksi-wrapper">
        <h2>Koleksi Saya</h2>

        <!-- Form Pencarian Koleksi -->
        <div class="koleksi-search">
            <input type="text" placeholder="Cari Nama Koleksi" />
        </div>

        <!-- Daftar Koleksi -->
        <div class="koleksi-list">
            @foreach($koleksi as $koleksi_item)
                <div class="koleksi-item">
                    <div class="koleksi-info">
                        <img src="{{ asset('img/koleksi/' . $koleksi_item->avatar) }}" alt="Avatar" class="avatar">
                        <div class="koleksi-text">
                            <p class="koleksi-name">{{ $koleksi_item->name }}</p>
                            <p class="koleksi-author">{{ $koleksi_item->author }}</p>
                            <p class="koleksi-article-count">{{ $koleksi_item->article_count }} Artikel</p>
                        </div>
                    </div>
                    <form class="delete-form" action="{{ route('koleksi.destroy', $koleksi_item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus koleksi ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Hapus Koleksi</button>
                    </form>
                </div>
            @endforeach
        </div>

        <!-- Form untuk Menambah Koleksi -->
        <div class="koleksi-form-wrapper">
            <h3>Tambah Koleksi</h3>
            <form class="koleksi-form" action="{{ route('koleksi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="name" placeholder="Nama Koleksi" required>
                <input type="text" name="author" placeholder="Penulis" required>
                <input type="number" name="article_count" placeholder="Jumlah Artikel" required>
                <input type="file" name="avatar" accept="img/*"> <!-- Input file untuk gambar -->
                <button type="submit" class="btn-submit">Tambah Koleksi</button>
            </form>

        </div>
    </div>

    <!-- CSS untuk penataan -->
    <style>
        .koleksi-wrapper {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        .koleksi-search input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .koleksi-list {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .koleksi-item {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .koleksi-info {
            display: flex;
            gap: 10px;
        }

        .koleksi-text {
            flex-grow: 1;
        }

        .koleksi-name {
            font-size: 18px;
            font-weight: bold;
        }

        .koleksi-author {
            font-size: 14px;
            color: #555;
        }

        .koleksi-article-count {
            font-size: 14px;
            color: #777;
        }

        .btn-delete {
            background-color: #e74c3c;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .koleksi-form-wrapper {
            margin-top: 30px;
        }

        .koleksi-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .btn-submit {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
@endsection
