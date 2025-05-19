<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artikel;

class ArtikelSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'judul' => 'REVOLUSI ANGKUTAN UMUM DI BANDUNG DI UJUNG JARI?',
                'kategori' => 'Transportasi',
                'gambar' => 'img/gambar angkot.png',
                'isi' => 'Isi lengkap untuk: REVOLUSI ANGKUTAN UMUM DI BANDUNG DI UJUNG JARI?',
                'content_mudah' => 'Isi pemula untuk: REVOLUSI ANGKUTAN UMUM DI BANDUNG DI UJUNG JARI?',
                'content_sedang' => 'Isi menengah untuk: REVOLUSI ANGKUTAN UMUM DI BANDUNG DI UJUNG JARI?',
                'content_sulit' => 'Isi lanjutan untuk: REVOLUSI ANGKUTAN UMUM DI BANDUNG DI UJUNG JARI?',
            ],
            [
                'judul' => 'INOVASI TEKNOLOGI RAMAH LINGKUNGAN UNTUK DUNIA LEBIH SEHAT',
                'kategori' => 'Teknologi',
                'gambar' => 'img/gambar lingkungan.png',
                'isi' => 'Isi lengkap untuk: INOVASI TEKNOLOGI RAMAH LINGKUNGAN UNTUK DUNIA LEBIH SEHAT',
                'content_mudah' => 'Isi pemula untuk: INOVASI TEKNOLOGI RAMAH LINGKUNGAN UNTUK DUNIA LEBIH SEHAT',
                'content_sedang' => 'Isi menengah untuk: INOVASI TEKNOLOGI RAMAH LINGKUNGAN UNTUK DUNIA LEBIH SEHAT',
                'content_sulit' => 'Isi lanjutan untuk: INOVASI TEKNOLOGI RAMAH LINGKUNGAN UNTUK DUNIA LEBIH SEHAT',
            ],
            [
                'judul' => 'WAJAH PEREMPUAN DALAM HARI PEREMPUAN INTERNASIONAL',
                'kategori' => 'Sosial',
                'gambar' => 'img/gambar wajah.png',
                'isi' => 'Isi lengkap untuk: WAJAH PEREMPUAN DALAM HARI PEREMPUAN INTERNASIONAL',
                'content_mudah' => 'Isi pemula untuk: WAJAH PEREMPUAN DALAM HARI PEREMPUAN INTERNASIONAL',
                'content_sedang' => 'Isi menengah untuk: WAJAH PEREMPUAN DALAM HARI PEREMPUAN INTERNASIONAL',
                'content_sulit' => 'Isi lanjutan untuk: WAJAH PEREMPUAN DALAM HARI PEREMPUAN INTERNASIONAL',
            ],
            [
                'judul' => 'MEMPERKUAT INDUSTRI BAJA SEBAGAI URAT NADI PERTAHANAN',
                'kategori' => 'Industri',
                'isi' => 'Isi lengkap untuk: MEMPERKUAT INDUSTRI BAJA SEBAGAI URAT NADI PERTAHANAN',
                'content_mudah' => 'Isi pemula untuk: MEMPERKUAT INDUSTRI BAJA SEBAGAI URAT NADI PERTAHANAN',
                'content_sedang' => 'Isi menengah untuk: MEMPERKUAT INDUSTRI BAJA SEBAGAI URAT NADI PERTAHANAN',
                'content_sulit' => 'Isi lanjutan untuk: MEMPERKUAT INDUSTRI BAJA SEBAGAI URAT NADI PERTAHANAN',
            ],
            [
                'judul' => 'BISAKAH SAMPAH DI LAUT BERDAMPAK PADA KESEHATAN MANUSIA?',
                'kategori' => 'Lingkungan',
                'isi' => 'Isi lengkap untuk: BISAKAH SAMPAH DI LAUT BERDAMPAK PADA KESEHATAN MANUSIA?',
                'content_mudah' => 'Isi pemula untuk: BISAKAH SAMPAH DI LAUT BERDAMPAK PADA KESEHATAN MANUSIA?',
                'content_sedang' => 'Isi menengah untuk: BISAKAH SAMPAH DI LAUT BERDAMPAK PADA KESEHATAN MANUSIA?',
                'content_sulit' => 'Isi lanjutan untuk: BISAKAH SAMPAH DI LAUT BERDAMPAK PADA KESEHATAN MANUSIA?',
            ],
            [
                'judul' => 'MENINGKATKAN KESEHATAN MENTAL DENGAN MEDITASO',
                'kategori' => 'Kesehatan',
                'isi' => 'Isi lengkap untuk: MENINGKATKAN KESEHATAN MENTAL DENGAN MEDITASO',
                'content_mudah' => 'Isi pemula untuk: MENINGKATKAN KESEHATAN MENTAL DENGAN MEDITASO',
                'content_sedang' => 'Isi menengah untuk: MENINGKATKAN KESEHATAN MENTAL DENGAN MEDITASO',
                'content_sulit' => 'Isi lanjutan untuk: MENINGKATKAN KESEHATAN MENTAL DENGAN MEDITASO',
            ],
            [
                'judul' => 'PENTINGNYA DAUR ULANG SAMPAH UNTUK KESEHATAN LINGKUNGAN',
                'kategori' => 'Lingkungan',
                'isi' => 'Isi lengkap untuk: PENTINGNYA DAUR ULANG SAMPAH UNTUK KESEHATAN LINGKUNGAN',
                'content_mudah' => 'Isi pemula untuk: PENTINGNYA DAUR ULANG SAMPAH UNTUK KESEHATAN LINGKUNGAN',
                'content_sedang' => 'Isi menengah untuk: PENTINGNYA DAUR ULANG SAMPAH UNTUK KESEHATAN LINGKUNGAN',
                'content_sulit' => 'Isi lanjutan untuk: PENTINGNYA DAUR ULANG SAMPAH UNTUK KESEHATAN LINGKUNGAN',
            ],
            [
                'judul' => '11 MEI 2024, JAKARTA - KONTEN VIRAL BERSIHKAN',
                'kategori' => 'Kegiatan',
                'isi' => 'Isi lengkap untuk: PENTINGNYA DAUR ULANG SAMPAH UNTUK KESEHATAN LINGKUNGAN',
                'content_mudah' => 'Isi pemula untuk: 11 MEI 2024, JAKARTA - KONTEN VIRAL BERSIHKAN',
                'content_sedang' => 'Isi menengah untuk: 11 MEI 2024, JAKARTA - KONTEN VIRAL BERSIHKAN',
                'content_sulit' => 'Isi lanjutan untuk: 11 MEI 2024, JAKARTA - KONTEN VIRAL BERSIHKAN',
            ],
        ];

        foreach ($data as $item) {
            Artikel::create($item);
        }
    }
}
