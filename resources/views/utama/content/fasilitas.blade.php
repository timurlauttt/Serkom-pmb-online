@extends('utama.layouts.app')
@section('title', 'Fasilitas - SMK Taman Siswa Purwokerto')

@section('content')

{{-- Page Header --}}
<x-page-header
    title="FASILITAS SEKOLAH"
    subtitle="Sarana dan prasarana lengkap untuk mendukung pembelajaran optimal"
    :breadcrumbs="[
        ['title' => 'Profil', 'url' => '#'],
        ['title' => 'Fasilitas', 'url' => route('profilsekolah.fasilitas')]
    ]" />

<section class="section">
    <div class="container">
        {{-- Facilities Grid --}}
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 2rem;">

            {{-- Facility Card 1 --}}
            <div style="background: white; border-radius: 1rem; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: all 0.3s;">
                <div style="height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-chalkboard-teacher" style="font-size: 5rem; color: white; opacity: 0.9;"></i>
                </div>
                <div style="padding: 1.5rem;">
                    <h4 style="margin-bottom: 1rem; color: #333;">Ruang Kelas Modern</h4>
                    <p style="color: #666; line-height: 1.6; margin-bottom: 1rem;">
                        Dilengkapi dengan AC, proyektor, dan fasilitas multimedia untuk pembelajaran yang nyaman dan interaktif.
                    </p>
                    <ul style="color: #666; font-size: 0.9rem; padding-left: 1.25rem;">
                        <li>Kapasitas 36 siswa</li>
                        <li>AC & Proyektor</li>
                        <li>Wi-Fi gratis</li>
                    </ul>
                </div>
            </div>

            {{-- Facility Card 2 --}}
            <div style="background: white; border-radius: 1rem; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: all 0.3s;">
                <div style="height: 200px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-laptop-code" style="font-size: 5rem; color: white; opacity: 0.9;"></i>
                </div>
                <div style="padding: 1.5rem;">
                    <h4 style="margin-bottom: 1rem; color: #333;">Laboratorium Komputer</h4>
                    <p style="color: #666; line-height: 1.6; margin-bottom: 1rem;">
                        Lab komputer dengan perangkat terbaru untuk mendukung pembelajaran praktik teknologi informasi.
                    </p>
                    <ul style="color: #666; font-size: 0.9rem; padding-left: 1.25rem;">
                        <li>40 Unit komputer</li>
                        <li>Software terkini</li>
                        <li>Internet cepat</li>
                    </ul>
                </div>
            </div>

            {{-- Facility Card 3 --}}
            <div style="background: white; border-radius: 1rem; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: all 0.3s;">
                <div style="height: 200px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-book-reader" style="font-size: 5rem; color: white; opacity: 0.9;"></i>
                </div>
                <div style="padding: 1.5rem;">
                    <h4 style="margin-bottom: 1rem; color: #333;">Perpustakaan</h4>
                    <p style="color: #666; line-height: 1.6; margin-bottom: 1rem;">
                        Koleksi buku lengkap dan ruang baca nyaman untuk menunjang literasi siswa.
                    </p>
                    <ul style="color: #666; font-size: 0.9rem; padding-left: 1.25rem;">
                        <li>5000+ koleksi buku</li>
                        <li>Ruang baca ber-AC</li>
                        <li>E-library</li>
                    </ul>
                </div>
            </div>

            {{-- More Facilities --}}
            <div style="background: white; border-radius: 1rem; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: all 0.3s;">
                <div style="height: 200px; background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-utensils" style="font-size: 5rem; color: white; opacity: 0.9;"></i>
                </div>
                <div style="padding: 1.5rem;">
                    <h4 style="margin-bottom: 1rem; color: #333;">Kantin Sekolah</h4>
                    <p style="color: #666; line-height: 1.6; margin-bottom: 1rem;">
                        Kantin bersih dan sehat dengan menu makanan bergizi dan harga terjangkau.
                    </p>
                </div>
            </div>

            <div style="background: white; border-radius: 1rem; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: all 0.3s;">
                <div style="height: 200px; background: linear-gradient(135deg, #30cfd0 0%, #330867 100%); display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-mosque" style="font-size: 5rem; color: white; opacity: 0.9;"></i>
                </div>
                <div style="padding: 1.5rem;">
                    <h4 style="margin-bottom: 1rem; color: #333;">Musholla</h4>
                    <p style="color: #666; line-height: 1.6; margin-bottom: 1rem;">
                        Tempat ibadah yang nyaman dan bersih untuk kegiatan keagamaan siswa dan guru.
                    </p>
                </div>
            </div>

            <div style="background: white; border-radius: 1rem; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: all 0.3s;">
                <div style="height: 200px; background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%); display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-futbol" style="font-size: 5rem; color: #667eea; opacity: 0.9;"></i>
                </div>
                <div style="padding: 1.5rem;">
                    <h4 style="margin-bottom: 1rem; color: #333;">Lapangan Olahraga</h4>
                    <p style="color: #666; line-height: 1.6; margin-bottom: 1rem;">
                        Area olahraga untuk berbagai aktivitas fisik dan pengembangan bakat siswa.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    .container>div>div {
        transition: all 0.3s;
    }

    .container>div>div:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15) !important;
    }

    @media (max-width: 768px) {
        .container>div {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endpush