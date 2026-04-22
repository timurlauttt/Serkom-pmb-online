@extends('utama.layouts.app')
@section('title', $pengumuman->title . ' - Pengumuman SMK Taman Siswa Purwokerto')

@section('content')

    <section class="section-padding" style="margin-top: 80px;">
        <div class="container" style="max-width: 1200px;">
            {{-- Breadcrumb --}}
            <p class="mobile:text-xs" style="margin-bottom: 2rem; color: var(--text-muted);">
                <a href="{{ route('landingpage') }}">Beranda</a> /
                <a href="{{ route('pengumuman.index') }}">Pengumuman</a> /
                {{ Str::limit($pengumuman->title, 50) }}
            </p>

            <div style="display: grid; grid-template-columns: 1fr 350px; gap: 3rem;">
                {{-- Main Content --}}
                <article>
                    {{-- Alert/Notice Style --}}
                    <div
                        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 2rem; border-radius: var(--border-radius); margin-bottom: 2rem; box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);">
                        <div style="display: flex; align-items: center; gap: 1.5rem;">
                            <i class="fas fa-bullhorn" style="font-size: 2.5rem;"></i>
                            <div style="flex: 1;">
                                <h3 style="margin: 0 0 0.5rem 0; color: white; font-size: 1.25rem; font-weight: 700;">
                                    PENGUMUMAN PENTING</h3>
                                <p style="margin: 0; opacity: 0.9; font-size: 0.9rem;">
                                    <i class="fas fa-calendar"></i>
                                    {{ optional($pengumuman->posted_at ?? $pengumuman->created_at)->format('d F Y, H:i') }}
                                    WIB
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Title --}}
                    <h1 class="mobile:text-lg"
                        style="font-size: 2.25rem; font-weight: 700; color: var(--text-main); margin-bottom: 1.5rem; line-height: 1.3;">
                        {{ $pengumuman->title }}
                    </h1>

                    {{-- Meta Information --}}
                    <div class="mobile:text-sm"
                        style="display: flex; flex-wrap: wrap; gap: 1rem; margin-bottom: 2rem; padding-bottom: 1.5rem; border-bottom: 2px solid var(--border-color); align-items: center;">
                        <span
                            style="color: var(--text-muted); display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem;">
                            <i class="fas fa-calendar-day" style="color: var(--primary-blue);"></i>
                            Dipublikasikan:
                            {{ optional($pengumuman->posted_at ?? $pengumuman->created_at)->format('d F Y') }}
                        </span>

                        @if ($pengumuman->expires_at)
                            <span
                                style="color: var(--text-muted); display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem;">
                                <i class="fas fa-clock" style="color: var(--primary-blue);"></i>
                                Berlaku hingga: {{ $pengumuman->expires_at->format('d F Y') }}
                            </span>
                        @endif
                    </div>

                    {{-- Content --}}
                    <div class="content-article mobile:text-base"
                        style="line-height: 1.8; font-size: 1.05rem; color: var(--text-main); text-align: justify;">
                        {!! $pengumuman->content !!}
                    </div>

                    {{-- Share Buttons --}}
                    <div style="margin-top: 2.5rem; padding-top: 2rem; border-top: 1px solid var(--border-color);">
                        <h5 style="margin-bottom: 1rem; color: var(--text-main); font-weight: 600;">Bagikan:</h5>
                        <div class="share-buttons">
                            <a href="https://www.instagram.com/share?url={{ urlencode(url()->current()) }}" target="_blank"
                                class="share-btn share-btn-instagram">
                                <i class="fab fa-instagram"></i> <span>Instagram</span>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                target="_blank" class="share-btn share-btn-facebook">
                                <i class="fab fa-facebook"></i> <span>Facebook</span>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($pengumuman->title . ' ' . url()->current()) }}"
                                target="_blank" class="share-btn share-btn-whatsapp">
                                <i class="fab fa-whatsapp"></i> <span>WhatsApp</span>
                            </a>
                        </div>
                    </div>

                    {{-- Navigation --}}
                    <div style="margin-top: 3rem;">
                        <a href="{{ route('pengumuman.index') }}" class="btn btn-secondary hidden-btn">
                            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Pengumuman
                        </a>
                    </div>
                </article>

                {{-- Sidebar --}}
                <aside>
                    {{-- Recent Announcements --}}
                    <div
                        style="background: var(--bg-card); padding: 2rem; border-radius: var(--border-radius); border: 1px solid var(--border-color);">
                        <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--text-main); margin-bottom: 1.5rem;">
                            Pengumuman Terbaru</h3>

                        @php
                            $recentAnnouncements = \App\Models\Pengumuman::where('id', '!=', $pengumuman->id)
                                ->latest('posted_at')
                                ->take(5)
                                ->get();
                        @endphp

                        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                            @forelse($recentAnnouncements as $announcement)
                                <a href="{{ route('pengumuman.show', $announcement->slug) }}"
                                    style="text-decoration: none; color: inherit; display: flex; gap: 1rem; transition: transform 0.2s;"
                                    onmouseover="this.style.transform='translateX(5px)'"
                                    onmouseout="this.style.transform='translateX(0)'">
                                    <div
                                        style="width: 80px; height: 80px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: var(--border-radius); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <i class="fas fa-bullhorn" style="font-size: 1.5rem; color: white;"></i>
                                    </div>
                                    <div style="flex: 1; min-width: 0;">
                                        <h4
                                            style="font-size: 0.95rem; font-weight: 600; color: var(--text-main); margin-bottom: 0.5rem; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                            {{ $announcement->title }}
                                        </h4>
                                        <p
                                            style="font-size: 0.8rem; color: var(--text-muted); display: flex; align-items: center; gap: 0.5rem; margin: 0;">
                                            <i class="fas fa-calendar" style="font-size: 0.7rem;"></i>
                                            {{ optional($announcement->posted_at)->format('d M Y') ?? optional($announcement->created_at)->format('d M Y') }}
                                        </p>
                                    </div>
                                </a>
                            @empty
                                <p style="color: var(--text-muted); font-size: 0.9rem; text-align: center;">Tidak ada
                                    pengumuman lainnya</p>
                            @endforelse
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>

