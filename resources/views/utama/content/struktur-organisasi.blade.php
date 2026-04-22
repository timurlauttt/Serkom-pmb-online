@extends('utama.layouts.app')
@section('title', 'Struktur Organisasi - SMK Taman Siswa Purwokerto')

@section('content')

{{-- Page Header --}}
<x-page-header 
    title="STRUKTUR ORGANISASI"
    subtitle="Kepemimpinan dan tim pengajar yang berdedikasi"
    :breadcrumbs="[
        ['title' => 'Profil', 'url' => '#'],
        ['title' => 'Struktur Organisasi', 'url' => route('profilsekolah.struktur_organisasi')]
    ]"
/>

<section class="section">
    <div class="container">
        {{-- Organizational Chart --}}
        <div style="max-width: 1000px; margin: 0 auto;">
            
            {{-- Level 1: Kepala Sekolah --}}
            <div style="text-align: center; margin-bottom: 3rem;">
                <div style="display: inline-block; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 2rem; border-radius: 1rem; box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3); min-width: 300px;">
                    <i class="fas fa-user-tie" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                    <h4 style="margin: 0 0 0.5rem 0; color: white;">Kepala Sekolah</h4>
                    <p style="margin: 0; opacity: 0.9; font-size: 1.1rem;">Drs. [Nama Kepala Sekolah]</p>
                    <p style="margin: 0.5rem 0 0 0; opacity: 0.8; font-size: 0.9rem;">NIP: [NIP]</p>
                </div>
            </div>

            {{-- Connector Line --}}
            <div style="height: 40px; display: flex; justify-content: center;">
                <div style="width: 2px; height: 100%; background: #667eea;"></div>
            </div>

            {{-- Level 2: Wakil & Komite --}}
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-bottom: 2rem;">
                
                {{-- Wakil Kepala Sekolah --}}
                <div style="background: white; padding: 1.5rem; border-radius: 1rem; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border-top: 4px solid #667eea;">
                    <div style="text-align: center;">
                        <i class="fas fa-user-graduate" style="font-size: 2.5rem; color: #667eea; margin-bottom: 1rem;"></i>
                        <h5 style="margin: 0 0 0.5rem 0; color: #333;">Wakil Kepala Sekolah</h5>
                        <p style="margin: 0; color: #666; font-size: 0.95rem;">[Nama Wakasek]</p>
                        <p style="margin: 0.25rem 0 0 0; color: #999; font-size: 0.85rem;">NIP: [NIP]</p>
                    </div>
                </div>

                {{-- Komite Sekolah --}}
                <div style="background: white; padding: 1.5rem; border-radius: 1rem; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border-top: 4px solid #f093fb;">
                    <div style="text-align: center;">
                        <i class="fas fa-users" style="font-size: 2.5rem; color: #f093fb; margin-bottom: 1rem;"></i>
                        <h5 style="margin: 0 0 0.5rem 0; color: #333;">Komite Sekolah</h5>
                        <p style="margin: 0; color: #666; font-size: 0.95rem;">[Nama Ketua Komite]</p>
                        <p style="margin: 0.25rem 0 0 0; color: #999; font-size: 0.85rem;">Ketua</p>
                    </div>
                </div>

            </div>

            {{-- Connector Line --}}
            <div style="height: 40px; display: flex; justify-content: center;">
                <div style="width: 2px; height: 100%; background: #667eea;"></div>
            </div>

            {{-- Level 3: Urusan --}}
            <h4 style="text-align: center; margin: 2rem 0; color: #333;">Tim Manajemen</h4>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
                
                {{-- Urusan Kurikulum --}}
                <div style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%); padding: 1.5rem; border-radius: 0.75rem; border-left: 4px solid #667eea;">
                    <i class="fas fa-book" style="font-size: 2rem; color: #667eea; margin-bottom: 0.75rem;"></i>
                    <h6 style="margin: 0 0 0.5rem 0; color: #333;">Urusan Kurikulum</h6>
                    <p style="margin: 0; color: #666; font-size: 0.9rem;">[Nama]</p>
                </div>

                {{-- Urusan Kesiswaan --}}
                <div style="background: linear-gradient(135deg, rgba(240, 147, 251, 0.1) 0%, rgba(245, 87, 108, 0.1) 100%); padding: 1.5rem; border-radius: 0.75rem; border-left: 4px solid #f093fb;">
                    <i class="fas fa-user-friends" style="font-size: 2rem; color: #f093fb; margin-bottom: 0.75rem;"></i>
                    <h6 style="margin: 0 0 0.5rem 0; color: #333;">Urusan Kesiswaan</h6>
                    <p style="margin: 0; color: #666; font-size: 0.9rem;">[Nama]</p>
                </div>

                {{-- Urusan Sarpras --}}
                <div style="background: linear-gradient(135deg, rgba(79, 172, 254, 0.1) 0%, rgba(0, 242, 254, 0.1) 100%); padding: 1.5rem; border-radius: 0.75rem; border-left: 4px solid #4facfe;">
                    <i class="fas fa-tools" style="font-size: 2rem; color: #4facfe; margin-bottom: 0.75rem;"></i>
                    <h6 style="margin: 0 0 0.5rem 0; color: #333;">Urusan Sarana Prasarana</h6>
                    <p style="margin: 0; color: #666; font-size: 0.9rem;">[Nama]</p>
                </div>

                {{-- Urusan Humas --}}
                <div style="background: linear-gradient(135deg, rgba(250, 112, 154, 0.1) 0%, rgba(254, 225, 64, 0.1) 100%); padding: 1.5rem; border-radius: 0.75rem; border-left: 4px solid #fa709a;">
                    <i class="fas fa-handshake" style="font-size: 2rem; color: #fa709a; margin-bottom: 0.75rem;"></i>
                    <h6 style="margin: 0 0 0.5rem 0; color: #333;">Urusan Humas</h6>
                    <p style="margin: 0; color: #666; font-size: 0.9rem;">[Nama]</p>
                </div>

            </div>

            {{-- Level 4: Guru & Staff --}}
            <div style="background: #f8f9fa; padding: 2rem; border-radius: 1rem; margin-bottom: 2rem;">
                <h4 style="text-align: center; margin: 0 0 2rem 0; color: #333;">Tim Pengajar & Tenaga Kependidikan</h4>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem;">
                    
                    {{-- Guru Produktif --}}
                    <div style="text-align: center; padding: 1rem;">
                        <div style="width: 60px; height: 60px; background: #667eea; border-radius: 50%; margin: 0 auto 0.75rem; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-chalkboard-teacher" style="font-size: 1.5rem; color: white;"></i>
                        </div>
                        <h6 style="margin: 0 0 0.25rem 0; color: #333;">Guru Produktif</h6>
                        <p style="margin: 0; color: #666; font-size: 0.85rem;">8 Orang</p>
                    </div>

                    {{-- Guru Normatif --}}
                    <div style="text-align: center; padding: 1rem;">
                        <div style="width: 60px; height: 60px; background: #f093fb; border-radius: 50%; margin: 0 auto 0.75rem; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-book-reader" style="font-size: 1.5rem; color: white;"></i>
                        </div>
                        <h6 style="margin: 0 0 0.25rem 0; color: #333;">Guru Normatif</h6>
                        <p style="margin: 0; color: #666; font-size: 0.85rem;">5 Orang</p>
                    </div>

                    {{-- Staff Tata Usaha --}}
                    <div style="text-align: center; padding: 1rem;">
                        <div style="width: 60px; height: 60px; background: #4facfe; border-radius: 50%; margin: 0 auto 0.75rem; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-file-alt" style="font-size: 1.5rem; color: white;"></i>
                        </div>
                        <h6 style="margin: 0 0 0.25rem 0; color: #333;">Staff Tata Usaha</h6>
                        <p style="margin: 0; color: #666; font-size: 0.85rem;">3 Orang</p>
                    </div>

                </div>
            </div>

            {{-- Info Note --}}
            <div style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%); padding: 1.5rem; border-radius: 0.75rem; border-left: 4px solid #667eea; text-align: center;">
                <i class="fas fa-info-circle" style="color: #667eea; font-size: 1.5rem; margin-bottom: 0.5rem;"></i>
                <p style="margin: 0; color: #666;">
                    Struktur organisasi dapat berubah sesuai dengan kebutuhan dan perkembangan sekolah. 
                    Untuk informasi lebih detail hubungi bagian Tata Usaha.
                </p>
            </div>

        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    @media (max-width: 768px) {
        .container > div > div[style*="grid-template-columns"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endpush