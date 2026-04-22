<?php

namespace Database\Seeders;

use App\Models\Ekstrakurikuler;
use Illuminate\Database\Seeder;

class EkstrakurikulerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ekstrakurikulers = [
            [
                'nama' => 'Pramuka',
                'deskripsi' => 'Gerakan Pramuka adalah organisasi pendidikan nonformal yang menyelenggarakan pendidikan kepanduan di Indonesia untuk membentuk karakter generasi muda.',
                'icon' => 'fas fa-campground',
                'pembina' => 'Pak Budi Santoso, S.Pd',
                'jadwal' => 'Sabtu, 14:00 - 16:00',
                'tags' => json_encode(['outdoor', 'leadership', 'survival']),
                'is_active' => true,
            ],
            [
                'nama' => 'Basket',
                'deskripsi' => 'Ekstrakurikuler basket untuk melatih keterampilan bermain basket, kerjasama tim, dan sportivitas. Siswa dibimbing untuk mengikuti kompetisi tingkat daerah.',
                'icon' => 'fas fa-basketball-ball',
                'pembina' => 'Pak Agus Widodo, S.Pd',
                'jadwal' => 'Senin & Rabu, 15:30 - 17:00',
                'tags' => json_encode(['olahraga', 'teamwork', 'kompetisi']),
                'is_active' => true,
            ],
            [
                'nama' => 'Karate',
                'deskripsi' => 'Seni bela diri Jepang yang mengajarkan disiplin, fokus, dan teknik pertahanan diri. Siswa dapat mengikuti ujian kenaikan sabuk.',
                'icon' => 'fas fa-fist-raised',
                'pembina' => 'Sensei Hendra Kusuma',
                'jadwal' => 'Selasa & Kamis, 15:30 - 17:00',
                'tags' => json_encode(['bela diri', 'disiplin', 'karakter']),
                'is_active' => true,
            ],
            [
                'nama' => 'Tari Tradisional',
                'deskripsi' => 'Melestarikan budaya Indonesia melalui seni tari tradisional. Siswa belajar berbagai tarian daerah dan sering tampil di acara sekolah.',
                'icon' => 'fas fa-user-friends',
                'pembina' => 'Ibu Sri Rahayu, S.Sn',
                'jadwal' => 'Rabu, 14:00 - 16:00',
                'tags' => json_encode(['seni', 'budaya', 'kreativitas']),
                'is_active' => true,
            ],
            [
                'nama' => 'Futsal',
                'deskripsi' => 'Olahraga sepak bola dalam ruangan yang melatih kelincahan, kecepatan, dan strategi bermain. Tim futsal sekolah rutin mengikuti turnamen.',
                'icon' => 'fas fa-futbol',
                'pembina' => 'Pak Rudi Hartono, S.Pd',
                'jadwal' => 'Jumat, 15:30 - 17:00',
                'tags' => json_encode(['olahraga', 'strategi', 'turnamen']),
                'is_active' => true,
            ],
            [
                'nama' => 'PMR (Palang Merah Remaja)',
                'deskripsi' => 'Organisasi kepemudaan binaan PMI yang mengajarkan pertolongan pertama, kesehatan, dan kemanusiaan.',
                'icon' => 'fas fa-plus-square',
                'pembina' => 'Ibu Dewi Lestari, S.Kep',
                'jadwal' => 'Sabtu, 13:00 - 15:00',
                'tags' => json_encode(['kesehatan', 'pertolongan', 'sosial']),
                'is_active' => true,
            ],
            [
                'nama' => 'English Club',
                'deskripsi' => 'Klub bahasa Inggris untuk meningkatkan kemampuan berbicara, listening, dan grammar melalui games, diskusi, dan drama.',
                'icon' => 'fas fa-language',
                'pembina' => 'Miss. Diana Putri, S.Pd',
                'jadwal' => 'Kamis, 15:00 - 16:30',
                'tags' => json_encode(['bahasa', 'komunikasi', 'global']),
                'is_active' => true,
            ],
            [
                'nama' => 'Robotika',
                'deskripsi' => 'Belajar merancang, membuat, dan memprogram robot. Siswa dilatih untuk mengikuti kompetisi robotika tingkat nasional.',
                'icon' => 'fas fa-robot',
                'pembina' => 'Pak Dian Pratama, S.T',
                'jadwal' => 'Selasa & Jumat, 15:30 - 17:30',
                'tags' => json_encode(['teknologi', 'STEM', 'inovasi']),
                'is_active' => true,
            ],
        ];

        foreach ($ekstrakurikulers as $data) {
            Ekstrakurikuler::create($data);
        }
    }
}