@endsection

@push('styles')
    <style>
        .content-article {
            word-wrap: break-word;
        }

        .content-article img {
            max-width: 100%;
            height: auto;
            border-radius: var(--border-radius);
            margin: 1.5rem 0;
        }

        .content-article p {
            margin-bottom: 1.5rem;
        }

        .content-article h1,
        .content-article h2,
        .content-article h3,
        .content-article h4 {
            margin-top: 2rem;
            margin-bottom: 1rem;
            font-weight: 700;
            color: var(--text-main);
        }

        .content-article h1 {
            font-size: 2rem;
        }

        .content-article h2 {
            font-size: 1.75rem;
        }

        .content-article h3 {
            font-size: 1.5rem;
        }

        .content-article h4 {
            font-size: 1.25rem;
        }

        .content-article ul,
        .content-article ol {
            margin-left: 2rem;
            margin-bottom: 1.5rem;
        }

        .content-article li {
            margin-bottom: 0.5rem;
        }

        .content-article a {
            color: var(--primary-blue);
            text-decoration: underline;
        }

        .content-article table {
            width: 100%;
            border-collapse: collapse;
            margin: 1.5rem 0;
        }

        .content-article table td,
        .content-article table th {
            border: 1px solid var(--border-color);
            padding: 0.75rem;
        }

        .content-article table th {
            background: var(--bg-card);
            font-weight: 600;
        }

        .content-article blockquote {
            border-left: 4px solid var(--primary-blue);
            padding-left: 1.5rem;
            margin: 1.5rem 0;
            font-style: italic;
            color: var(--text-muted);
        }

        @media (max-width: 768px) {
            .container>div[style*="grid-template-columns: 1fr 350px"] {
                grid-template-columns: 1fr !important;
            }

            article h1 {
                font-size: 1.75rem !important;
            }
        }
    </style>
@endpush
