@extends('utama.layouts.app')
@section('title', 'Galeri - SMK Taman Siswa Purwokerto')

@section('content')

    <section class="section-padding" style="margin-top: 80px;">
        <div class="container" style="max-width: 1400px;">
            {{-- Page Title --}}
            <div style="text-align: center; margin-bottom: 3rem;">
                <h1 class="mobile:text-2xl" style="font-size: 2.5rem; font-weight: 700; color: var(--text-main); margin-bottom: 1rem;">Galeri Foto
                </h1>
                <p class="mobile:text-md" style="color: var(--text-muted); font-size: 1.1rem;">Dokumentasi kegiatan dan fasilitas SMK Taman Siswa
                    Purwokerto</p>
            </div>

            {{-- Gallery by Album --}}
            @php
                $albums = \App\Models\Galeri::select('album')
                    ->distinct()
                    ->whereNotNull('album')
                    ->where('album', '!=', '')
                    ->pluck('album');
            @endphp

            @if ($albums->count() > 0)
                @foreach ($albums as $album)
                    @php
                        $albumPhotos = \App\Models\Galeri::where('album', $album)
                            ->orderBy('is_favorite', 'desc')
                            ->orderBy('created_at', 'desc')
                            ->orderBy('order', 'asc')
                            ->get();
                    @endphp

                    @if ($albumPhotos->count() > 0)
                        {{-- Album Section --}}
                        <div class="album-section" style="margin-bottom: 4rem;">
                            {{-- Album Header --}}
                            <div
                                style="display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 3px solid var(--primary-blue);">
                                <i class="mobile:text-sm fas fa-folder-open" style="font-size: 1.75rem; color: var(--primary-blue);"></i>
                                <h2 class="mobile:text-sm" style="font-size: 1.75rem; font-weight: 700; color: var(--text-main); margin: 0;">
                                    {{ $album }}</h2>
                                <span
                                    class="mobile:text-xs" style="background: var(--primary-blue); color: white; padding: 0.25rem 0.75rem; border-radius: 2rem; font-size: 0.875rem; font-weight: 600;">
                                    {{ $albumPhotos->count() }} Foto
                                </span>
                            </div>

                            {{-- Gallery Grid --}}
                            <div class="gallery-grid gallery-grid-{{ Str::slug($album) }}"
                                style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
                                @foreach ($albumPhotos->take(8) as $gallery)
                                    <div class="gallery-item"
                                        onclick="openPopup('{{ $gallery->image_url }}', '{{ $gallery->title ?? 'Gallery Image' }}')"
                                        style="position: relative; overflow: hidden; border-radius: var(--border-radius); box-shadow: 0 4px 6px rgba(0,0,0,0.1); cursor: pointer; transition: all 0.3s; background: white; border: 1px solid var(--border-color);">
                                        <div style="position: relative; overflow: hidden;">
                                            <img src="{{ $gallery->image_url }}"
                                                alt="{{ $gallery->title ?? 'Gallery Image' }}"
                                                style="width: 100%; height: 300px; object-fit: cover; transition: transform 0.3s;">

                                            @if ($gallery->is_favorite)
                                                <div
                                                    style="position: absolute; top: 1rem; right: 1rem; background: rgba(255, 193, 7, 0.95); color: white; padding: 0.5rem 0.75rem; border-radius: 2rem; font-size: 0.875rem; font-weight: 600; display: flex; align-items: center; gap: 0.25rem;">
                                                    <i class="fas fa-star"></i>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="gallery-overlay"
                                            style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(0,0,0,0.9), transparent); padding: 2rem 1.5rem 1.5rem; color: white; transform: translateY(100%); transition: transform 0.3s;">
                                            <h4
                                                style="margin: 0 0 0.5rem 0; color: white; font-size: 1.1rem; font-weight: 600;">
                                                {{ $gallery->title ?? 'Untitled' }}
                                            </h4>
                                            @if ($gallery->jurusan)
                                                <p
                                                    style="margin: 0; font-size: 0.875rem; opacity: 0.9; display: flex; align-items: center; gap: 0.5rem;">
                                                    <i class="fas fa-graduation-cap"></i> {{ $gallery->jurusan->name }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Show More Button --}}
                            @if ($albumPhotos->count() > 8)
                                <div class="hidden-photos-{{ Str::slug($album) }}" style="display: none;">
                                    <div class="gallery-grid"
                                        style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem; margin-top: 1.5rem;">
                                        @foreach ($albumPhotos->skip(8) as $gallery)
                                            <div class="gallery-item"
                                                onclick="openPopup('{{ $gallery->image_url }}', '{{ $gallery->title ?? 'Gallery Image' }}')"
                                                style="position: relative; overflow: hidden; border-radius: var(--border-radius); box-shadow: 0 4px 6px rgba(0,0,0,0.1); cursor: pointer; transition: all 0.3s; background: white; border: 1px solid var(--border-color);">
                                                <div style="position: relative; overflow: hidden;">
                                                    <img src="{{ $gallery->image_url }}"
                                                        alt="{{ $gallery->title ?? 'Gallery Image' }}"
                                                        style="width: 100%; height: 300px; object-fit: cover; transition: transform 0.3s;">

                                                    @if ($gallery->is_favorite)
                                                        <div
                                                            style="position: absolute; top: 1rem; right: 1rem; background: rgba(255, 193, 7, 0.95); color: white; padding: 0.5rem 0.75rem; border-radius: 2rem; font-size: 0.875rem; font-weight: 600; display: flex; align-items: center; gap: 0.25rem;">
                                                            <i class="fas fa-star"></i>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="gallery-overlay"
                                                    style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(0,0,0,0.9), transparent); padding: 2rem 1.5rem 1.5rem; color: white; transform: translateY(100%); transition: transform 0.3s;">
                                                    <h4
                                                        style="margin: 0 0 0.5rem 0; color: white; font-size: 1.1rem; font-weight: 600;">
                                                        {{ $gallery->title ?? 'Untitled' }}
                                                    </h4>
                                                    @if ($gallery->jurusan)
                                                        <p
                                                            style="margin: 0; font-size: 0.875rem; opacity: 0.9; display: flex; align-items: center; gap: 0.5rem;">
                                                            <i class="fas fa-graduation-cap"></i>
                                                            {{ $gallery->jurusan->name }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div style="text-align: center; margin-top: 2rem;">
                                    <button class="show-more-btn" data-target="hidden-photos-{{ Str::slug($album) }}"
                                        style="padding: 0.875rem 2rem; background: var(--primary-blue); color: white; border: none; border-radius: 2rem; cursor: pointer; font-weight: 600; font-size: 1rem; transition: all 0.3s; display: inline-flex; align-items: center; gap: 0.5rem;">
                                        <i class="fas fa-chevron-down"></i>
                                        Tampilkan Lebih Banyak ({{ $albumPhotos->count() - 8 }} foto)
                                    </button>
                                </div>
                            @endif
                        </div>
                    @endif
                @endforeach
            @else
                <div
                    style="text-align: center; padding: 5rem 2rem; background: var(--bg-card); border-radius: var(--border-radius); border: 1px solid var(--border-color);">
                    <i class="fas fa-images"
                        style="font-size: 5rem; color: var(--text-muted); margin-bottom: 1rem; opacity: 0.3;"></i>
                    <h4 style="color: var(--text-main); margin-bottom: 0.5rem;">Belum ada galeri foto</h4>
                    <p style="color: var(--text-muted);">Galeri foto akan segera hadir.</p>
                </div>
            @endif
        </div>
    </section>

    {{-- Simple Image Popup --}}
    <div id="imagePopup" onclick="closePopup()"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.9); z-index: 9999; justify-content: center; align-items: center;">
        <span onclick="closePopup()"
            style="position: absolute; top: 20px; right: 30px; color: white; font-size: 40px; cursor: pointer; z-index: 10000;">&times;</span>
        <div style="max-width: 90%; max-height: 90%; text-align: center;">
            <img id="popupImage" src="" style="max-width: 100%; max-height: 80vh; object-fit: contain;">
            <h3 id="popupTitle" style="color: white; margin-top: 20px; font-size: 1.5rem;"></h3>
        </div>
    </div>

@endsection

@push('styles')
    <style>
        .gallery-item {
            border: 1px solid var(--border-color);
        }

        .gallery-item:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15) !important;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        .gallery-item:hover .gallery-overlay {
            transform: translateY(0);
        }

        .show-more-btn:hover {
            background: #5568d3 !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .show-more-btn:active {
            transform: translateY(0);
        }

        .show-more-btn.hidden {
            display: none !important;
        }

        @media (max-width: 768px) {
            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)) !important;
            }

            .gallery-item img {
                height: 250px !important;
            }

            .album-section h2 {
                font-size: 1.5rem !important;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Simple Popup Functions
        function openPopup(imageUrl, title) {
            document.getElementById('imagePopup').style.display = 'flex';
            document.getElementById('popupImage').src = imageUrl;
            document.getElementById('popupTitle').textContent = title;
            document.body.style.overflow = 'hidden';
        }

        function closePopup() {
            document.getElementById('imagePopup').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

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

        // Close popup with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closePopup();
            }
        });
    </script>
@endpush
