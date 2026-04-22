@extends('utama.layouts.app')
@section('title', 'Pengumuman - SMK Taman Siswa Purwokerto')

@section('content')

    <section class="section-padding" style="margin-top: 80px;">
        <div class="container">
            <h1 class="section-title mobile:text-xl">Pengumuman Sekolah</h1>

            <div class="search-container">
                <input type="text" id="searchInput" class="search-input" placeholder="Cari pengumuman...">
                <button class="btn btn-primary mobile:text-xs"><i class="fas fa-search"></i> Cari</button>
            </div>

            <div class="news-grid" id="pengumumanContainer">
                @forelse($pengumumans ?? [] as $pengumuman)
                    <!-- Item -->
                    <article class="news-card search-item">
                        @if ($pengumuman->image_path)
                            <img src="{{ asset($pengumuman->image_path) }}" alt="{{ $pengumuman->title }}" class="news-img">
                        @else
                            <div class="news-img"
                                style="background: var(--bg-secondary); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-bullhorn" style="font-size: 3rem; color: var(--primary-blue-hover);"></i>
                            </div>
                        @endif
                        <div class="news-content">
                            <span class="news-meta" style="color: var(--primary-blue-hover);">
                                @if ($pengumuman->expires_at && \Carbon\Carbon::parse($pengumuman->expires_at)->isPast())
                                    KADALUARSA
                                @else
                                    PENGUMUMAN PENTING
                                @endif
                            </span>
                            <h3 class="news-title mobile:text-lg">{{ $pengumuman->title }}</h3>
                            <p class="mobile:text-sm"
                                style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">
                                {{ Str::limit(strip_tags($pengumuman->content ?? ''), 100) }}
                            </p>
                            <div class="mobile:text-xs"
                                style="color: var(--text-muted); font-size: 0.85rem; margin-bottom: 0.5rem;">
                                <i class="far fa-calendar"></i>
                                {{ \Carbon\Carbon::parse($pengumuman->posted_at)->format('d M Y') }}
                                @if ($pengumuman->expires_at)
                                    <span style="margin-left: 1rem;">
                                        <i class="far fa-clock"></i> Berlaku hingga
                                        {{ \Carbon\Carbon::parse($pengumuman->expires_at)->format('d M Y') }}
                                    </span>
                                @endif
                            </div>
                            <a href="{{ route('pengumuman.show', $pengumuman->slug) }}" class="btn-link"
                                style="font-size: 0.9rem; color: var(--primary-blue-hover);">Lihat Detail</a>
                        </div>
                    </article>
                @empty
                    <!-- Dummy Data jika tidak ada pengumuman -->
                    <article class="news-card search-item">
                        <div class="news-img"
                            style="background: var(--bg-secondary); display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-bullhorn" style="font-size: 3rem; color: var(--primary-blue-hover);"></i>
                        </div>
                        <div class="news-content">
                            <span class="news-meta" style="color: var(--primary-blue-hover);">PENGUMUMAN PENTING</span>
                            <h3 class="news-title">Pengumuman Akan Segera Hadir</h3>
                            <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">Informasi penting
                                seputar kegiatan sekolah akan diumumkan di sini...</p>
                            <a href="#" class="btn-link"
                                style="font-size: 0.9rem; color: var(--primary-blue-hover);">Lihat Detail</a>
                        </div>
                    </article>
                @endforelse
            </div>

            <!-- Pagination -->
            @if (isset($pengumumans) && method_exists($pengumumans, 'links'))
                <div class="pagination-container" style="margin-top: 3rem; display: flex; justify-content: center;">
                    {{ $pengumumans->links('vendor.pagination.custom') }}
                </div>
            @endif

        </div>
    </section>

    <style>
        .pagination-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 3rem;
        }

        .pagination-container nav {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .pagination-container ul {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            gap: 0.5rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .pagination-container li {
            margin: 0;
        }

        .pagination-container a,
        .pagination-container span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            font-size: 0.95rem;
        }

        .pagination-container a {
            background: white;
            color: var(--primary-blue);
            border: 2px solid #e5e7eb;
        }

        .pagination-container a:hover {
            background: var(--primary-blue);
            color: white;
            border-color: var(--primary-blue);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .pagination-container .active span {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-blue-hover) 100%);
            color: white;
            border: 2px solid var(--primary-blue);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        }

        .pagination-container .disabled span {
            background: #f3f4f6;
            color: #9ca3af;
            border: 2px solid #e5e7eb;
            cursor: not-allowed;
        }

        .pagination-container svg {
            width: 20px;
            height: 20px;
        }

        @media (max-width: 768px) {

            .pagination-container a,
            .pagination-container span {
                min-width: 36px;
                height: 36px;
                padding: 0.4rem 0.8rem;
                font-size: 0.875rem;
            }
        }
    </style>

@endsection
