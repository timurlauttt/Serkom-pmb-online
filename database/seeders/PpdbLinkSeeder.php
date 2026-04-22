<?php

namespace Database\Seeders;

use App\Models\PpdbLink;
use Illuminate\Database\Seeder;

class PpdbLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $links = [
            [
                'nama_link' => 'Portal Pendaftaran Online',
                'url' => 'https://ppdb.smktamansiswa-purwokerto.sch.id',
                'jenis' => 'pendaftaran',
                'deskripsi' => 'Link untuk mengakses sistem pendaftaran online PPDB SMK Taman Siswa Purwokerto.',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'nama_link' => 'Cek Status Pendaftaran',
                'url' => 'https://ppdb.smktamansiswa-purwokerto.sch.id/status',
                'jenis' => 'info',
                'deskripsi' => 'Cek status pendaftaran dan kelengkapan berkas Anda secara real-time.',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'nama_link' => 'Pengumuman Hasil Seleksi',
                'url' => 'https://ppdb.smktamansiswa-purwokerto.sch.id/pengumuman',
                'jenis' => 'hasil',
                'deskripsi' => 'Pengumuman hasil seleksi PPDB akan dipublikasikan melalui link ini.',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'nama_link' => 'Panduan Lengkap PPDB 2025',
                'url' => 'https://drive.google.com/ppdb-panduan-2025',
                'jenis' => 'info',
                'deskripsi' => 'Dokumen panduan lengkap prosedur pendaftaran PPDB tahun 2025.',
                'is_active' => true,
                'order' => 4,
            ],
            [
                'nama_link' => 'Form Daftar Ulang',
                'url' => 'https://ppdb.smktamansiswa-purwokerto.sch.id/daftar-ulang',
                'jenis' => 'pendaftaran',
                'deskripsi' => 'Form untuk melakukan daftar ulang bagi siswa yang diterima.',
                'is_active' => true,
                'order' => 5,
            ],
            [
                'nama_link' => 'Info Beasiswa dan Bantuan',
                'url' => 'https://smktamansiswa-purwokerto.sch.id/beasiswa',
                'jenis' => 'info',
                'deskripsi' => 'Informasi lengkap tentang berbagai program beasiswa yang tersedia.',
                'is_active' => true,
                'order' => 6,
            ],
            [
                'nama_link' => 'Kontak dan FAQ PPDB',
                'url' => 'https://smktamansiswa-purwokerto.sch.id/ppdb-faq',
                'jenis' => 'lainnya',
                'deskripsi' => 'Frequently Asked Questions (FAQ) dan informasi kontak panitia PPDB.',
                'is_active' => true,
                'order' => 7,
            ],
        ];

        foreach ($links as $data) {
            PpdbLink::create($data);
        }
    }
}
