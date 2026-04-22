<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Event;
use App\Models\Pengumuman;
use App\Models\Galeri;
use App\Models\Pendaftaran;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'berita' => Berita::count(),
            'event' => Event::count(),
            'pengumuman' => Pengumuman::count(),
            'galeri' => Galeri::count(),
            'pendaftaran' => Pendaftaran::count(),
        ];
        
        $recentBerita = Berita::latest()->take(5)->get();
        $recentEvents = Event::latest()->take(5)->get();
        
        return view('admin.dashboard', compact('stats', 'recentBerita', 'recentEvents'));
    }
}
