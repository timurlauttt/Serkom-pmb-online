@extends('utama.layouts.app')
@section('title', $jurusan->name . ' - SMK Taman Siswa Purwokerto')
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($jurusan->description), 160))

@section('content')

    <section class="section-padding" style="margin-top: 80px;">
        <div class="container">
            <!-- Breadcrumb -->
            <p style="margin-bottom: 2rem; color: var(--text-muted);">
                <a href="{{ route('landingpage') }}">Beranda</a> /
                <a href="{{ route('jurusan.index') }}">Jurusan</a> /
                {{ $jurusan->name }}
            </p>

            <div>
                <h1 class="section-title mobile:text-xl" style="margin-bottom: 2rem;">{{ $jurusan->name }}</h1>

                {{-- Image Slider (3 photos) --}}
                <div class="image-slider-container" style="margin-bottom: 2rem;">
                    <div class="slider">
                        @foreach ($jurusan->image_urls as $index => $imageUrl)
                            <div class="slide {{ $index === 0 ? 'active' : '' }}">
                                <img src="{{ $imageUrl }}" alt="{{ $jurusan->name }} - Foto {{ $index + 1 }}"
                                    style="width: 100%; height: 450px; object-fit: cover; border-radius: var(--border-radius);">
                            </div>
                        @endforeach
                    </div>
                    <div class="slider-dots" style="text-align: center; margin-top: 1rem;">
                        @foreach ($jurusan->image_urls as $index => $imageUrl)
                            <span class="dot {{ $index === 0 ? 'active' : '' }}"
                                onclick="currentSlide({{ $index }})"></span>
                        @endforeach
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div style="font-size: 1.1rem; color: var(--text-main); line-height: 1.8;">
                    {!! $jurusan->description !!}

                    {{-- Apa Yang Dipelajari --}}
                    @if (is_array($jurusan->subjects) && count($jurusan->subjects) > 0)
                        <h3 style="color: var(--primary-blue-hover); margin: 2rem 0 1rem 0;">Apa Yang Dipelajari?</h3>
                        <ul style="list-style: disc; padding-left: 1.5rem; margin-bottom: 2rem; color: var(--text-muted);">
                            @foreach ($jurusan->subjects as $subject)
                                <li>{{ $subject }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {{-- Prospek Karir --}}
                    @if (is_array($jurusan->prospects) && count($jurusan->prospects) > 0)
                        <h3 style="color: var(--primary-blue-hover); margin-bottom: 1rem;">Prospek Karir</h3>
                        <p style="margin-bottom: 1.5rem; color: var(--text-muted);">
                            Lulusan {{ $jurusan->name }} memiliki peluang kerja yang sangat luas di era digital ini, antara
                            lain sebagai:
                        </p>
                        <div style="display: flex; gap: 1rem; flex-wrap: wrap; margin-bottom: 2rem;">
                            @foreach ($jurusan->prospects as $prospect)
                                <span class="btn btn-secondary" style="font-size: 0.9rem;">{{ $prospect }}</span>
                            @endforeach
                        </div>
                    @endif

                    {{-- Sertifikasi --}}
                    @if (is_array($jurusan->certifications) && count($jurusan->certifications) > 0)
                        <h3 style="color: var(--primary-blue-hover); margin-bottom: 1rem;">Sertifikasi yang Bisa Diperoleh
                        </h3>
                        <div style="display: flex; gap: 1rem; flex-wrap: wrap; margin-bottom: 2rem;">
                            @foreach ($jurusan->certifications as $cert)
                                <span class="btn btn-primary" style="font-size: 0.9rem;"><i class="fas fa-certificate"></i>
                                    {{ $cert }}</span>
                            @endforeach
                        </div>
                    @endif

                    {{-- Mitra Jurusan --}}
                    @if (is_array($jurusan->partners) && count($jurusan->partners) > 0)
                        <h3 style="color: var(--primary-blue-hover); margin-bottom: 1rem;">Mitra Jurusan</h3>
                        <div
                            style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
                            @foreach ($jurusan->partners as $partner)
                                <div
                                    style="text-align: center; padding: 1.25rem; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--border-radius);">
                                    @if (isset($partner['logo']))
                                        <img src="{{ asset($partner['logo']) }}" alt="{{ $partner['name'] ?? 'Mitra' }}"
                                            style="max-width: 100px; height: 60px; object-fit: contain; margin: 0 auto; display: block;">
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- Berita Jurusan --}}
                    @if ($beritas->count() > 0)
                        <h3 style="color: var(--primary-blue-hover); margin-bottom: 1rem;">Berita Jurusan</h3>
                        <div
                            style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
                            @foreach ($beritas as $berita)
                                <div class="card-hover"
                                    style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--border-radius); overflow: hidden;">
                                    <a href="{{ route('berita.show', $berita->slug) }}"
                                        style="text-decoration: none; color: inherit;">
                                        @if ($berita->image_url)
                                            <img src="{{ $berita->image_url }}" alt="{{ $berita->title }}"
                                                style="width: 100%; height: 200px; object-fit: cover;">
                                        @endif
                                        <div style="padding: 1.5rem;">
                                            <h4 style="color: var(--text-main); margin-bottom: 0.75rem;">
                                                {{ Str::limit($berita->title, 60) }}
                                            </h4>
                                            <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">
                                                {{ Str::limit(strip_tags($berita->content), 100) }}
                                            </p>
                                            <div
                                                style="display: flex; align-items: center; justify-content: space-between; font-size: 0.85rem; color: var(--text-muted);">
                                                <span><i class="far fa-calendar"></i>
                                                    {{ $berita->created_at->format('d M Y') }}</span>
                                                <span style="color: var(--primary-blue);">Baca →</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- Event Jurusan --}}
                    @if ($events->count() > 0)
                        <h3 style="color: var(--primary-blue-hover); margin-bottom: 1rem;">Event Jurusan</h3>
                        <div
                            style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
                            @foreach ($events as $event)
                                <div class="card-hover"
                                    style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--border-radius); overflow: hidden;">
                                    <a href="{{ route('event.show', $event->slug) }}"
                                        style="text-decoration: none; color: inherit;">
                                        @if ($event->image_url)
                                            <img src="{{ $event->image_url }}" alt="{{ $event->title }}"
                                                style="width: 100%; height: 200px; object-fit: cover;">
                                        @endif
                                        <div style="padding: 1.5rem;">
                                            <h4 style="color: var(--text-main); margin-bottom: 0.75rem;">
                                                {{ Str::limit($event->title, 60) }}
                                            </h4>
                                            <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">
                                                {{ Str::limit(strip_tags($event->description), 100) }}
                                            </p>
                                            <div
                                                style="display: flex; align-items: center; justify-content: space-between; font-size: 0.85rem; color: var(--text-muted);">
                                                <span><i class="far fa-calendar"></i>
                                                    {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}</span>
                                                <span style="color: var(--primary-blue);">Lihat →</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- Galeri Jurusan --}}
                    @if ($galleries->count() > 0)
                        <h3 style="color: var(--primary-blue-hover); margin-bottom: 1rem;">Galeri Jurusan</h3>
                        <div
                            style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
                            @foreach ($galleries as $gallery)
                                <div style="position: relative; overflow: hidden; border-radius: var(--border-radius); cursor: pointer; aspect-ratio: 1/1; border: 1px solid var(--border-color);"
                                    onclick="window.location.href='{{ route('galeri.index') }}'">
                                    @if ($gallery->image_url)
                                        <img src="{{ $gallery->image_url }}" alt="{{ $gallery->title ?? 'Galeri' }}"
                                            class="gallery-img" style="width: 100%; height: 100%; object-fit: cover;">
                                    @endif
                                    <div
                                        style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(0,0,0,0.7), transparent); padding: 1rem 0.75rem; color: white;">
                                        <p style="margin: 0; font-size: 0.85rem;">
                                            {{ Str::limit($gallery->title ?? 'Galeri', 30) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- CTA --}}
                    <div
                        style="text-align: center; margin-top: 3rem; padding: 2.5rem; background: var(--primary-blue); border-radius: var(--border-radius); color: white;">
                        <h3 style="margin-bottom: 0.75rem; color: white;">Tertarik dengan Jurusan Ini?</h3>
                        <p style="margin-bottom: 1.75rem; opacity: 0.95;">Daftar sekarang untuk tahun ajaran baru!</p>
                        <a href="{{ route('profilsekolah.ppdb-detail') }}" class="btn"
                            style="background: white; color: var(--primary-blue);">
                            Daftar Sekarang <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('styles')
    <style>
        /* Slider styles */
        .slider {
            position: relative;
            width: 100%;
        }

        .slide {
            display: none;
            animation: fadeIn 0.6s ease-in-out;
        }

        .slide.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .slider-dots {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
        }

        .dot {
            height: 10px;
            width: 10px;
            background-color: var(--border-color);
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s;
        }

        .dot.active {
            background-color: var(--primary-blue);
            width: 24px;
            border-radius: 5px;
        }

        .dot:hover {
            background-color: var(--primary-blue-hover);
        }

        .gallery-img {
            transition: transform 0.3s;
        }

        .gallery-img:hover {
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .slide img {
                height: 280px !important;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        let slideIndex = 0;
        let slideTimer;

        function showSlides() {
            let slides = document.getElementsByClassName("slide");
            let dots = document.getElementsByClassName("dot");

            for (let i = 0; i < slides.length; i++) {
                slides[i].classList.remove("active");
            }

            for (let i = 0; i < dots.length; i++) {
                dots[i].classList.remove("active");
            }

            slideIndex++;
            if (slideIndex > slides.length) {
                slideIndex = 1;
            }

            if (slides[slideIndex - 1]) {
                slides[slideIndex - 1].classList.add("active");
                dots[slideIndex - 1].classList.add("active");
            }

            slideTimer = setTimeout(showSlides, 5000);
        }

        function currentSlide(n) {
            clearTimeout(slideTimer);
            slideIndex = n;

            let slides = document.getElementsByClassName("slide");
            let dots = document.getElementsByClassName("dot");

            for (let i = 0; i < slides.length; i++) {
                slides[i].classList.remove("active");
            }

            for (let i = 0; i < dots.length; i++) {
                dots[i].classList.remove("active");
            }

            slides[slideIndex].classList.add("active");
            dots[slideIndex].classList.add("active");

            slideTimer = setTimeout(showSlides, 5000);
        }

        document.addEventListener('DOMContentLoaded', function() {
            if (document.getElementsByClassName("slide").length > 0) {
                showSlides();
            }
        });
    </script>
@endpush
