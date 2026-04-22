<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Statistik;

class StatistikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statistik = [
            [
                'key' => 'siswa',
                'label' => 'Siswa',
                'value' => 269,
                'description' => 'Total jumlah siswa aktif di SMK Taman Siswa',
                'icon' => 'fa-user',
                'color' => 'primary',
                'is_active' => true,
            ],
            [
                'key' => 'guru',
                'label' => 'Guru dan Tata Usaha',
                'value' => 24,
                'description' => 'Total jumlah guru dan staff tata usaha',
                'icon' => 'fa-chalkboard-teacher',
                'color' => 'success',
                'is_active' => true,
            ],
            [
                'key' => 'rombel',
                'label' => 'Rombongan Belajar',
                'value' => 12,
                'description' => 'Total jumlah rombongan belajar (kelas)',
                'icon' => 'fa-users',
                'color' => 'info',
                'is_active' => true,
            ],
            [
                'key' => 'jurusan',
                'label' => 'Program Keahlian',
                'value' => 3,
                'description' => 'Total jumlah program keahlian yang tersedia',
                'icon' => 'fa-graduation-cap',
                'color' => 'warning',
                'is_active' => true,
            ],
        ];

        foreach ($statistik as $stat) {
            Statistik::create($stat);
        }
    }
}
