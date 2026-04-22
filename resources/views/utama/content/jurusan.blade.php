@extends('utama.layouts.app')
@section('title', 'Program Keahlian - SMK Taman Siswa Purwokerto')

@section('content')

    <section class="section-padding" style="margin-top: 80px;">
        <div class="container">
            <h1 class="section-title mobile:text-xl">Program Keahlian</h1>
            <p class="mobile:text-sm" style="margin-bottom: 3rem; color: var(--text-muted); max-width: 700px;">SMK Taman Siswa
                Purwokerto
                memiliki berbagai program keahlian yang dirancang untuk memenuhi kebutuhan industri saat ini dan masa
                depan.</p>

            <div class="programs-grid">
                @forelse($jurusans as $jurusan)
                    <!-- Card Jurusan -->
                    <div class="card">
                        <div class="card-icon"><i class="fas fa-graduation-cap"></i></div>
                        <h3>{{ $jurusan->name }}</h3>
                        <p style="color: var(--text-muted); margin-bottom: 1.5rem;">
                            {{ Str::limit(strip_tags($jurusan->description ?? ''), 100) }}
                        </p>
                        <a href="{{ route('jurusan.show', $jurusan->slug) }}"
                            style="color: var(--primary-blue-hover); font-weight: 600;">Lihat
                            Detail <i class="fas fa-arrow-right"></i></a>
                    </div>
                @empty
                    <!-- Dummy Card jika kosong -->
                    <div class="card">
                        <div class="card-icon"><i class="fas fa-briefcase"></i></div>
                        <h3>Layanan Perbankan</h3>
                        <p style="color: var(--text-muted); margin-bottom: 1.5rem;">Program keahlian perbankan dengan focus
                            pada pelayanan nasabah dan operasional perbankan</p>
                        <a href="#" style="color: var(--primary-blue-hover); font-weight: 600;">Lihat Detail <i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                    <div class="card">
                        <div class="card-icon"><i class="fas fa-hotel"></i></div>
                        <h3>Perhotelan</h3>
                        <p style="color: var(--text-muted); margin-bottom: 1.5rem;">Mempersiapkan tenaga professional di
                            bidang perhotelan dengan standar internasional</p>
                        <a href="#" style="color: var(--primary-blue-hover); font-weight: 600;">Lihat Detail <i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                    <div class="card">
                        <div class="card-icon"><i class="fas fa-plane"></i></div>
                        <h3>Usaha Layanan Wisata</h3>
                        <p style="color: var(--text-muted); margin-bottom: 1.5rem;">Keahlian dalam industri pariwisata dan
                            travel agent untuk karir global</p>
                        <a href="#" style="color: var(--primary-blue-hover); font-weight: 600;">Lihat Detail <i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

@endsection
