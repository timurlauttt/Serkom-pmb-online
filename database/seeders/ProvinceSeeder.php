<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Provinces;
class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Implementasi seeding untuk data provinsi
        $provinces = [
            
            // Seeder data provinsi di pulau Sumatera
            ['name' => 'NAD Aceh', 'code' => 'NAD'],
            ['name' => 'Sumatera Utara', 'code' => 'SUMUT'],
            ['name' => 'Sumatera Barat', 'code' => 'SUMBAR'],
            ['name' => 'Sumatera Selatan', 'code' => 'SUMSEL'],
            ['name' => 'Riau', 'code' => 'RIAU'],
            ['name' => 'Kepulauan Riau', 'code' => 'KEPRI'],
            ['name' => 'Jambi', 'code' => 'JAMBI'],
            ['name' => 'Bengkulu', 'code' => 'BENGKULU'],
            ['name' => 'Bangka Belitung', 'code' => 'BABEL'],
            ['name' => 'Lampung', 'code' => 'LAMPUNG'],
            
            // Seeder data provinsi di pulau Jawa
            ['name' => 'Banten', 'code' => 'BANTEN'],
            ['name' => 'Jawa Barat', 'code' => 'JABAR'],
            ['name' => 'Jawa Tengah', 'code' => 'JATENG'],
            ['name' => 'Jawa Timur', 'code' => 'JATIM'],
            ['name' => 'DKI Jakarta', 'code' => 'JKT'],
            ['name' => 'DI Yogyakarta', 'code' => 'DIY'],

            // Seeder data provinsi di pulau Bali
            ['name' => 'Bali', 'code' => 'BALI'],

            // Seeder data provinsi di pulau Nusa Tenggara
            ['name' => 'Nusa Tenggara Barat', 'code' => 'NTB'],
            ['name' => 'Nusa Tenggara Timur', 'code' => 'NTT'],


            // Seeder data provinsi di pulau Kalimantan
            ['name' => 'Kalimantan Barat', 'code' => 'KALBAR'],
            ['name' => 'Kalimantan Selatan', 'code' => 'KALSEL'],
            ['name' => 'Kalimantan Tengah', 'code' => 'KALTENG'],
            ['name' => 'Kalimantan Timur', 'code' => 'KALTIM'],
            ['name' => 'Kalimantan Utara', 'code' => 'KALTARA'],

            // Seeder data provinsi di pulau Sulawesi
            ['name' => 'Gorontalo', 'code' => 'GORONTALO'],
            ['name' => 'Sulawesi Selatan', 'code' => 'SULSEL'],
            ['name' => 'Sulawesi Tenggara', 'code' => 'SULTRA'],
            ['name' => 'Sulawesi Tengah', 'code' => 'SULTENG'],
            ['name' => 'Sulawesi Utara', 'code' => 'SULUT'],
            ['name' => 'Sulawesi Barat', 'code' => 'SULBAR'],

            // Seeder data provinsi di pulau Maluku
            ['name' => 'Maluku', 'code' => 'MALUKU'],
            ['name' => 'Maluku Utara', 'code' => 'MALUT'],

            // Seeder data provinsi di pulau Papua
            ['name' => 'Papua', 'code' => 'PAPUA'],
            ['name' => 'Papua Barat', 'code' => 'PAPBAR'],
        ];

        foreach ($provinces as $province) {
            Provinces::create($province);
        }
    }
}