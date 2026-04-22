@extends('utama.layouts.app')
@section('title', 'Sejarah - SMK Taman Siswa Purwokerto')

@section('content')

{{-- Page Header --}}
<x-page-header 
    title="SEJARAH SEKOLAH"
    subtitle="Perjalanan panjang menuju keunggulan pendidikan kejuruan"
    :breadcrumbs="[
        ['title' => 'Profil', 'url' => '#'],
        ['title' => 'Sejarah', 'url' => route('profilsekolah.sejarah')]
    ]"
/>

<section class="section">
    <div class="container" style="max-width: 900px;">
        {{-- Timeline Style Content --}}
        <div style="position: relative;">
            {{-- Timeline Line --}}
            <div style="position: absolute; left: 20px; top: 0; bottom: 0; width: 4px; background: linear-gradient(to bottom, #667eea, #764ba2);"></div>
            
            {{-- Timeline Items --}}
            <div style="padding-left: 60px;">
                
                {{-- Item 1 - Pendirian --}}
                <div style="position: relative; margin-bottom: 3rem;">
                    <div style="position: absolute; left: -48px; width: 40px; height: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700;">
                        <i class="fas fa-flag"></i>
                    </div>
                    <div style="background: white; padding: 2rem; border-radius: 1rem; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                        <h4 style="color: #667eea; margin-bottom: 0.5rem;">Pendirian Sekolah (1950)</h4>
                        <p style="color: #666; line-height: 1.8;">
                            SMK Taman Siswa Purwokerto didirikan pada tahun 1950 oleh para tokoh pendidikan yang berkomitmen 
                            untuk memberikan pendidikan kejuruan berkualitas bagi generasi muda. Berawal dari sebuah gedung 
                            sederhana, sekolah ini bertekad menghasilkan lulusan yang siap terjun ke dunia kerja.
                        </p>
                    </div>
                </div>

                {{-- Item 2 - Perkembangan --}}
                <div style="position: relative; margin-bottom: 3rem;">
                    <div style="position: absolute; left: -48px; width: 40px; height: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700;">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <div style="background: white; padding: 2rem; border-radius: 1rem; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                        <h4 style="color: #667eea; margin-bottom: 0.5rem;">Masa Perkembangan (1970-1990)</h4>
                        <p style="color: #666; line-height: 1.8;">
                            Pada periode ini, sekolah mengalami perkembangan pesat dengan penambahan program keahlian baru 
                            dan peningkatan fasilitas pembelajaran. Gedung-gedung baru dibangun untuk menampung jumlah siswa 
                            yang terus bertambah. Kerjasama dengan dunia industri juga mulai dijalin.
                        </p>
                    </div>
                </div>

                {{-- Item 3 - Modernisasi --}}
                <div style="position: relative; margin-bottom: 3rem;">
                    <div style="position: absolute; left: -48px; width: 40px; height: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700;">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <div style="background: white; padding: 2rem; border-radius: 1rem; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                        <h4 style="color: #667eea; margin-bottom: 0.5rem;">Era Modernisasi (2000-2010)</h4>
                        <p style="color: #666; line-height: 1.8;">
                            Memasuki era digital, SMK Taman Siswa melakukan modernisasi sistem pembelajaran dengan 
                            mengintegrasikan teknologi informasi. Laboratorium komputer modern dibangun, dan kurikulum 
                            disesuaikan dengan kebutuhan industri 4.0.
                        </p>
                    </div>
                </div>

                {{-- Item 4 - Akreditasi --}}
                <div style="position: relative; margin-bottom: 3rem;">
                    <div style="position: absolute; left: -48px; width: 40px; height: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700;">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <div style="background: white; padding: 2rem; border-radius: 1rem; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                        <h4 style="color: #667eea; margin-bottom: 0.5rem;">Pencapaian Akreditasi A (2015)</h4>
                        <p style="color: #666; line-height: 1.8;">
                            Prestasi membanggakan diraih dengan diperolehnya akreditasi A dari Badan Akreditasi Nasional 
                            Sekolah/Madrasah (BAN-S/M). Ini menjadi bukti komitmen sekolah dalam memberikan pendidikan 
                            berkualitas tinggi.
                        </p>
                    </div>
                </div>

                {{-- Item 5 - Saat Ini --}}
                <div style="position: relative;">
                    <div style="position: absolute; left: -48px; width: 40px; height: 40px; background: linear-gradient(135deg, #28a745 0%, #20c997 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700;">
                        <i class="fas fa-star"></i>
                    </div>
                    <div style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%); padding: 2rem; border-radius: 1rem; border: 2px solid #667eea;">
                        <h4 style="color: #667eea; margin-bottom: 0.5rem;">SMK Taman Siswa Hari Ini (2020-Sekarang)</h4>
                        <p style="color: #666; line-height: 1.8; margin-bottom: 1rem;">
                            Saat ini, SMK Taman Siswa Purwokerto menjadi salah satu SMK unggulan di Kabupaten Banyumas 
                            dengan 3 program keahlian: Layanan Perbankan, Usaha Layanan Wisata, dan Perhotelan. Sekolah 
                            terus berinovasi dalam metode pembelajaran dan memperluas kemitraan dengan industri.
                        </p>
                        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                            <div style="background: white; padding: 1rem; border-radius: 0.5rem; flex: 1; min-width: 150px;">
                                <h5 style="color: #667eea; font-size: 2rem; margin: 0;">69+</h5>
                                <p style="margin: 0; color: #666; font-size: 0.9rem;">Siswa Aktif</p>
                            </div>
                            <div style="background: white; padding: 1rem; border-radius: 0.5rem; flex: 1; min-width: 150px;">
                                <h5 style="color: #667eea; font-size: 2rem; margin: 0;">16+</h5>
                                <p style="margin: 0; color: #666; font-size: 0.9rem;">Guru & Staff</p>
                            </div>
                            <div style="background: white; padding: 1rem; border-radius: 0.5rem; flex: 1; min-width: 150px;">
                                <h5 style="color: #667eea; font-size: 2rem; margin: 0;">3</h5>
                                <p style="margin: 0; color: #666; font-size: 0.9rem;">Program Keahlian</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- Future Vision --}}
        <div style="margin-top: 4rem; text-align: center; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 3rem 2rem; border-radius: 1rem; color: white;">
            <i class="fas fa-rocket" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.9;"></i>
            <h3 style="margin-bottom: 1rem; color: white;">Visi ke Depan</h3>
            <p style="font-size: 1.1rem; line-height: 1.8; margin: 0; opacity: 0.95;">
                Dengan pengalaman lebih dari 70 tahun, SMK Taman Siswa bertekad terus berkembang menjadi 
                pusat keunggulan pendidikan kejuruan yang menghasilkan lulusan berkompetensi global dan 
                berkarakter Indonesia.
            </p>
        </div>

        {{-- CTA --}}
        <div style="margin-top: 3rem; text-align: center;">
            <p style="color: #666; margin-bottom: 1rem;">Pelajari lebih lanjut tentang sekolah kami</p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('profilsekolah.visi_misi') }}" class="btn-modern btn-primary">
                    <i class="fas fa-eye"></i> Visi & Misi
                </a>
                <a href="{{ route('profilsekolah.struktur_organisasi') }}" class="btn-modern btn-outline">
                    <i class="fas fa-sitemap"></i> Struktur Organisasi
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    @media (max-width: 768px) {
        .container > div > div[style*="padding-left: 60px"] {
            padding-left: 40px !important;
        }
        
        .container > div > div > div > div[style*="left: -48px"] {
            left: -28px !important;
            width: 32px !important;
            height: 32px !important;
            font-size: 0.875rem !important;
        }
    }
</style>
@endpush
