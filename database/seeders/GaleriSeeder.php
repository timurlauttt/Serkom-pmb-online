<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Galeri;
use Illuminate\Support\Facades\File;

class GaleriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create galeri directory if not exists
        $galeriPath = public_path('images/galeri');
        if (!File::exists($galeriPath)) {
            File::makeDirectory($galeriPath, 0755, true);
        }

        $galeris = [
            [
                'title' => 'Upacara Bendera Hari Senin',
                'path' => 'images/galeri/upacara-bendera.jpg',
                'is_favorite' => true,
                'order' => 1,
            ],
            [
                'title' => 'Kegiatan Praktikum Komputer TKJ',
                'path' => 'images/galeri/praktikum-tkj.jpg',
                'is_favorite' => true,
                'order' => 2,
            ],
            [
                'title' => 'Workshop Multimedia dan Desain Grafis',
                'path' => 'images/galeri/workshop-multimedia.jpg',
                'is_favorite' => true,
                'order' => 3,
            ],
            [
                'title' => 'Lomba Futsal Antar Kelas',
                'path' => 'images/galeri/lomba-futsal.jpg',
                'is_favorite' => false,
                'order' => 4,
            ],
            [
                'title' => 'Kegiatan OSIS dalam Acara 17 Agustus',
                'path' => 'images/galeri/kegiatan-osis.jpg',
                'is_favorite' => true,
                'order' => 5,
            ],
            [
                'title' => 'Praktikum Akuntansi Kelas XI AKL',
                'path' => 'images/galeri/praktikum-akuntansi.jpg',
                'is_favorite' => false,
                'order' => 6,
            ],
            [
                'title' => 'Wisuda Kelulusan Siswa Kelas XII',
                'path' => 'images/galeri/wisuda-kelulusan.jpg',
                'is_favorite' => true,
                'order' => 7,
            ],
            [
                'title' => 'Kegiatan Ekstrakurikuler Pramuka',
                'path' => 'images/galeri/ekstrakurikuler-pramuka.jpg',
                'is_favorite' => false,
                'order' => 8,
            ],
            [
                'title' => 'Pelatihan Office Administration OTKP',
                'path' => 'images/galeri/pelatihan-otkp.jpg',
                'is_favorite' => false,
                'order' => 9,
            ],
            [
                'title' => 'Kunjungan Industri ke Perusahaan IT',
                'path' => 'images/galeri/kunjungan-industri.jpg',
                'is_favorite' => true,
                'order' => 10,
            ],
            [
                'title' => 'Lomba Kompetisi Sains Nasional',
                'path' => 'images/galeri/lomba-ksn.jpg',
                'is_favorite' => false,
                'order' => 11,
            ],
            [
                'title' => 'Acara Perpisahan Siswa Kelas XII',
                'path' => 'images/galeri/acara-perpisahan.jpg',
                'is_favorite' => true,
                'order' => 12,
            ],
            [
                'title' => 'Kegiatan Bakti Sosial Sekolah',
                'path' => 'images/galeri/bakti-sosial.jpg',
                'is_favorite' => false,
                'order' => 13,
            ],
            [
                'title' => 'Presentasi Proyek Akhir Multimedia',
                'path' => 'images/galeri/presentasi-proyek.jpg',
                'is_favorite' => false,
                'order' => 14,
            ],
            [
                'title' => 'Kegiatan Pentas Seni Tahunan',
                'path' => 'images/galeri/pentas-seni.jpg',
                'is_favorite' => true,
                'order' => 15,
            ],
            [
                'title' => 'Workshop Digital Marketing untuk Siswa',
                'path' => 'images/galeri/workshop-digital.jpg',
                'is_favorite' => false,
                'order' => 16,
            ],
            [
                'title' => 'Pelatihan Soft Skills dan Leadership',
                'path' => 'images/galeri/pelatihan-leadership.jpg',
                'is_favorite' => false,
                'order' => 17,
            ],
            [
                'title' => 'Kegiatan Pembelajaran di Laboratorium',
                'path' => 'images/galeri/pembelajaran-lab.jpg',
                'is_favorite' => false,
                'order' => 18,
            ],
        ];

        foreach ($galeris as $galeri) {
            Galeri::create($galeri);
        }

        // Create placeholder images info file
        $infoContent = "INFORMASI GALERI SEEDER\n";
        $infoContent .= "======================\n\n";
        $infoContent .= "Seeder ini telah membuat " . count($galeris) . " entri galeri.\n";
        $infoContent .= "Untuk menggunakan galeri dengan gambar nyata, silakan:\n\n";
        $infoContent .= "1. Upload foto-foto ke folder: public/images/galeri/\n";
        $infoContent .= "2. Gunakan nama file sesuai dengan yang ada di seeder\n";
        $infoContent .= "3. Format yang disarankan: JPG, JPEG, PNG\n";
        $infoContent .= "4. Ukuran optimal: 800x600 pixels atau lebih\n\n";
        $infoContent .= "Daftar file gambar yang dibutuhkan:\n";
        foreach ($galeris as $galeri) {
            $filename = basename($galeri['path']);
            $infoContent .= "- " . $filename . " (" . $galeri['title'] . ")\n";
        }
        
        File::put($galeriPath . '/README.txt', $infoContent);
    }
}