<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\PpdbBrosur;
use App\Models\PpdbJalur;
use App\Models\PpdbLink;

class ProfilSekolahController extends Controller
{
    public function profile()
    {
        // Fetch profile data from database (singleton)
        $profile = Profile::getSchoolProfile();

        return view('utama.content.profile', compact('profile'));
    }

    public function prestasi()
    {
        return view('utama.content.prestasi');
    }

    public function sejarah()
    {
        return view('utama.content.sejarah');
    }

    public function visiMisi()
    {
        return view('utama.content.visi-misi');
    }

    public function strukturOrganisasi()
    {
        return view('utama.content.struktur-organisasi');
    }

    public function ppdb()
    {
        $brosurs = PpdbBrosur::active()->ordered()->get();
        $jalurs = PpdbJalur::active()->ordered()->get();
        $links = PpdbLink::active()->ordered()->get();
        
        return view('utama.content.ppdb', compact('brosurs', 'jalurs', 'links'));
    }

    public function fasilitas()
    {
        return view('utama.content.fasilitas');
    }

    public function ekstrakulikuler()
    {
        return view('utama.content.ekstrakulikuler');
    }
}
