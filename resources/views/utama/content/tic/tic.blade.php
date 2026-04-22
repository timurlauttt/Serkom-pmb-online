@extends('utama.layouts.app')
@section('title', 'TIC - SMK Taman Siswa Purwokerto')

@section('content')

    {{-- Hero Section --}}
    <section class="hero"
        style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.7)), url('{{ asset('images/hero.jpg') }}') no-repeat center center/cover;">
        <div class="container">
            <div class="hero-content" style="max-width: 900px; margin: 0 auto; text-align: center;">
                <h1 class="mobile:text-2xl" style="color: white; margin-bottom: 1.5rem;">Tourist Information <br><span
                        style="color: var(--highlight-yellow);">Center</span></h1>
                <p class="mobile:text-base"
                    style="color: rgba(255,255,255,0.9); font-size: 1.25rem; margin-bottom: 2.5rem; line-height: 1.6;">
                    Pusat informasi terlengkap seputar destinasi wisata, kuliner, dan akomodasi di Banyumas dan sekitarnya,
                    dikelola oleh SMK Taman Siswa Purwokerto.
                </p>
                <div style="display: flex; justify-content: center; gap: 1rem;">
                    <button onclick="document.getElementById('explore-section').scrollIntoView({behavior: 'smooth'})"
                        class="btn btn-primary">
                        Mulai Jelajahi
                    </button>
                </div>
            </div>
        </div>
    </section>

    {{-- Info Categories --}}
    <section id="explore-section" class="section-padding">
        <div class="container" style="max-width: 1400px;">
            <div style="text-align: center; margin-bottom: 3rem;">
                <h2 class="section-title mobile:text-xl"
                    style="font-size: 2.5rem; color: var(--primary-blue); margin-bottom: 1rem;">Jelajahi Wisata</h2>
                <p class="mobile:text-base" style="color: var(--text-muted); font-size: 1.1rem;">Temukan destinasi dan
                    layanan wisata terbaik di Banyumas</p>
            </div>

            {{-- Search Bar --}}
            <div style="max-width: 600px; margin: 0 auto 3rem; position: relative;">
                <input type="text" id="searchAll" placeholder="Cari hotel, restoran, wisata..."
                    style="width: 100%; padding: 1rem 3rem 1rem 1.5rem; border-radius: 2rem; border: 2px solid var(--border-color); font-size: 1rem; transition: all 0.3s;">
                <i class="fas fa-search"
                    style="position: absolute; right: 1.5rem; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
            </div>

            @php
                $resolveImage = function ($item) {
                    $default = asset('images/front-end-img/courses/4.jpg');
                    $fields = ['gambar', 'image_path', 'image', 'photo', 'path', 'foto', 'thumbnail'];
                    foreach ($fields as $f) {
                        if (isset($item->$f) && $item->$f) {
                            $p = ltrim($item->$f, '/');
                            if (file_exists(public_path($p))) {
                                return asset($p);
                            }
                            if (file_exists(public_path('storage/' . $p))) {
                                return asset('storage/' . $p);
                            }
                        }
                    }
                    return $default;
                };
            @endphp

            {{-- All Sections --}}
            @include('utama.content.tic.sections.hotel', [
                'hotelList' => $hotelList ?? collect(),
                'resolveImage' => $resolveImage,
            ])
            @include('utama.content.tic.sections.restoran', [
                'restoranList' => $restoranList ?? collect(),
                'resolveImage' => $resolveImage,
            ])
            @include('utama.content.tic.sections.wisata', [
                'objekWisataList' => $objekWisataList ?? collect(),
                'resolveImage' => $resolveImage,
            ])
            @include('utama.content.tic.sections.desa', [
                'desaWisataList' => $desaWisataList ?? collect(),
                'resolveImage' => $resolveImage,
            ])
            @include('utama.content.tic.sections.transportasi', [
                'transportasiList' => $transportasiList ?? collect(),
                'resolveImage' => $resolveImage,
            ])
            @include('utama.content.tic.sections.paket', [
                'paketWisataList' => $paketWisataList ?? collect(),
                'resolveImage' => $resolveImage,
            ])

        </div>
    </section>
@endsection

@push('styles')
    <style>
        .news-card {
            transition: all 0.3s;
        }

        .news-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15) !important;
        }

        .show-more-btn:hover {
            background: var(--primary-blue-hover) !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .show-more-btn.hidden {
            display: none !important;
        }

        .category-section {
            scroll-margin-top: 100px;
        }

        #searchAll:focus {
            outline: none;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        @media (max-width: 768px) {
            .news-grid {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show More functionality
            document.querySelectorAll('.show-more-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const targetClass = this.getAttribute('data-target');
                    const hiddenSection = document.querySelector('.' + targetClass);

                    if (hiddenSection) {
                        hiddenSection.style.display = 'block';
                        this.style.display = 'none';
                    }
                });
            });

            // Search functionality
            const searchInput = document.getElementById('searchAll');
            const allItems = document.querySelectorAll('.search-item');
            const allSections = document.querySelectorAll('.category-section');

            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();

                if (searchTerm === '') {
                    allItems.forEach(item => item.style.display = 'block');
                    allSections.forEach(section => section.style.display = 'block');
                } else {
                    allItems.forEach(item => {
                        const title = item.getAttribute('data-title') || '';
                        const desc = item.getAttribute('data-desc') || '';

                        if (title.includes(searchTerm) || desc.includes(searchTerm)) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });

                    allSections.forEach(section => {
                        const categoryItems = section.querySelectorAll('.search-item');
                        const visibleItems = Array.from(categoryItems).filter(item => item.style
                            .display !== 'none');

                        if (visibleItems.length === 0) {
                            section.style.display = 'none';
                        } else {
                            section.style.display = 'block';
                        }
                    });
                }
            });
        });
    </script>
@endpush
