<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\ObjekWisata;
use App\Models\PaketWisata;
use App\Models\Desawisata;
use App\Models\Transportasi;
use App\Models\Galeri;
use App\Models\Berita;
use App\Models\Restoran;
class TicController extends Controller
{
    public function index()
    {
        $hotelList = Hotel::orderBy('nama', 'asc')->get();
        $objekWisataList = ObjekWisata::orderBy('nama', 'asc')->get();
        $paketWisataList = PaketWisata::orderBy('nama_paket', 'asc')->get();
        $desaWisataList = Desawisata::orderBy('nama', 'asc')->get();
        $transportasiList = Transportasi::orderBy('nama_provider', 'asc')->get();
        $restoranList = Restoran::orderBy('nama', 'asc')->get();
        $beritas = Berita::latest()->take(4)->get();

        $galleryList = isset($galeris)
            ? $galeris->take(8) : Galeri::latest()->take(8)->get();

        return view('utama.content.tic.tic', compact('galleryList', 'beritas', 'hotelList', 'objekWisataList', 'paketWisataList', 'desaWisataList', 'transportasiList', 'restoranList'));
    }

    public function desaWisataDetail($slug)
    {
        $desaWisata = Desawisata::where('slug', $slug)->firstOrFail();

        return view('utama.content.tic.desa-wisata-detail', compact('desaWisata'));
    }


    public function restoranDetail($slug)
    {
        $restoran = Restoran::where('slug', $slug)->firstOrFail();

        return view('utama.content.tic.restoran-detail', compact('restoran'));
    }

    public function hotelDetail($slug)
    {
        $hotel = Hotel::where('slug', $slug)->firstOrFail();

        return view('utama.content.tic.hotel-detail', compact('hotel'));
    }

    public function objekWisataDetail($slug)
    {
        $objekWisata = ObjekWisata::where('slug', $slug)->firstOrFail();

        return view('utama.content.tic.obyek-wisata-detail', compact('objekWisata'));
    }

    public function paketWisataDetail($slug)
    {
        $paketWisata = PaketWisata::where('slug', $slug)->firstOrFail();

        return view('utama.content.tic.paket-wisata-detail', compact('paketWisata'));
    }

    public function transportasiDetail($slug)
    {
        $transportasi = Transportasi::where('slug', $slug)->firstOrFail();

        return view('utama.content.tic.transportasi-detail', compact('transportasi'));
    }

    
}
