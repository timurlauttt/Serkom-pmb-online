@extends('utama.layouts.app')

@section('title', 'SMK TAMAN SISWA PURWOKERTO - Modern & Berkarakter')

@section('content')

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content" data-aos="fade-up">
                <h1 class="mobile:text-3xl" data-aos="fade-up" data-aos-delay="100">Membangun Generasi <br><span style="color: var(--primary-blue-hover);">Unggul &
                        Kompeten</span></h1>
                <p class="mobile:text-base" data-aos="fade-up" data-aos-delay="200">Selamat datang di SMK Taman Siswa Purwokerto. Sekolah kejuruan berbasis teknologi
                    dan industri dengan fasilitas modern untuk masa depan yang cerah.</p>
                <div style="display: flex; gap: 1rem;" data-aos="fade-up" data-aos-delay="300">
                    <a href="#jurusan" class="btn btn-primary">Lihat Jurusan</a>
                    <a href="{{ route('profilsekolah.profile') }}" class="btn btn-secondary">Tentang Kami</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Jurusan Section -->
    <section id="jurusan" class="section-padding">
        <div class="container">
            <h2 class="section-title mobile:text-xl" data-aos="fade-up">Program Keahlian</h2>
            <div class="news-grid">
                @forelse($jurusans as $jurusan)
                    <!-- Card with Image -->
                    <article class="news-card" data-aos="fade-up" data-aos-duration="600">
                        @if ($jurusan->image_url)
                            <img src="{{ $jurusan->image_url }}" alt="{{ $jurusan->name }}" class="news-img">
                        @else
                            <div class="news-img"
                                style="background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-blue-hover) 100%); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-graduation-cap" style="font-size: 3rem; color: white;"></i>
                            </div>
                        @endif
                        <div class="news-content">
                            <h3 class="news-title mobile:text-xl">{{ $jurusan->name }}</h3>
                            <p class="mobile:text-sm"
                                style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">
                                {{ Str::limit(strip_tags($jurusan->description ?? ''), 100) }}
                            </p>
                            <a href="{{ route('jurusan.show', $jurusan->slug) }}"
                                style="color: var(--primary-blue-hover); font-weight: 600;">Selengkapnya <i
                                    class="fas fa-arrow-right"></i></a>
                        </div>
                    </article>
                @empty
                    <!-- Dummy Cards dengan foto -->
                    <article class="news-card" data-aos="fade-up" data-aos-duration="600">
                        <img src="https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                            alt="Layanan Perbankan" class="news-img">
                        <div class="news-content">
                            <h3 class="news-title mobile:text-xl">Layanan Perbankan</h3>
                            <p class="mobile:text-sm"
                                style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">
                                Cetak ahli perbankan profesional dengan kurikulum standar industri terkini.
                            </p>
                            <a href="{{ route('jurusan.index') }}"
                                style="color: var(--primary-blue-hover); font-weight: 600;">Selengkapnya <i
                                    class="fas fa-arrow-right"></i></a>
                        </div>
                    </article>
                    <article class="news-card" data-aos="fade-up" data-aos-duration="600" data-aos-delay="100">
                        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                            alt="Perhotelan" class="news-img">
                        <div class="news-content">
                            <h3 class="news-title mobile:text-xl">Perhotelan</h3>
                            <p class="mobile:text-sm"
                                style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">
                                Ahli hospitality dengan standar internasional yang siap kerja di industri perhotelan global.
                            </p>
                            <a href="{{ route('jurusan.index') }}"
                                style="color: var(--primary-blue-hover); font-weight: 600;">Selengkapnya <i
                                    class="fas fa-arrow-right"></i></a>
                        </div>
                    </article>
                    <article class="news-card" data-aos="fade-up" data-aos-duration="600" data-aos-delay="200">
                        <img src="https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                            alt="Usaha Layanan Wisata" class="news-img">
                        <div class="news-content">
                            <h3 class="news-title mobile:text-xl">Usaha Layanan Wisata</h3>
                            <p class="mobile:text-sm"
                                style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">
                                Spesialis pariwisata dan travel agent untuk karir yang menjanjikan di industri wisata.
                            </p>
                            <a href="{{ route('jurusan.index') }}"
                                style="color: var(--primary-blue-hover); font-weight: 600;">Selengkapnya <i
                                    class="fas fa-arrow-right"></i></a>
                        </div>
                    </article>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Mitra Section -->
    <section class="partners">
        <div class="container">
            <p style="text-align: center; margin-bottom: 2rem; color: var(--accent-green-hover); font-weight: 600;" data-aos="fade-up">MITRA
                INDUSTRI KAMI</p>
            <div style="display: flex; flex-wrap: wrap; justify-content: center; align-items: center; gap: 3rem;" data-aos="fade-up">
                @forelse($mitraList as $mitra)
                    <div style="opacity: 0.8; transition: opacity 0.3s;" data-aos="zoom-in" data-aos-duration="500">
                        @if (isset($mitra->logo) || isset($mitra['logo']))
                            <img src="{{ $mitra->logo ?? ($mitra['logo'] ?? asset('images/default-logo.png')) }}"
                                alt="{{ $mitra->nama ?? ($mitra['name'] ?? 'Mitra') }}"
                                style="height: 60px; width: auto; object-fit: contain;"
                                onmouseover="this.parentElement.style.opacity='1'"
                                onmouseout="this.parentElement.style.opacity='0.8'">
                        @else
                            <div class="partner-logo">{{ strtoupper($mitra->nama ?? ($mitra['name'] ?? 'MITRA')) }}</div>
                        @endif
                    </div>
                @empty
                    <!-- Dummy logos dengan text -->
                    <div class="partner-logo" style="opacity: 0.6;">PT. ASTRA HONDA</div>
                    <div class="partner-logo" style="opacity: 0.6;">TELKOM INDONESIA</div>
                    <div class="partner-logo" style="opacity: 0.6;">GAMELAB.ID</div>
                    <div class="partner-logo" style="opacity: 0.6;">MITSUBISHI MOTORS</div>
                    <div class="partner-logo" style="opacity: 0.6;">BANK BRI</div>
                @endforelse
            </div>
        </div>
    </section>



    <!-- Berita Terbaru Section -->
    <section class="section-padding">
        <div class="container">
            <div style="display: flex; justify-content: space-between; align-items: end; margin-bottom: 2rem;" data-aos="fade-up">
                <h2 class="section-title mobile:text-xl" style="margin-bottom: 0;">Berita Terbaru</h2>
                <a href="{{ route('berita.index') }}" style="color: var(--text-muted);">Lihat Semua <i
                        class="fas fa-arrow-right"></i></a>
            </div>
            <div class="news-grid">
                @forelse($beritas->take(3) as $berita)
                    <article class="news-card" data-aos="fade-up" data-aos-duration="600">
                        <img src="{{ $berita->image_url ?? 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' }}"
                            alt="News" class="news-img">
                        <div class="news-content">
                            <span
                                class="news-meta mobile:text-xs">{{ optional($berita->created_at)->locale('id')->translatedFormat('d F Y') ?? 'BERITA TERBARU' }}</span>
                            <h3 class="news-title mobile:text-lg">{{ $berita->title }}</h3>
                            <p class="mobile:text-sm"
                                style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">
                                {{ Str::limit(strip_tags($berita->content ?? ''), 100) }}
                            </p>
                            <a href="{{ route('berita.show', $berita->slug) }}" class="btn-link"
                                style="font-size: 0.9rem; color: var(--accent-green-hover);">Baca Selengkapnya</a>
                        </div>
                    </article>
                @empty
                    <article class="news-card" data-aos="fade-up" data-aos-duration="600">
                        <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                            alt="News" class="news-img">
                        <div class="news-content">
                            <span class="news-meta mobile:text-xs">BERITA TERBARU</span>
                            <h3 class="news-title mobile:text-xl">Informasi Terbaru Akan Segera Hadir</h3>
                            <a href="{{ route('berita.index') }}" class="btn-link"
                                style="font-size: 0.9rem; color: var(--accent-green-hover);">Baca Selengkapnya</a>
                        </div>
                    </article>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Event Terbaru Section -->
    <section class="section-padding" style="background-color: var(--bg-secondary);">
        <div class="container">
            <div style="display: flex; justify-content: space-between; align-items: end; margin-bottom: 2rem;" data-aos="fade-up">
                <h2 class="section-title mobile:text-xl" style="margin-bottom: 0;">Event Terbaru</h2>
                <a href="{{ route('event.index') }}" style="color: var(--text-muted);">Lihat Semua <i
                        class="fas fa-arrow-right"></i></a>
            </div>
            <div class="news-grid">
                @forelse($eventsList->take(3) as $event)
                    <article class="news-card" data-aos="fade-up" data-aos-duration="600">
                        <img src="{{ $event->image_url ?? 'https://images.unsplash.com/photo-1544531586-fde5298cdd40?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' }}"
                            alt="Event" class="news-img">
                        <div class="news-content">
                            <span class="news-meta mobile:text-xs"
                                style="color: var(--highlight-yellow-hover);">{{ optional($event->start_date)->locale('id')->translatedFormat('d F Y') ?? 'EVENT TERBARU' }}</span>
                            <h3 class="news-title mobile:text-lg">{{ $event->title }}</h3>
                            <p class="mobile:text-sm"
                                style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">
                                {{ Str::limit(strip_tags($event->content ?? ($event->description ?? '')), 100) }}
                            </p>
                            <a href="{{ route('event.show', $event->slug) }}" class="btn-link"
                                style="font-size: 0.9rem; color: var(--highlight-yellow-hover);">Lihat Detail</a>
                        </div>
                    </article>
                @empty
                    <article class="news-card" data-aos="fade-up" data-aos-duration="600">
                        <img src="https://images.unsplash.com/photo-1544531586-fde5298cdd40?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                            alt="Event" class="news-img">
                        <div class="news-content">
                            <span class="news-meta mobile:text-xs" style="color: var(--highlight-yellow-hover);">EVENT
                                TERBARU</span>
                            <h3 class="news-title mobile:text-xl">Event Menarik Akan Segera Dilaksanakan</h3>
                            <a href="{{ route('event.index') }}" class="btn-link"
                                style="font-size: 0.9rem; color: var(--highlight-yellow-hover);">Lihat Detail</a>
                        </div>
                    </article>
                @endforelse
            </div>
        </div>
    </section>



    <!-- Pengumuman Terbaru Section -->
    <section class="section-padding">
        <div class="container">
            <div style="display: flex; justify-content: space-between; align-items: end; margin-bottom: 2rem;" data-aos="fade-up">
                <h2 class="section-title mobile:text-xl" style="margin-bottom: 0;">Pengumuman Terbaru</h2>
                <a href="{{ route('pengumuman.index') }}" style="color: var(--text-muted);">Lihat Semua <i
                        class="fas fa-arrow-right"></i></a>
            </div>
            <div class="news-grid">
                @forelse($announcements->take(3) as $pengumuman)
                    <article class="news-card" data-aos="fade-up" data-aos-duration="600">
                        @if ($pengumuman->image_url)
                            <img src="{{ $pengumuman->image_url }}" alt="Pengumuman" class="news-img">
                        @else
                            <div class="news-img"
                                style="background: var(--bg-secondary); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-bullhorn" style="font-size: 3rem; color: var(--primary-blue-hover);"></i>
                            </div>
                        @endif
                        <div class="news-content">
                            <span class="news-meta mobile:text-xs"
                                style="color: var(--primary-blue-hover);">{{ optional($pengumuman->posted_at)->locale('id')->translatedFormat('d F Y') ?? 'PENGUMUMAN' }}</span>
                            <h3 class="news-title mobile:text-lg">{{ $pengumuman->title }}</h3>
                            <p class="mobile:text-sm"
                                style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">
                                {{ Str::limit(strip_tags($pengumuman->content ?? ''), 100) }}
                            </p>
                            <a href="{{ route('pengumuman.show', $pengumuman->slug) }}" class="btn-link"
                                style="font-size: 0.9rem; color: var(--primary-blue-hover);">Lihat Detail</a>
                        </div>
                    </article>
                @empty
                    <article class="news-card" data-aos="fade-up" data-aos-duration="600">
                        <div class="news-img"
                            style="background: var(--bg-secondary); display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-bullhorn" style="font-size: 3rem; color: var(--primary-blue-hover);"></i>
                        </div>
                        <div class="news-content">
                            <span class="news-meta mobile:text-xs" style="color: var(--primary-blue-hover);">PENGUMUMAN
                                PENTING</span>
                            <h3 class="news-title mobile:text-xl">Pengumuman Penting Akan Diumumkan</h3>
                            <a href="{{ route('pengumuman.index') }}" class="btn-link"
                                style="font-size: 0.9rem; color: var(--primary-blue-hover);">Lihat Detail</a>
                        </div>
                    </article>
                @endforelse
            </div>
        </div>
    </section>


    <!-- Galeri Section -->
    <section class="section-padding" style="background-color: var(--bg-secondary);">
        <div class="container">
            <div style="display: flex; justify-content: space-between; align-items: end; margin-bottom: 2rem;" data-aos="fade-up">
                <h2 class="section-title mobile:text-xl" style="margin-bottom: 0;">Galeri Sekolah</h2>
                <a href="{{ route('galeri.index') }}" style="color: var(--text-muted);">Lihat Semua <i
                        class="fas fa-arrow-right"></i></a>
            </div>
            <div class="news-grid" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));">
                @forelse($galleryList->take(4) as $gallery)
                    <img src="{{ asset($gallery->path) ?? 'https://images.unsplash.com/photo-1577896333050-7f287902728f?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=60' }}"
                        style="border-radius: var(--border-radius); height: 200px; width: 100%; object-fit: cover;"
                        alt="{{ $gallery->title ?? 'Gallery' }}"
                        data-aos="zoom-in" data-aos-duration="500">>
                @empty
                    <img src="https://images.unsplash.com/photo-1577896333050-7f287902728f?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=60"
                        style="border-radius: var(--border-radius); height: 200px; width: 100%; object-fit: cover;"
                        alt="Gallery 1"
                        data-aos="zoom-in" data-aos-duration="500">
                    <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=60"
                        style="border-radius: var(--border-radius); height: 200px; width: 100%; object-fit: cover;"
                        alt="Gallery 2"
                        data-aos="zoom-in" data-aos-duration="500" data-aos-delay="100">
                    <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=60"
                        style="border-radius: var(--border-radius); height: 200px; width: 100%; object-fit: cover;"
                        alt="Gallery 3"
                        data-aos="zoom-in" data-aos-duration="500" data-aos-delay="200">
                @endforelse
            </div>
        </div>
    </section>

@endsection
