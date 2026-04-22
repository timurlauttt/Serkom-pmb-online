<?php

namespace Database\Seeders;

use App\Models\PpdbBrosur;
use Illuminate\Database\Seeder;

class PpdbBrosurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brosurs = [
            [
                'judul' => 'Brosur PPDB SMK Taman Siswa 2025/2026',
                'file_path' => 'ppdb/brosur-2025-2026.pdf',
                'tahun_ajaran' => '2025/2026',
                'deskripsi' => 'Informasi lengkap tentang penerimaan peserta didik baru tahun ajaran 2025/2026, meliputi jurusan, fasilitas, dan keunggulan sekolah.',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'judul' => 'Panduan Pendaftaran Online PPDB 2025',
                'file_path' => 'ppdb/panduan-pendaftaran-2025.pdf',
                'tahun_ajaran' => '2025/2026',
                'deskripsi' => 'Langkah-langkah lengkap untuk melakukan pendaftaran online melalui portal PPDB.',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'judul' => 'Profil Jurusan SMK Taman Siswa',
                'file_path' => 'ppdb/profil-jurusan.pdf',
                'tahun_ajaran' => '2025/2026',
                'deskripsi' => 'Penjelasan detail tentang setiap jurusan yang tersedia, prospek karir, dan kompetensi yang akan dipelajari.',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'judul' => 'Beasiswa dan Program Bantuan PPDB 2025',
                'file_path' => 'ppdb/beasiswa-2025.pdf',
                'tahun_ajaran' => '2025/2026',
                'deskripsi' => 'Informasi lengkap tentang berbagai program beasiswa dan bantuan biaya pendidikan yang tersedia.',
                'is_active' => true,
                'order' => 4,
            ],
        ];

        foreach ($brosurs as $data) {
            PpdbBrosur::create($data);
        }
    }
}
