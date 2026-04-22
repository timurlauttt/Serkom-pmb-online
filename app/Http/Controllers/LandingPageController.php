<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Jurusan;
use App\Models\Berita;
use App\Models\Pengumuman;
use App\Models\Galeri;
use App\Models\User;
use App\Models\Event;
use App\Models\Mitra;
use App\Models\Statistik;

class LandingPageController extends Controller
{
    public function index()
    {
        // Ambil data untuk halaman welcome
        $profile = Profile::getSchoolProfile();
        $jurusans = Jurusan::orderBy('created_at', 'desc')->take(3)->get();

        // Hero slider dari berita featured
        $heroSliders = Berita::featured()->latest()->take(4)->get();

        // Berita terbaru untuk section berita
        $beritas = Berita::latest('created_at')->take(3)->get();

        // Event terbaru (prepare 3 untuk tampilan landing)
        $eventsList = Event::latest('created_at')->take(3)->get();

        // Pengumuman terbaru (prepare 3 untuk tampilan landing)
        $announcements = Pengumuman::latest('created_at')->take(3)->get();

        // Galeri (prepare 3)
        $galleryList = Galeri::latest('created_at')->take(8)->get();

        // Mitra
        $mitraList = Mitra::orderBy('nama')->get();

        // Statistik sekolah dari database atau fallback
        $statsData = Statistik::getActive();
        $stats = [];

        if ($statsData->isNotEmpty()) {
            // Jika ada data di database, gunakan data tersebut
            foreach ($statsData as $stat) {
                $stats[$stat->key] = [
                    'value' => $stat->value,
                    'label' => $stat->label,
                    'icon' => $stat->icon,
                    'color' => $stat->color,
                ];
            }
        } else {
            // Fallback ke data hardcode jika belum ada di database
            $stats = [
                'siswa' => ['value' => 69, 'label' => 'Siswa', 'icon' => 'fa-user', 'color' => 'primary'],
                'guru' => ['value' => 16, 'label' => 'Guru dan Tata Usaha', 'icon' => 'fa-chalkboard-teacher', 'color' => 'success'],
                'rombel' => ['value' => 9, 'label' => 'Rombongan Belajar', 'icon' => 'fa-users', 'color' => 'info'],
                'jurusan' => ['value' => Jurusan::count() ?: 3, 'label' => 'Program Keahlian', 'icon' => 'fa-graduation-cap', 'color' => 'warning'],
            ];
        }

        return view('welcome', compact(
            'profile',
            'jurusans',
            'heroSliders',
            'beritas',
            'eventsList',
            'announcements',
            'galleryList',
            'mitraList',
            'stats'
        ));
    }

    public function hero()
    {
        return view('utama.content.hero');
    }

    public function infosekolah()
    {
        return view('utama.content.info-sekolah');
    }
    public function infojurusan()
    {
        return view('utama.content.info-jurusan');
    }

    public function berita()
    {
        return view('utama.content.berita');
    }

    public function event()
    {
        $events = Event::with('jurusan')
            ->active()
            ->orderBy('start_date', 'desc')
            ->paginate(9);
        
        $jurusans = Jurusan::all();
        
        return view('utama.content.event', compact('events', 'jurusans'));
    }

    public function pengumuman()
    {
        return view('utama.content.pengumuman');
    }

    public function galeri()
    {
        return view('utama.content.galeri');
    }
}
