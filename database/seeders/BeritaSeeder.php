<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Berita;
use Carbon\Carbon;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $beritas = [
            [
                'title' => 'Penerimaan Peserta Didik Baru SMK Taman Siswa Purwokerto Tahun Ajaran 2025/2026',
                'content' => 'SMK Taman Siswa Purwokerto membuka pendaftaran peserta didik baru untuk tahun ajaran 2025/2026. Pendaftaran dilakukan secara online melalui website resmi sekolah. Calon peserta didik dapat memilih dari berbagai jurusan yang tersedia seperti Teknik Komputer dan Jaringan, Akuntansi, dan Administrasi Perkantoran. Proses pendaftaran akan dibuka mulai tanggal 1 Januari hingga 31 Maret 2025. Untuk informasi lebih lanjut, silakan hubungi bagian tata usaha sekolah.',
                'author' => 'Humas SMK Taman Siswa',
                'category' => 'Kesiswaan',
                'posted_at' => Carbon::now()->subDays(1),
                'hashtags' => 'PPDB,pendaftaran,siswa baru,SMK Taman Siswa',
                'image_path' => null
            ],
            [
                'title' => 'Prestasi Gemilang Siswa SMK Taman Siswa di Lomba Kompetensi Siswa Nasional',
                'content' => 'Siswa SMK Taman Siswa Purwokerto meraih prestasi membanggakan dalam Lomba Kompetensi Siswa (LKS) Nasional. Ahmad Fauzi dari jurusan TKJ berhasil meraih juara 2 dalam bidang Network Systems Administration, sementara Siti Nurhaliza dari jurusan Akuntansi meraih juara 3 dalam bidang Accounting. Prestasi ini merupakan hasil dari kerja keras siswa dan bimbingan para guru yang kompeten.',
                'author' => 'Kepala Sekolah',
                'category' => 'Prestasi',
                'posted_at' => Carbon::now()->subDays(3),
                'hashtags' => 'LKS,prestasi,juara,kompetisi nasional',
                'image_path' => null
            ],
            [
                'title' => 'Workshop Industri 4.0 untuk Guru SMK Taman Siswa',
                'content' => 'SMK Taman Siswa mengadakan workshop tentang Industri 4.0 untuk seluruh guru. Workshop ini bertujuan untuk meningkatkan kompetensi guru dalam menghadapi era digitalisasi. Materi workshop meliputi Internet of Things (IoT), Big Data Analytics, dan Artificial Intelligence. Workshop dipimpin oleh pakar teknologi dari berbagai universitas ternama.',
                'author' => 'Tim Pengembangan SDM',
                'category' => 'Kurikulum',
                'posted_at' => Carbon::now()->subDays(5),
                'hashtags' => 'workshop,industri 4.0,teknologi,guru',
                'image_path' => null
            ],
            [
                'title' => 'Kerjasama SMK Taman Siswa dengan Industri Terkemuka',
                'content' => 'SMK Taman Siswa menandatangani MOU kerjasama dengan beberapa perusahaan industri terkemuka di Purwokerto. Kerjasama ini meliputi program magang siswa, sinkronisasi kurikulum dengan kebutuhan industri, dan penyerapan lulusan. Diharapkan dengan kerjasama ini, siswa akan lebih siap menghadapi dunia kerja setelah lulus.',
                'author' => 'Wakil Kepala Sekolah Humas',
                'category' => 'Humas',
                'posted_at' => Carbon::now()->subDays(7),
                'hashtags' => 'kerjasama,industri,MOU,magang',
                'image_path' => null
            ],
            [
                'title' => 'Pelaksanaan Ujian Praktik Kejuruan Tahun 2025',
                'content' => 'SMK Taman Siswa akan melaksanakan Ujian Praktik Kejuruan (UPK) untuk siswa kelas XII. Ujian dilaksanakan sesuai dengan standar kompetensi masing-masing jurusan. Siswa diharapkan mempersiapkan diri dengan baik mengingat UPK merupakan salah satu syarat kelulusan. Jadwal lengkap ujian dapat dilihat di papan pengumuman sekolah.',
                'author' => 'Panitia UPK',
                'category' => 'Kesiswaan',
                'posted_at' => Carbon::now()->subDays(10),
                'hashtags' => 'UPK,ujian praktek,kelulusan,siswa',
                'image_path' => null
            ],
            [
                'title' => 'Launching Program Kelas Wirausaha SMK Taman Siswa',
                'content' => 'SMK Taman Siswa meluncurkan program Kelas Wirausaha yang bertujuan mengembangkan jiwa entrepreneurship siswa. Program ini akan mengajarkan siswa cara memulai dan menjalankan bisnis. Kelas wirausaha akan dibimbing oleh praktisi bisnis berpengalaman dan alumni yang sukses di bidang wirausaha.',
                'author' => 'Koordinator Kewirausahaan',
                'category' => 'Kurikulum',
                'posted_at' => Carbon::now()->subDays(12),
                'hashtags' => 'wirausaha,entrepreneurship,bisnis,kelas khusus',
                'image_path' => null
            ],
            [
                'title' => 'Kegiatan Bakti Sosial SMK Taman Siswa di Panti Asuhan',
                'content' => 'Siswa dan guru SMK Taman Siswa mengadakan kegiatan bakti sosial di Panti Asuhan Kasih Sayang. Kegiatan meliputi pemberian bantuan berupa sembako, alat tulis, dan pakaian. Selain itu, siswa juga mengadakan kegiatan mengajar dan bermain bersama anak-anak panti. Kegiatan ini merupakan wujud kepedulian sekolah terhadap masyarakat.',
                'author' => 'OSIS SMK Taman Siswa',
                'category' => 'Kesiswaan',
                'posted_at' => Carbon::now()->subDays(14),
                'hashtags' => 'baksos,panti asuhan,peduli sosial,OSIS',
                'image_path' => null
            ],
            [
                'title' => 'Seminar Karir dan Prospek Kerja untuk Siswa Kelas XII',
                'content' => 'SMK Taman Siswa mengadakan seminar karir yang menghadirkan alumni sukses dari berbagai jurusan. Seminar bertujuan memberikan gambaran tentang prospek kerja dan tips sukses di dunia kerja. Narasumber berbagi pengalaman tentang perjalanan karir mereka setelah lulus dari SMK Taman Siswa.',
                'author' => 'BKK SMK Taman Siswa',
                'category' => 'Kesiswaan',
                'posted_at' => Carbon::now()->subDays(16),
                'hashtags' => 'seminar karir,alumni,prospek kerja,BKK',
                'image_path' => null
            ],
            [
                'title' => 'Renovasi Laboratorium Komputer SMK Taman Siswa',
                'content' => 'SMK Taman Siswa melakukan renovasi dan upgrade laboratorium komputer untuk mendukung pembelajaran yang lebih optimal. Renovasi meliputi penambahan komputer baru, pemasangan LCD projector, dan perbaikan sistem jaringan. Diharapkan dengan fasilitas yang lebih baik, pembelajaran di bidang teknologi informasi akan semakin efektif.',
                'author' => 'Kepala Lab Komputer',
                'category' => 'Iptek',
                'posted_at' => Carbon::now()->subDays(18),
                'hashtags' => 'renovasi,laboratorium,komputer,teknologi',
                'image_path' => null
            ],
            [
                'title' => 'Peringatan Hari Pendidikan Nasional di SMK Taman Siswa',
                'content' => 'SMK Taman Siswa memperingati Hari Pendidikan Nasional dengan berbagai kegiatan menarik. Acara dimulai dengan upacara bendera, dilanjutkan dengan lomba-lomba seperti cerdas cermat, debat, dan pentas seni. Kegiatan ini bertujuan meningkatkan semangat belajar siswa dan menghargai jasa para pahlawan pendidikan.',
                'author' => 'Panitia Hardiknas',
                'category' => 'Event',
                'posted_at' => Carbon::now()->subDays(20),
                'hashtags' => 'hardiknas,upacara,lomba,pendidikan',
                'image_path' => null
            ],
            [
                'title' => 'Training Digital Marketing untuk Guru SMK Taman Siswa',
                'content' => 'Para guru SMK Taman Siswa mengikuti training digital marketing sebagai bagian dari pengembangan kompetensi. Training meliputi strategi pemasaran digital, penggunaan media sosial, dan e-commerce. Diharapkan guru dapat mengintegrasikan pengetahuan ini dalam pembelajaran dan memberikan bekal kepada siswa.',
                'author' => 'Tim Training',
                'category' => 'Kurikulum',
                'posted_at' => Carbon::now()->subDays(22),
                'hashtags' => 'training,digital marketing,guru,kompetensi',
                'image_path' => null
            ],
            [
                'title' => 'Pelaksanaan Praktik Kerja Lapangan (PKL) Siswa SMK Taman Siswa',
                'content' => 'Siswa kelas XI SMK Taman Siswa telah menyelesaikan program Praktik Kerja Lapangan (PKL) di berbagai perusahaan mitra. PKL berlangsung selama 3 bulan dan memberikan pengalaman berharga kepada siswa tentang dunia kerja yang sesungguhnya. Mayoritas siswa mendapat penilaian baik dari tempat PKL.',
                'author' => 'Koordinator PKL',
                'category' => 'Kesiswaan',
                'posted_at' => Carbon::now()->subDays(24),
                'hashtags' => 'PKL,praktik kerja,pengalaman,industri',
                'image_path' => null
            ],
            [
                'title' => 'Gelar Karya Siswa SMK Taman Siswa Tahun 2025',
                'content' => 'SMK Taman Siswa menggelar pameran karya siswa yang menampilkan berbagai project dan inovasi dari seluruh jurusan. Pameran meliputi aplikasi mobile, produk akuntansi digital, dan sistem administrasi terintegrasi. Acara ini terbuka untuk umum dan menjadi ajang showcase kemampuan siswa kepada masyarakat.',
                'author' => 'Koordinator Gelar Karya',
                'category' => 'Event',
                'posted_at' => Carbon::now()->subDays(26),
                'hashtags' => 'gelar karya,pameran,project,inovasi',
                'image_path' => null
            ],
            [
                'title' => 'Sosialisasi Beasiswa untuk Siswa Berprestasi',
                'content' => 'SMK Taman Siswa mengadakan sosialisasi berbagai program beasiswa untuk siswa berprestasi. Beasiswa meliputi beasiswa akademik, beasiswa prestasi non-akademik, dan beasiswa untuk siswa kurang mampu. Siswa dihimbau untuk mempersiapkan persyaratan dengan baik agar dapat memanfaatkan kesempatan ini.',
                'author' => 'Tim Beasiswa',
                'category' => 'Kesiswaan',
                'posted_at' => Carbon::now()->subDays(28),
                'hashtags' => 'beasiswa,prestasi,sosialisasi,bantuan',
                'image_path' => null
            ],
            [
                'title' => 'Implementasi Kurikulum Merdeka di SMK Taman Siswa',
                'content' => 'SMK Taman Siswa mulai mengimplementasikan Kurikulum Merdeka sebagai upaya meningkatkan kualitas pendidikan. Implementasi dilakukan secara bertahap dengan melibatkan seluruh komponen sekolah. Para guru telah mengikuti pelatihan khusus untuk memahami konsep dan penerapan kurikulum baru ini.',
                'author' => 'Wakil Kepala Kurikulum',
                'category' => 'Kurikulum',
                'posted_at' => Carbon::now()->subDays(30),
                'hashtags' => 'kurikulum merdeka,implementasi,pendidikan,kualitas',
                'image_path' => null
            ],
            [
                'title' => 'Kunjungan Industri Siswa TKJ ke Perusahaan Teknologi',
                'content' => 'Siswa jurusan Teknik Komputer dan Jaringan mengadakan kunjungan industri ke beberapa perusahaan teknologi di Jakarta. Kunjungan bertujuan memberikan gambaran nyata tentang perkembangan teknologi dan peluang karir di bidang IT. Siswa berkesempatan melihat langsung infrastruktur teknologi dan berinteraksi dengan para profesional.',
                'author' => 'Koordinator TKJ',
                'category' => 'Kesiswaan',
                'posted_at' => Carbon::now()->subDays(32),
                'hashtags' => 'kunjungan industri,TKJ,teknologi,Jakarta',
                'image_path' => null
            ],
            [
                'title' => 'Pelatihan Public Speaking untuk Siswa SMK Taman Siswa',
                'content' => 'SMK Taman Siswa mengadakan pelatihan public speaking untuk meningkatkan kemampuan komunikasi siswa. Pelatihan dipandu oleh trainer berpengalaman dan meliputi teknik berbicara di depan umum, manajemen panggung, dan cara mengatasi nervousness. Kegiatan ini sangat bermanfaat untuk mengembangkan soft skill siswa.',
                'author' => 'Pembina OSIS',
                'category' => 'Kesiswaan',
                'posted_at' => Carbon::now()->subDays(34),
                'hashtags' => 'public speaking,komunikasi,soft skill,pelatihan',
                'image_path' => null
            ],
            [
                'title' => 'Kegiatan Literasi Digital di SMK Taman Siswa',
                'content' => 'SMK Taman Siswa meluncurkan program literasi digital untuk meningkatkan kemampuan siswa dalam menggunakan teknologi secara bijak. Program meliputi edukasi tentang keamanan internet, etika digital, dan cara mengidentifikasi hoax. Kegiatan ini sangat penting di era digital saat ini.',
                'author' => 'Tim Literasi Digital',
                'category' => 'Iptek',
                'posted_at' => Carbon::now()->subDays(36),
                'hashtags' => 'literasi digital,teknologi,keamanan internet,hoax',
                'image_path' => null
            ],
            [
                'title' => 'Peringatan Hari Kartini dengan Fashion Show Busana Tradisional',
                'content' => 'SMK Taman Siswa memperingati Hari Kartini dengan menggelar fashion show busana tradisional. Acara menampilkan berbagai busana daerah dari seluruh Indonesia yang dikenakan oleh siswa dan guru. Kegiatan ini bertujuan melestarikan budaya Indonesia dan menghargai perjuangan R.A. Kartini.',
                'author' => 'Panitia Hari Kartini',
                'category' => 'Event',
                'posted_at' => Carbon::now()->subDays(38),
                'hashtags' => 'hari kartini,fashion show,budaya,tradisional',
                'image_path' => null
            ],
            [
                'title' => 'Pembentukan Tim Robotika SMK Taman Siswa',
                'content' => 'SMK Taman Siswa membentuk tim robotika untuk mengikuti berbagai kompetisi robotika tingkat regional dan nasional. Tim robotika akan dilatih oleh guru-guru kompeten dan alumni yang berpengalaman di bidang robotika. Sekolah juga menyediakan fasilitas laboratorium khusus untuk pengembangan robot.',
                'author' => 'Koordinator Tim Robotika',
                'category' => 'Iptek',
                'posted_at' => Carbon::now()->subDays(40),
                'hashtags' => 'robotika,kompetisi,teknologi,inovasi',
                'image_path' => null
            ]
        ];

        foreach ($beritas as $berita) {
            Berita::create($berita);
        }
    }
}