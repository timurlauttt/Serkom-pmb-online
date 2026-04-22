<?php

namespace Database\Seeders;

use App\Models\PpdbJalur;
use Illuminate\Database\Seeder;

class PpdbJalurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jalurs = [
            [
                'nama_jalur' => 'Jalur Prestasi Akademik',
                'deskripsi' => 'Jalur khusus bagi calon siswa yang memiliki prestasi akademik cemerlang dengan nilai rapor semester 1-5 minimal 85. Kuota terbatas untuk siswa berprestasi.',
                'kuota' => 30,
                'tanggal_mulai' => '2025-01-15',
                'tanggal_selesai' => '2025-02-15',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'nama_jalur' => 'Jalur Prestasi Non-Akademik',
                'deskripsi' => 'Jalur untuk calon siswa yang memiliki prestasi di bidang olahraga, seni, atau kompetisi lainnya minimal tingkat kabupaten/kota. Wajib melampirkan sertifikat prestasi.',
                'kuota' => 20,
                'tanggal_mulai' => '2025-01-15',
                'tanggal_selesai' => '2025-02-15',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'nama_jalur' => 'Jalur Zonasi',
                'deskripsi' => 'Jalur prioritas bagi calon siswa yang berdomisili di wilayah zonasi sekolah (radius 5 km dari sekolah). Wajib melampirkan Kartu Keluarga.',
                'kuota' => 100,
                'tanggal_mulai' => '2025-02-01',
                'tanggal_selesai' => '2025-03-15',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'nama_jalur' => 'Jalur Afirmasi',
                'deskripsi' => 'Jalur khusus untuk siswa dari keluarga kurang mampu (pemegang KIP/PKH) dan anak berkebutuhan khusus. Bebas biaya pendaftaran.',
                'kuota' => 15,
                'tanggal_mulai' => '2025-02-01',
                'tanggal_selesai' => '2025-03-15',
                'is_active' => true,
                'order' => 4,
            ],
            [
                'nama_jalur' => 'Jalur Perpindahan Tugas Orang Tua',
                'deskripsi' => 'Jalur bagi calon siswa yang orang tuanya mengalami perpindahan tugas ke wilayah Purwokerto. Wajib melampirkan surat perpindahan tugas.',
                'kuota' => 10,
                'tanggal_mulai' => '2025-02-15',
                'tanggal_selesai' => '2025-03-15',
                'is_active' => true,
                'order' => 5,
            ],
            [
                'nama_jalur' => 'Jalur Umum',
                'deskripsi' => 'Jalur pendaftaran reguler untuk calon siswa yang tidak termasuk dalam jalur-jalur khusus di atas. Seleksi berdasarkan nilai ujian dan daya tampung.',
                'kuota' => null,
                'tanggal_mulai' => '2025-03-01',
                'tanggal_selesai' => '2025-06-30',
                'is_active' => true,
                'order' => 6,
            ],
        ];

        foreach ($jalurs as $data) {
            PpdbJalur::create($data);
        }
    }
}
