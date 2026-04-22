<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengumuman;
use Illuminate\Support\Str;

class PengumumanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pengumumans = [
            [
                'title' => 'Pengumuman Penerimaan Peserta Didik Baru (PPDB) 2024/2025',
                'slug' => Str::slug('Pengumuman Penerimaan Peserta Didik Baru (PPDB) 2024/2025'),
                'content' => 'SMK Taman Siswa Purwokerto membuka pendaftaran Penerimaan Peserta Didik Baru (PPDB) untuk tahun ajaran 2024/2025. Pendaftaran dibuka mulai tanggal 1 Juni 2024 hingga 30 Juni 2024.

Syarat pendaftaran:
1. Lulusan SMP/MTs sederajat
2. Fotokopi Ijazah SMP/MTs yang telah dilegalisir
3. Fotokopi SKHUN (Surat Keterangan Hasil Ujian Nasional)
4. Pas foto terbaru ukuran 3x4 sebanyak 3 lembar
5. Fotokopi Kartu Keluarga (KK)
6. Fotokopi Akta Kelahiran

Jurusan yang tersedia:
- Teknik Komputer dan Jaringan (TKJ)
- Multimedia (MM)
- Akuntansi dan Keuangan Lembaga (AKL)
- Otomatisasi dan Tata Kelola Perkantoran (OTKP)

Untuk informasi lebih lanjut, silakan hubungi bagian Tata Usaha di (0281) 123-4567.',
                'posted_at' => now()->subDays(5),
                'expires_at' => now()->addDays(25),
            ],
            [
                'title' => 'Jadwal Ujian Tengah Semester (UTS) Gasal 2024/2025',
                'slug' => Str::slug('Jadwal Ujian Tengah Semester (UTS) Gasal 2024/2025'),
                'content' => 'Ujian Tengah Semester (UTS) Gasal tahun ajaran 2024/2025 akan dilaksanakan pada:

Tanggal: 15 - 19 Oktober 2024
Waktu: 07.30 - 11.00 WIB

Ketentuan ujian:
1. Siswa wajib hadir tepat waktu
2. Membawa kartu pelajar dan alat tulis
3. Tidak diperbolehkan membawa HP atau alat komunikasi lainnya
4. Berpakaian seragam lengkap sesuai ketentuan sekolah

Jadwal detail ujian per kelas dapat dilihat di papan pengumuman masing-masing kelas atau menghubungi wali kelas.',
                'posted_at' => now()->subDays(10),
                'expires_at' => now()->addDays(5),
            ],
            [
                'title' => 'Peringatan Hari Kemerdekaan Indonesia ke-79',
                'slug' => Str::slug('Peringatan Hari Kemerdekaan Indonesia ke-79'),
                'content' => 'Dalam rangka memperingati Hari Kemerdekaan Republik Indonesia ke-79, SMK Taman Siswa Purwokerto akan mengadakan serangkaian kegiatan:

Tanggal: 17 Agustus 2024

Kegiatan:
1. Upacara Bendera (07.00 - 08.00)
2. Lomba Gerak Jalan Putri (08.30 - 10.00)
3. Lomba Futsal Putra (08.30 - 12.00)
4. Lomba Makan Kerupuk (10.30 - 11.00)
5. Lomba Balap Karung (11.00 - 11.30)
6. Lomba Tarik Tambang (11.30 - 12.00)

Semua siswa wajib mengikuti upacara bendera dan diharapkan berpartisipasi aktif dalam lomba-lomba yang diadakan.',
                'posted_at' => now()->subDays(15),
                'expires_at' => now()->subDays(10), // Already expired
            ],
            [
                'title' => 'Informasi Libur Semester Gasal 2024/2025',
                'slug' => Str::slug('Informasi Libur Semester Gasal 2024/2025'),
                'content' => 'Libur semester gasal tahun ajaran 2024/2025 akan dimulai pada:

Tanggal: 23 Desember 2024 - 6 Januari 2025

Selama libur semester, kegiatan sekolah diliburkan kecuali:
1. Kegiatan remedial untuk siswa yang belum tuntas
2. Kegiatan ekstrakurikuler tertentu (jadwal menyusul)
3. Kegiatan administrasi guru dan karyawan

Masuk kembali: 7 Januari 2025

Selamat menikmati libur semester dan selamat tahun baru 2025!',
                'posted_at' => now()->subDays(2),
                'expires_at' => null, // Permanent
            ],
            [
                'title' => 'Pembayaran SPP Bulan November 2024',
                'slug' => Str::slug('Pembayaran SPP Bulan November 2024'),
                'content' => 'Pengingat pembayaran SPP (Sumbangan Pembinaan Pendidikan) bulan November 2024:

Batas waktu pembayaran: 10 November 2024

Besaran SPP:
- Kelas X: Rp 250.000
- Kelas XI: Rp 250.000  
- Kelas XII: Rp 250.000

Cara pembayaran:
1. Langsung ke Tata Usaha sekolah (07.00 - 14.00)
2. Transfer ke rekening sekolah:
   Bank BRI: 1234567890
   a.n. SMK Taman Siswa Purwokerto

Siswa yang terlambat membayar akan dikenakan denda Rp 5.000 per hari.',
                'posted_at' => now()->subDay(),
                'expires_at' => now()->addDays(8),
            ],
            [
                'title' => 'Workshop Digital Marketing untuk Siswa Kelas XII',
                'slug' => Str::slug('Workshop Digital Marketing untuk Siswa Kelas XII'),
                'content' => 'SMK Taman Siswa mengadakan workshop Digital Marketing khusus untuk siswa kelas XII dalam rangka persiapan memasuki dunia kerja.

Waktu: Sabtu, 2 November 2024
Jam: 08.00 - 15.00 WIB
Tempat: Lab Multimedia

Materi yang akan dibahas:
1. Pengenalan Digital Marketing
2. Social Media Marketing
3. Content Creation
4. Email Marketing
5. SEO Dasar

Narasumber: Praktisi Digital Marketing berpengalaman
Gratis untuk semua siswa kelas XII

Daftar di wali kelas masing-masing paling lambat 31 Oktober 2024.',
                'posted_at' => now()->subDays(3),
                'expires_at' => now()->addDay(),
            ],
        ];

        foreach ($pengumumans as $pengumuman) {
            Pengumuman::create($pengumuman);
        }
    }
}