@extends('utama.layouts.app')
@section('title', 'Visi & Misi - SMK Taman Siswa Purwokerto')

@section('content')


<section class="section">
    <div class="container" style="max-width: 900px;">
        {{-- Visi --}}
        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 3rem 2rem; border-radius: 1rem; margin-bottom: 3rem; text-align: center;">
            <i class="fas fa-eye" style="font-size: 3rem; margin-bottom:  1rem; opacity: 0.9;"></i>
            <h2 style="margin-bottom: 1.5rem; color: white;">VISI</h2>
            <p style="font-size: 1.25rem; line-height: 1.8; margin: 0; font-weight: 500;">
                Mewujudkan SMK Taman Siswa Purwokerto sebagai lembaga pendidikan kejuruan yang unggul, 
                menghasilkan lulusan yang berkompetensi, berkarakter, dan berdaya saing global.
            </p>
        </div>

        {{-- Misi --}}
        <div style="background: white; padding: 2rem; border-radius: 1rem; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <div style="text-align: center; margin-bottom: 2rem;">
                <i class="fas fa-bullseye" style="font-size: 3rem; color: #667eea; margin-bottom: 1rem;"></i>
                <h2 style="color: #333;">MISI</h2>
            </div>
            
            <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                <div style="display: flex; gap: 1rem; align-items: start; padding: 1.5rem; background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%); border-radius: 0.75rem; border-left: 4px solid #667eea;">
                    <div style="flex-shrink: 0; width: 40px; height: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700;">
                        1
                    </div>
                    <p style="margin: 0.5rem 0 0 0; line-height: 1.7; color: #333;">
                        Menyelenggarakan pendidikan kejuruan yang berkualitas dengan sistem pembelajaran yang inovatif dan berbasis teknologi.
                    </p>
                </div>
                
                <div style="display: flex; gap: 1rem; align-items: start; padding: 1.5rem; background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%); border-radius: 0.75rem; border-left: 4px solid #667eea;">
                    <div style="flex-shrink: 0; width: 40px; height: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700;">
                        2
                    </div>
                    <p style="margin: 0.5rem 0 0 0; line-height: 1.7; color: #333;">
                        Membentuk karakter peserta didik yang jujur, disiplin, bertanggung jawab, dan memiliki jiwa kewirausahaan.
                    </p>
                </div>
                
                <div style="display: flex; gap: 1rem; align-items: start; padding: 1.5rem; background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%); border-radius: 0.75rem; border-left: 4px solid #667eea;">
                    <div style="flex-shrink: 0; width: 40px; height: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700;">
                        3
                    </div>
                    <p style="margin: 0.5rem 0 0 0; line-height: 1.7; color: #333;">
                        Meningkatkan kompetensi tenaga pendidik dan kependidikan melalui pelatihan dan pengembangan profesional berkelanjutan.
                    </p>
                </div>
                
                <div style="display: flex; gap: 1rem; align-items: start; padding: 1.5rem; background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%); border-radius: 0.75rem; border-left: 4px solid #667eea;">
                    <div style="flex-shrink: 0; width: 40px; height: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700;">
                        4
                    </div>
                    <p style="margin: 0.5rem 0 0 0; line-height: 1.7; color: #333;">
                        Menjalin kerjasama dengan dunia usaha dan industri untuk meningkatkan kualitas lulusan dan penyerapan tenaga kerja.
                    </p>
                </div>
                
                <div style="display: flex; gap: 1rem; align-items: start; padding: 1.5rem; background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%); border-radius: 0.75rem; border-left: 4px solid #667eea;">
                    <div style="flex-shrink: 0; width: 40px; height: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700;">
                        5
                    </div>
                    <p style="margin: 0.5rem 0 0 0; line-height: 1.7; color: #333;">
                        Mengembangkan sarana dan prasarana pendukung pembelajaran yang memadai dan relevan dengan kebutuhan industri.
                    </p>
                </div>
            </div>
        </div>

        {{-- CTA Section --}}
        <div style="margin-top: 3rem; text-align: center;">
            <p style="color: #666; margin-bottom: 1.5rem;">Pelajari lebih lanjut tentang profil sekolah kami</p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('profilsekolah.sejarah') }}" class="btn-modern btn-outline">
                    <i class="fas fa-book"></i> Sejarah
                </a>
                <a href="{{ route('profilsekolah.struktur_organisasi') }}" class="btn-modern btn-outline">
                    <i class="fas fa-sitemap"></i> Struktur Organisasi
                </a>
                <a href="{{ route('profilsekolah.fasilitas') }}" class="btn-modern btn-outline">
                    <i class="fas fa-building"></i> Fasilitas
                </a>
            </div>
        </div>
    </div>
</section>

@endsection