@extends('utama.layouts.app')
@section('title', 'Portal Berita - SMK Taman Siswa Purwokerto')

@section('content')

    <section class="section-padding" style="margin-top: 80px;">
        <div class="container">
            <h1 class="section-title mobile:text-xl" style="margin-bottom: 0.5rem;">Portal Berita SMK Taman Siswa</h1>

            {{-- Filter Section --}}
            <form method="GET" action="{{ route('berita.index') }}" style="margin-bottom: 2rem;">
                <div style="display: grid; grid-template-columns: 2fr 1fr 1fr auto; gap: 1rem; align-items: end;">
                    {{-- Search --}}
                    <div>
                        <label class="mobile:text-sm"
                            style="display: block; margin-bottom: 0.5rem; font-weight: 500; color: var(--text-main);">Cari
                            Berita</label>
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="search-input mobile:text-xs" placeholder="Cari berita..."
                            style="width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--border-color); border-radius: var(--border-radius); font-size: 1rem;">
                    </div>

                    {{-- Category Filter --}}
                    <div>
                        <label class="mobile:text-sm"
                            style="display: block; margin-bottom: 0.5rem; font-weight: 500; color: var(--text-main);">Kategori</label>
                        <select name="category" class="mobile:text-xs"
                            style="width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--border-color); border-radius: var(--border-radius); font-size: 1rem; background: white;">
                            <option value="">Semua Kategori</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Jurusan Filter --}}
                    <div>
                        <label class="mobile:text-sm"
                            style="display: block; margin-bottom: 0.5rem; font-weight: 500; color: var(--text-main);">Jurusan</label>
                        <select name="jurusan" class="mobile:text-xs"
                            style="width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--border-color); border-radius: var(--border-radius); font-size: 1rem; background: white;">
                            <option value="">Semua Jurusan</option>
                            @foreach ($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}"
                                    {{ request('jurusan') == $jurusan->id ? 'selected' : '' }}>
                                    {{ $jurusan->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Filter Button --}}
                    <div>
                        <button type="submit" class="btn btn-primary" style="width: 100%; white-space: nowrap;">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                    </div>
                </div>

                {{-- Reset Filter --}}
                @if (request('search') || request('category') || request('jurusan'))
                    <div style="margin-top: 1rem;">
                        <a href="{{ route('berita.index') }}" class="btn btn-secondary" style="font-size: 0.9rem;">
                            <i class="fas fa-times"></i> Reset Filter
                        </a>
                    </div>
                @endif
            </form>

            {{-- Active Filters Display --}}
            @if (request('search') || request('category') || request('jurusan'))
                <div
                    style="margin-bottom: 2rem; padding: 1rem; background: var(--bg-card); border-left: 3px solid var(--primary-blue); border-radius: var(--border-radius);">
                    <strong>Filter Aktif:</strong>
                    @if (request('search'))
                        <span class="btn btn-secondary" style="font-size: 0.85rem; margin-left: 0.5rem;">
                            Pencarian: "{{ request('search') }}"
                        </span>
                    @endif
                    @if (request('category'))
                        <span class="btn btn-secondary" style="font-size: 0.85rem; margin-left: 0.5rem;">
                            Kategori: {{ request('category') }}
                        </span>
                    @endif
                    @if (request('jurusan'))
                        @php
                            $selectedJurusan = $jurusans->firstWhere('id', request('jurusan'));
                        @endphp
                        @if ($selectedJurusan)
                            <span class="btn btn-secondary" style="font-size: 0.85rem; margin-left: 0.5rem;">
                                Jurusan: {{ $selectedJurusan->name }}
                            </span>
                        @endif
                    @endif
                </div>
            @endif

            {{-- Results Count --}}
            <p class="mobile:text-sm" style="color: var(--text-muted); margin-bottom: 1.5rem; font-size: 0.95rem;">
                Menampilkan <strong>{{ $beritas->total() }}</strong> berita
            </p>

            {{-- News Grid --}}
            <div class="news-grid" id="newsContainer">
                @forelse($beritas as $berita)
                    <!-- Item -->
                    <article class="news-card">
                        <a href="{{ route('berita.show', $berita->slug) }}"
                            style="text-decoration: none; color: inherit; display: block;">
                            <img src="{{ $berita->image_url ?? 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' }}"
                                alt="{{ $berita->title }}" class="news-img">
                            <div class="news-content">
                                <div style="display: flex; gap: 0.5rem; margin-bottom: 0.5rem; flex-wrap: wrap;">
                                    <span
                                        class="news-meta">{{ optional($berita->created_at)->format('d F Y') ?? date('d F Y') }}</span>
                                    @if ($berita->category)
                                        <span
                                            style="background: var(--primary-blue); color: white; padding: 0.25rem 0.75rem; border-radius: 1rem; font-size: 0.75rem; font-weight: 500;">
                                            {{ $berita->category }}
                                        </span>
                                    @endif
                                    @if ($berita->jurusan)
                                        <span
                                            style="background: var(--accent-green); color: white; padding: 0.25rem 0.75rem; border-radius: 1rem; font-size: 0.75rem; font-weight: 500;">
                                            {{ $berita->jurusan->name }}
                                        </span>
                                    @endif
                                </div>
                                <h3 class="news-title mobile:text-md">{{ $berita->title }}</h3>
                                <p class="mobile:text-sm"
                                    style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">
                                    {{ Str::limit(strip_tags($berita->content ?? ($berita->excerpt ?? '')), 100) }}
                                </p>
                                <span class="btn-link mobile:text-sm"
                                    style="font-size: 0.9rem; color: var(--accent-green-hover);">
                                    Baca Selengkapnya →
                                </span>
                            </div>
                        </a>
                    </article>
                @empty
                    <!-- Empty State -->
                    <div style="grid-column: 1 / -1; text-align: center; padding: 3rem;">
                        <i class="fas fa-newspaper"
                            style="font-size: 4rem; color: var(--text-muted); margin-bottom: 1rem;"></i>
                        <h3 style="color: var(--text-main); margin-bottom: 0.5rem;">Tidak Ada Berita</h3>
                        <p style="color: var(--text-muted);">
                            @if (request('search') || request('category') || request('jurusan'))
                                Tidak ada berita yang sesuai dengan filter Anda.
                            @else
                                Berita akan segera ditambahkan.
                            @endif
                        </p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if (isset($beritas) && method_exists($beritas, 'links'))
                <div class="pagination-container" style="margin-top: 3rem; display: flex; justify-content: center;">
                    {{ $beritas->appends(request()->query())->links('vendor.pagination.custom') }}
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

@push('styles')
    <style>
        @media (max-width: 768px) {
            div[style*="grid-template-columns: 2fr 1fr 1fr auto"] {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
@endpush
