@extends('utama.layouts.app')
@section('title', 'Pramuka - SMK Taman Siswa Purwokerto')

@section('content')

    <section class="section-padding" style="margin-top: 80px;">
        <div class="container" style="max-width: 1000px;">

            {{-- Breadcrumb --}}
            <p style="margin-bottom: 2rem; color: var(--text-muted);">
                <a href="{{ route('landingpage') }}">Beranda</a> /
                <a href="{{ route('profilsekolah.ekstrakulikuler') }}">Ekstrakulikuler</a> /
                Pramuka
            </p>

            {{-- Header --}}
            <h1 class="section-title mobile:text-3xl" style="margin-bottom: 2rem;">Pramuka</h1>

            {{-- Main Image --}}
            <img src="https://images.unsplash.com/photo-1523049673857-eb18f1d7b578?w=1200&h=500&fit=crop"
                alt="Pramuka SMK Taman Siswa"
                style="width: 100%; height: 400px; object-fit: cover; border-radius: var(--border-radius); margin-bottom: 2rem;">

            {{-- Pembina Info --}}
            <div
                style="background: var(--bg-card); padding: 1.5rem; border-radius: var(--border-radius); border-left: 4px solid var(--accent-green); margin-bottom: 2rem;">
                <p style="color: var(--text-muted); font-size: 0.85rem; margin-bottom: 0.5rem;">Pembina</p>
                <p style="font-weight: 600; color: var(--text-main); margin: 0;">Bapak Wahyu S.Pd</p>
            </div>

            {{-- Description --}}
            <div
                style="font-size: 1.05rem; color: var(--text-main); line-height: 1.8; margin-bottom: 2rem; text-align: justify;">
                <p style="margin-bottom: 1rem;">
                    Gerakan Pramuka SMK Taman Siswa Purwokerto merupakan wadah pengembangan karakter dan kepemimpinan siswa
                    melalui kegiatan kepramukaan. Kami berkomitmen untuk membentuk generasi muda yang berjiwa petualang,
                    mandiri, dan memiliki kepedulian terhadap sesama.
                </p>
                <p>
                    Melalui berbagai kegiatan seperti perkemahan, penjelajahan, pelayanan masyarakat, dan pelatihan
                    kepemimpinan, anggota Pramuka dilatih untuk menjadi pribadi yang tangguh, bertanggung jawab, dan siap
                    menghadapi tantangan masa depan.
                </p>
            </div>

            {{-- Jadwal Latihan --}}
            <h3 style="color: var(--primary-blue-hover); margin-bottom: 1rem; font-size: 1.3rem;">Jadwal Latihan</h3>
            <div
                style="background: var(--bg-card); padding: 2rem; border-radius: var(--border-radius); border: 1px solid var(--border-color); margin-bottom: 2rem;">
                <div style="display: grid; gap: 1.5rem;">
                    <div style="display: flex; align-items: start; gap: 1rem;">
                        <div
                            style="width: 50px; height: 50px; background: var(--primary-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-calendar-day" style="color: white; font-size: 1.2rem;"></i>
                        </div>
                        <div>
                            <p style="color: var(--text-muted); font-size: 0.85rem; margin-bottom: 0.25rem;">Hari</p>
                            <p style="font-weight: 600; color: var(--text-main); font-size: 1.1rem; margin: 0;">Jumat</p>
                        </div>
                    </div>

                    <div style="display: flex; align-items: start; gap: 1rem;">
                        <div
                            style="width: 50px; height: 50px; background: var(--accent-green); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-clock" style="color: white; font-size: 1.2rem;"></i>
                        </div>
                        <div>
                            <p style="color: var(--text-muted); font-size: 0.85rem; margin-bottom: 0.25rem;">Waktu</p>
                            <p style="font-weight: 600; color: var(--text-main); font-size: 1.1rem; margin: 0;">14.00 -
                                16.30 WIB</p>
                        </div>
                    </div>

                    <div style="display: flex; align-items: start; gap: 1rem;">
                        <div
                            style="width: 50px; height: 50px; background: #f59e0b; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-map-marker-alt" style="color: white; font-size: 1.2rem;"></i>
                        </div>
                        <div>
                            <p style="color: var(--text-muted); font-size: 0.85rem; margin-bottom: 0.25rem;">Tempat</p>
                            <p style="font-weight: 600; color: var(--text-main); font-size: 1.1rem; margin: 0;">Lapangan
                                Utama</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Back Button --}}
            <div style="text-align: center; margin-top: 3rem;">
                <a href="{{ route('profilsekolah.ekstrakulikuler') }}" class="btn btn-secondary hidden-btn">
                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar Ekskul
                </a>
            </div>
        </div>
    </section>

@endsection

@push('styles')
    <style>
        @media (max-width: 768px) {
            div[style*="grid-template-columns"] {
                grid-template-columns: 1fr !important;
            }

            img[style*="height: 400px"] {
                height: 250px !important;
            }
        }
    </style>
@endpush
