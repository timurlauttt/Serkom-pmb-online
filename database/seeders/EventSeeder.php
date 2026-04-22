<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'title' => 'Penerimaan Peserta Didik Baru 2025',
                'slug' => 'penerimaan-peserta-didik-baru-2025',
                'description' => 'Pendaftaran PPDB SMK Taman Siswa Purwokerto tahun ajaran 2025/2026. Tersedia berbagai program keahlian unggulan dengan fasilitas modern dan tenaga pengajar berpengalaman.',
                'start_date' => Carbon::create(2025, 6, 1),
                'end_date' => Carbon::create(2025, 7, 15),
                'location' => 'SMK Taman Siswa Purwokerto',
                'organizer' => 'Panitia PPDB',
                'category' => 'important',
                'is_featured' => true,
                'status' => 'active',
            ],
            [
                'title' => 'Workshop Teknologi Digital',
                'slug' => 'workshop-teknologi-digital',
                'description' => 'Workshop pengembangan keterampilan digital untuk siswa SMK meliputi programming, desain grafis, dan digital marketing.',
                'start_date' => Carbon::create(2025, 10, 15),
                'end_date' => Carbon::create(2025, 10, 16),
                'location' => 'Lab Komputer SMK Taman Siswa',
                'organizer' => 'Jurusan TKJ & RPL',
                'category' => 'workshop',
                'is_featured' => true,
                'status' => 'active',
            ],
            [
                'title' => 'Job Fair SMK Taman Siswa 2025',
                'slug' => 'job-fair-smk-taman-siswa-2025',
                'description' => 'Bursa kerja khusus lulusan SMK dengan berbagai perusahaan partner. Kesempatan emas untuk mendapatkan pekerjaan setelah lulus.',
                'start_date' => Carbon::create(2025, 11, 20),
                'end_date' => Carbon::create(2025, 11, 21),
                'location' => 'Aula SMK Taman Siswa',
                'organizer' => 'Bursa Kerja Khusus',
                'category' => 'career',
                'is_featured' => false,
                'status' => 'active',
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
