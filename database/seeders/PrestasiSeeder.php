<?php

namespace Database\Seeders;

use App\Models\Prestasi;
use Illuminate\Database\Seeder;

class PrestasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prestasis = [
            [
                'judul' => 'Juara 1 Lomba Kompetensi Siswa (LKS) Bidang Akuntansi',
                'deskripsi' => 'Memenangkan kompetisi akuntansi tingkat nasional dengan skor sempurna dalam ujian teori dan praktik pembukuan.',
                'tingkat' => 'nasional',
                'peringkat' => 'Juara 1',
                'penyelenggara' => 'Kementerian Pendidikan dan Kebudayaan',
                'tahun' => 2024,
                'jurusan_id' => 4,
                'nama_siswa' => 'Ani Suryani',
                'is_featured' => true,
            ],
            [
                'judul' => 'Medali Emas Olimpiade Matematika Internasional',
                'deskripsi' => 'Berhasil meraih medali emas dalam ajang International Mathematics Olympiad (IMO) yang diikuti oleh 120 negara.',
                'tingkat' => 'internasional',
                'peringkat' => 'Medali Emas',
                'penyelenggara' => 'International Mathematics Olympiad Committee',
                'tahun' => 2024,
                'jurusan_id' => 4,
                'nama_siswa' => 'Budi Dharma Putra',
                'is_featured' => true,
            ],
            [
                'judul' => 'Juara 2 Kompetisi Robotika Nasional',
                'deskripsi' => 'Tim robotika sekolah berhasil meraih juara 2 dalam kategori Line Follower Robot di ajang Indonesia Robot Contest.',
                'tingkat' => 'nasional',
                'peringkat' => 'Juara 2',
                'penyelenggara' => 'LIPI & Kemenristekdikti',
                'tahun' => 2024,
                'jurusan_id' => 4,
                'nama_siswa' => 'Tim Robotika SMK TS (Candra, Dimas, Eka)',
                'is_featured' => true,
            ],
            [
                'judul' => 'Juara 1 Lomba Karya Tulis Ilmiah Tingkat Provinsi',
                'deskripsi' => 'Karya tulis tentang "Inovasi Fintech untuk UMKM" berhasil menjadi juara 1 dan akan dipresentasikan di tingkat nasional.',
                'tingkat' => 'provinsi',
                'peringkat' => 'Juara 1',
                'penyelenggara' => 'Dinas Pendidikan Provinsi Jawa Tengah',
                'tahun' => 2024,
                'jurusan_id' => 4,
                'nama_siswa' => 'Fitri Handayani',
                'is_featured' => false,
            ],
            [
                'judul' => 'Juara 3 Festival Tari Tradisional Se-Jawa Tengah',
                'deskripsi' => 'Penampilan tari Gambyong yang memukau berhasil meraih juara 3 dalam kategori tari klasik.',
                'tingkat' => 'provinsi',
                'peringkat' => 'Juara 3',
                'penyelenggara' => 'Dinas Kebudayaan Jawa Tengah',
                'tahun' => 2023,
                'jurusan_id' => 4,
                'nama_siswa' => 'Gita Puspita Sari',
                'is_featured' => false,
            ],
            [
                'judul' => 'Juara 1 Lomba Desain Grafis Tingkat Kota',
                'deskripsi' => 'Desain poster kampanye anti bullying yang kreatif dan menarik berhasil menjadi juara 1.',
                'tingkat' => 'kota',
                'peringkat' => 'Juara 1',
                'penyelenggara' => 'Dinas Pendidikan Kota Purwokerto',
                'tahun' => 2024,
                'jurusan_id' => 4,
                'nama_siswa' => 'Hendra Wijaya',
                'is_featured' => false,
            ],
            [
                'judul' => 'Juara 2 Turnamen Futsal Antar SMK Se-Banyumas',
                'deskripsi' => 'Tim futsal putra berhasil meraih runner up setelah pertandingan sengit di final.',
                'tingkat' => 'kota',
                'peringkat' => 'Juara 2',
                'penyelenggara' => 'MKKS SMK Kabupaten Banyumas',
                'tahun' => 2024,
                'jurusan_id' => null,
                'nama_siswa' => 'Tim Futsal SMK Taman Siswa',
                'is_featured' => false,
            ],
            [
                'judul' => 'Juara 1 Lomba Pidato Bahasa Inggris Tingkat Sekolah',
                'deskripsi' => 'Pidato dengan tema "Future of Education in Digital Era" yang disampaikan dengan sangat baik dan lancar.',
                'tingkat' => 'sekolah',
                'peringkat' => 'Juara 1',
                'penyelenggara' => 'SMK Taman Siswa Purwokerto',
                'tahun' => 2024,
                'jurusan_id' => 4,
                'nama_siswa' => 'Indah Permatasari',
                'is_featured' => false,
            ],
            [
                'judul' => 'Juara 1 Lomba Akuntansi Tingkat Nasional',
                'deskripsi' => 'Kompetisi mencatat transaksi keuangan dengan cepat dan akurat dalam waktu terbatas.',
                'tingkat' => 'nasional',
                'peringkat' => 'Juara 1',
                'penyelenggara' => 'MGMP Akuntansi Nasional',
                'tahun' => 2023,
                'jurusan_id' => 4,
                'nama_siswa' => 'Joko Susilo',
                'is_featured' => false,
            ],
            [
                'judul' => 'Juara Harapan 1 Debat Bahasa Indonesia Tingkat Provinsi',
                'deskripsi' => 'Tim debat berhasil masuk babak semifinal dan meraih juara harapan 1 dengan argumentasi yang kuat.',
                'tingkat' => 'provinsi',
                'peringkat' => 'Juara Harapan 1',
                'penyelenggara' => 'Kemendikbud Wilayah Jawa Tengah',
                'tahun' => 2024,
                'jurusan_id' => 4,
                'nama_siswa' => 'Kartika Dewi & Luthfi Rahman',
                'is_featured' => false,
            ],
        ];

        foreach ($prestasis as $data) {
            Prestasi::create($data);
        }
    }
}
