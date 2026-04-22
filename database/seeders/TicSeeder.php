<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hotel;
use App\Models\Restoran;
use App\Models\ObjekWisata;
use App\Models\Desawisata;
use App\Models\Transportasi;
use App\Models\PaketWisata;
use Illuminate\Support\Str;

class TicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Hotels (unique entries only)
        $hotels = [
            [
                'nama' => 'Hotel Santika Purwokerto 1',
                'slug' => 'hotel-santika-purwokerto-1',
                'alamat' => 'Jl. Jenderal Sudirman No. 135',
                'kota' => 'Purwokerto',
                'deskripsi' => 'Hotel bintang 4 dengan fasilitas lengkap dan lokasi strategis di pusat kota Purwokerto. Menyediakan restoran, kolam renang, fitness center, dan meeting room yang modern.',
                'harga_mulai' => 650000,
                'kontak' => '0281-1234567',
            ],
            [
                'nama' => 'Grand Tjokro Hotel Purwokerto 1',
                'slug' => 'grand-tjokro-hotel-purwokerto-1',
                'alamat' => 'Jl. Dr. Angka No. 88',
                'kota' => 'Purwokerto',
                'deskripsi' => 'Hotel berbintang dengan pemandangan kota yang indah. Dilengkapi dengan restoran all-day dining, spa, dan ballroom untuk berbagai acara.',
                'harga_mulai' => 550000,
                'kontak' => '0281-2345678',
            ],
            [
                'nama' => 'Hotel Horison Purwokerto 1',
                'slug' => 'hotel-horison-purwokerto-1',
                'alamat' => 'Jl. Jenderal Gatot Subroto No. 106',
                'kota' => 'Purwokerto',
                'deskripsi' => 'Hotel nyaman dengan kamar-kamar modern dan pelayanan ramah. Memiliki restoran dengan menu lokal dan internasional, serta ruang meeting yang luas.',
                'harga_mulai' => 450000,
                'kontak' => '0281-3456789',
            ],
            [
                'nama' => 'Amaris Hotel Purwokerto 1',
                'slug' => 'amaris-hotel-purwokerto-1',
                'alamat' => 'Jl. Pierre Tendean No. 8',
                'kota' => 'Purwokerto',
                'deskripsi' => 'Hotel budget dengan konsep smart room. Kamar bersih, nyaman, dan modern dengan harga terjangkau. Cocok untuk wisatawan bisnis dan keluarga.',
                'harga_mulai' => 350000,
                'kontak' => '0281-4567890',
            ],
        ];

        foreach ($hotels as $hotel) {
            Hotel::updateOrCreate(['slug' => $hotel['slug']], $hotel);
        }

        // Seed Restoran (unique entries only)
        $restorans = [
            [
                'nama' => 'Rumah Makan Soto Sokaraja 1',
                'slug' => 'rumah-makan-soto-sokaraja-1',
                'alamat' => 'Jl. Raya Sokaraja No. 45',
                'kota' => 'Purwokerto',
                'deskripsi' => 'Rumah makan legendaris dengan menu utama Soto Sokaraja yang terkenal di seluruh Banyumas. Kuah soto yang gurih dengan isian daging sapi pilihan dan kerupuk rambak yang renyah.',
                'jam_operasional' => '07:00 - 21:00',
                'kontak' => '0281-6123456',
            ],
            [
                'nama' => 'Warung Mendoan Pak Kumis 1',
                'slug' => 'warung-mendoan-pak-kumis-1',
                'alamat' => 'Jl. Overste Isdiman No. 12',
                'kota' => 'Purwokerto',
                'deskripsi' => 'Warung mendoan paling terkenal di Purwokerto. Mendoan tempe yang renyah di luar dan lembut di dalam, disajikan dengan sambal kecap dan cabai rawit. Cocok untuk camilan sore.',
                'jam_operasional' => '15:00 - 22:00',
                'kontak' => '0281-7234567',
            ],
            [
                'nama' => 'Restoran Gepuk Mbok Darmi 1',
                'slug' => 'restoran-gepuk-mbok-darmi-1',
                'alamat' => 'Jl. Supriyadi No. 28',
                'kota' => 'Purwokerto',
                'deskripsi' => 'Restoran dengan menu khas Gepuk Purwokerto yang empuk dan bumbu meresap sempurna. Disajikan dengan nasi hangat, sambal terasi, dan lalapan segar. Tempat favorit wisatawan kuliner.',
                'jam_operasional' => '10:00 - 20:00',
                'kontak' => '0281-8345678',
            ],
            [
                'nama' => 'Ayam Goreng Pak Ulung 1',
                'slug' => 'ayam-goreng-pak-ulung-1',
                'alamat' => 'Jl. HR Bunyamin No. 67',
                'kota' => 'Purwokerto',
                'deskripsi' => 'Rumah makan dengan spesialisasi ayam goreng kremes yang gurih dan renyah. Menggunakan resep turun temurun dengan bumbu rempah khas Banyumas. Selalu ramai pengunjung saat jam makan.',
                'jam_operasional' => '08:00 - 21:00',
                'kontak' => '0281-9456789',
            ],
        ];

        foreach ($restorans as $restoran) {
            Restoran::updateOrCreate(['slug' => $restoran['slug']], $restoran);
        }

        // Seed Objek Wisata (unique entries only)
        $objekWisatas = [
            [
                'nama' => 'Curug Cipendok 2',
                'slug' => 'curug-cipendok-2',
                'alamat' => 'Desa Karangmangu, Kecamatan Cilongok',
                'kota' => 'Banyumas',
                'deskripsi' => 'Air terjun setinggi 92 meter yang dikelilingi hutan tropis. Suasana sejuk dan asri dengan suara gemericik air yang menenangkan. Terdapat area camping ground dan fasilitas outbound.',
                'harga_tiket' => 15000,
                'jam_operasional' => '08:00 - 17:00',
            ],
            [
                'nama' => 'Baturaden 2',
                'slug' => 'baturaden-2',
                'alamat' => 'Kecamatan Baturaden',
                'kota' => 'Banyumas',
                'deskripsi' => 'Kawasan wisata pegunungan di lereng Gunung Slamet dengan udara sejuk dan pemandangan indah. Terdapat berbagai wahana seperti Lokawisata Baturaden, pemandian air panas, dan taman bermain.',
                'harga_tiket' => 25000,
                'jam_operasional' => '07:00 - 18:00',
            ],
            [
                'nama' => 'Small World Purwokerto 2',
                'slug' => 'small-world-purwokerto-2',
                'alamat' => 'Jl. Raya Baturaden KM 8',
                'kota' => 'Purwokerto',
                'deskripsi' => 'Taman miniatur dunia dengan replika bangunan-bangunan terkenal dari berbagai negara. Spot foto instagramable dengan latar belakang Menara Eiffel, Big Ben, dan landmark dunia lainnya.',
                'harga_tiket' => 35000,
                'jam_operasional' => '08:00 - 17:00',
            ],
            [
                'nama' => 'Museum BRI 2',
                'slug' => 'museum-bri-2',
                'alamat' => 'Jl. Jenderal Sudirman No. 57',
                'kota' => 'Purwokerto',
                'deskripsi' => 'Museum yang menyimpan sejarah perbankan Indonesia khususnya BRI. Terdapat koleksi mata uang kuno, dokumen bersejarah, dan replika kantor BRI tempo dulu. Cocok untuk wisata edukasi.',
                'harga_tiket' => 0,
                'jam_operasional' => '08:00 - 16:00',
            ],
        ];

        foreach ($objekWisatas as $objek) {
            ObjekWisata::updateOrCreate(['slug' => $objek['slug']], $objek);
        }

        // Seed Desa Wisata (unique entries only)
        $desaWisatas = [
            [
                'nama' => 'Desa Wisata Ketenger 2',
                'slug' => 'desa-wisata-ketenger-2',
                'alamat' => 'Desa Ketenger, Kecamatan Baturaden',
                'kota' => 'Banyumas',
                'deskripsi' => 'Desa wisata dengan konsep pertanian dan perkebunan. Pengunjung dapat belajar memetik sayuran organik, membuat pupuk kompos, dan merasakan kehidupan petani di pegunungan.',
                'harga_tiket' => 20000,
                'jam_operasional' => '08:00 - 16:00',
            ],
            [
                'nama' => 'Desa Wisata Karangmangu 2',
                'slug' => 'desa-wisata-karangmangu-2',
                'alamat' => 'Desa Karangmangu, Kecamatan Cilongok',
                'kota' => 'Banyumas',
                'deskripsi' => 'Desa wisata dengan pesona alam yang masih alami. Terdapat tracking ke air terjun, wisata sungai, dan pengalaman hidup bersama warga desa. Homestay dengan nuansa pedesaan tersedia.',
                'harga_tiket' => 15000,
                'jam_operasional' => '07:00 - 17:00',
            ],
            [
                'nama' => 'Desa Wisata Pekunden 2',
                'slug' => 'desa-wisata-pekunden-2',
                'alamat' => 'Desa Pekunden, Kecamatan Baturaden',
                'kota' => 'Banyumas',
                'deskripsi' => 'Desa wisata dengan kerajinan anyaman bambu yang terkenal. Wisatawan dapat belajar membuat berbagai produk dari bambu seperti tas, tempat pensil, dan hiasan rumah.',
                'harga_tiket' => 10000,
                'jam_operasional' => '08:00 - 16:00',
            ],
            [
                'nama' => 'Desa Wisata Serang 2',
                'slug' => 'desa-wisata-serang-2',
                'alamat' => 'Desa Serang, Kecamatan Karangreja',
                'kota' => 'Purbalingga',
                'deskripsi' => 'Desa wisata dengan budaya dan tradisi Jawa yang masih kental. Terdapat pertunjukan kesenian Calung, Begalan, dan upacara adat. Pengunjung dapat belajar membatik dan membuat jamu tradisional.',
                'harga_tiket' => 25000,
                'jam_operasional' => '08:00 - 17:00',
            ],
        ];

        foreach ($desaWisatas as $desa) {
            Desawisata::updateOrCreate(['slug' => $desa['slug']], $desa);
        }

        // Seed Transportasi (unique entries only)
        $transportasis = [
            [
                'jenis' => 'Rental Mobil',
                'nama_provider' => 'Banyumas Rent Car',
                'slug' => 'banyumas-rent-car',
                'harga' => 300000,
                'kontak' => '0812-3456-7890',
            ],
            [
                'jenis' => 'Travel',
                'nama_provider' => 'Travel Purwokerto Express',
                'slug' => 'travel-purwokerto-express',
                'harga' => 150000,
                'kontak' => '0813-4567-8901',
            ],
            [
                'jenis' => 'Rental Motor',
                'nama_provider' => 'Slamet Motor Rental',
                'slug' => 'slamet-motor-rental',
                'harga' => 75000,
                'kontak' => '0814-5678-9012',
            ],
            [
                'jenis' => 'Bus Pariwisata',
                'nama_provider' => 'Baturaden Trans',
                'slug' => 'baturaden-trans',
                'harga' => 2500000,
                'kontak' => '0815-6789-0123',
            ],
        ];

        foreach ($transportasis as $transportasi) {
            Transportasi::updateOrCreate(['slug' => $transportasi['slug']], $transportasi);
        }

        // Seed Paket Wisata (unique entries only)
        $paketWisatas = [
            [
                'nama_paket' => 'Paket Wisata Baturaden 2D1N 1',
                'slug' => 'paket-wisata-baturaden-2d1n-1',
                'harga' => 850000,
                'durasi_hari' => 2,
                'keterangan' => 'Paket wisata 2 hari 1 malam ke Baturaden. Termasuk penginapan, makan 3x, tiket masuk objek wisata (Lokawisata Baturaden, Curug Cipendok), dan transportasi selama tour.',
                'id_hotel' => null,
            ],
            [
                'nama_paket' => 'Paket Wisata Kuliner Purwokerto 1',
                'slug' => 'paket-wisata-kuliner-purwokerto-1',
                'harga' => 250000,
                'durasi_hari' => 1,
                'keterangan' => 'Paket wisata kuliner mengunjungi 5 spot kuliner legendaris Purwokerto. Termasuk transportasi dan guide kuliner. Menu: Soto Sokaraja, Mendoan, Getuk Goreng, Dawet Ayu, dan Gethuk.',
                'id_hotel' => null,
            ],
            [
                'nama_paket' => 'Paket Wisata Edukasi Desa 1',
                'slug' => 'paket-wisata-edukasi-desa-1',
                'harga' => 450000,
                'durasi_hari' => 1,
                'keterangan' => 'Paket wisata edukasi ke desa wisata dengan aktivitas memetik sayuran, membuat kerajinan bambu, dan belajar membatik. Termasuk makan siang khas desa, transportasi, dan guide.',
                'id_hotel' => null,
            ],
            [
                'nama_paket' => 'Paket Honeymoon Romantis 3D2N 1',
                'slug' => 'paket-honeymoon-romantis-3d2n-1',
                'harga' => 3500000,
                'durasi_hari' => 3,
                'keterangan' => 'Paket bulan madu romantic 3 hari 2 malam. Menginap di hotel bintang 4 dengan kamar suite, romantic dinner, couple spa, dan kunjungan ke tempat-tempat romantis di Purwokerto.',
                'id_hotel' => null,
            ],
        ];

        foreach ($paketWisatas as $paket) {
            PaketWisata::updateOrCreate(['slug' => $paket['slug']], $paket);
        }

        $this->command->info('TIC data seeded successfully!');
    }
}
