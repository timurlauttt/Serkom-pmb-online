<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $religions = [
            ['name' => 'Islam', 'code' => 'ISL'],
            ['name' => 'Protestan', 'code' => 'PRT'],
            ['name' => 'Katolik', 'code' => 'KTL'],
            ['name' => 'Hindu', 'code' => 'HND'],
            ['name' => 'Buddha', 'code' => 'BDH'],
            ['name' => 'Konghucu', 'code' => 'KNG'],
        ];

        foreach ($religions as $religion) {
            \App\Models\Religion::create($religion);
        }
    }
}
