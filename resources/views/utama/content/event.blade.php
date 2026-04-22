@extends('utama.layouts.app')
@section('title', 'Event - SMK Taman Siswa Purwokerto')

@section('content')

    <section class="section-padding" style="margin-top: 80px;">
        <div class="container">
            <h1 class="section-title mobile:text-xl">Event Sekolah</h1>

            <div class="search-container" style="display: flex; gap: 1rem; flex-wrap: wrap; margin-bottom: 2rem;">
                <input type="text" id="searchInput" class="search-input" placeholder="Cari event..."
                    style="flex: 1; min-width: 250px;">

                <select id="jurusanFilter" class="filter-select"
                    style="padding: 0.875rem 1.5rem; border-radius: 12px; border: 2px solid #e5e7eb; background: white; font-weight: 500; cursor: pointer; min-width: 200px;">
                    <option value="">Semua Jurusan</option>
                    @foreach ($jurusans ?? [] as $jurusan)
                        <option value="{{ $jurusan->id }}">{{ $jurusan->name }}</option>
                    @endforeach
                </select>

                <button class="btn btn-primary"
                    style="background: var(--highlight-yellow); color: white; padding: 0.875rem 1.5rem; border-radius: 12px; border: none; cursor: pointer; font-weight: 600;">
                    <i class="fas fa-search"></i> Cari
                </button>
            </div>

            <div class="news-grid" id="eventContainer">
                @forelse($events ?? [] as $event)
                    <!-- Item -->
                    <article class="news-card search-item" data-jurusan="{{ $event->jurusan_id ?? '' }}">
                        <img src="{{ $event->image_path ? asset($event->image_path) : 'https://images.unsplash.com/photo-1544531586-fde5298cdd40?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' }}"
                            alt="{{ $event->title ?? 'Event' }}" class="news-img">
                        <div class="news-content">
                            <span class="news-meta" style="color: var(--highlight-yellow-hover);">
                                @if (\Carbon\Carbon::parse($event->start_date)->isFuture())
                                    AKAN DATANG
                                @elseif(
                                    \Carbon\Carbon::parse($event->start_date)->isToday() ||
                                        (\Carbon\Carbon::parse($event->end_date ?? $event->start_date)->isFuture() &&
                                            \Carbon\Carbon::parse($event->start_date)->isPast()))
                                    SEDANG BERLANGSUNG
                                @else
                                    SELESAI
                                @endif
                            </span>
                            <h3 class="news-title mobile:text-lg">{{ $event->title }}</h3>
                            <p class="mobile:text-sm"
                                style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">
                                {{ Str::limit(strip_tags($event->description ?? ''), 100) }}
                            </p>
                            <div class="mobile:text-xs"
                                style="color: var(--text-muted); font-size: 0.85rem; margin-bottom: 0.5rem;">
                                <i class="far fa-calendar"></i>
                                {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}
                                @if ($event->location)
                                    <i class="fas fa-map-marker-alt" style="margin-left: 1rem;"></i> {{ $event->location }}
                                @endif
                                @if ($event->jurusan)
                                    <br><i class="fas fa-graduation-cap"></i> {{ $event->jurusan->name }}
                                @endif
                            </div>
                            <a href="{{ route('event.show', $event->slug) }}" class="btn-link"
                                style="font-size: 0.9rem; color: var(--highlight-yellow-hover);">Lihat Detail</a>
                        </div>
                    </article>
                @empty
                    <!-- Dummy Data jika tidak ada event -->
                    <article class="news-card search-item">
                        <img src="https://images.unsplash.com/photo-1544531586-fde5298cdd40?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                            alt="Event" class="news-img">
                        <div class="news-content">
                            <span class="news-meta" style="color: var(--highlight-yellow-hover);">AKAN DATANG</span>
                            <h3 class="news-title">Event Akan Segera Hadir</h3>
                            <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">Berbagai kegiatan
                                dan acara menarik akan segera dilaksanakan...</p>
                            <a href="#" class="btn-link"
                                style="font-size: 0.9rem; color: var(--highlight-yellow-hover);">Lihat Detail</a>
                        </div>
                    </article>
                @endforelse
            </div>

            <!-- Pagination -->
            @if (isset($events) && method_exists($events, 'links'))
                <div class="pagination-container" style="margin-top: 3rem; display: flex; justify-content: center;">
                    {{ $events->links('vendor.pagination.custom') }}
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
            color: var(--highlight-yellow);
            border: 2px solid #e5e7eb;
        }

        .pagination-container a:hover {
            background: var(--highlight-yellow);
            color: white;
            border-color: var(--highlight-yellow);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
        }

        .pagination-container .active span {
            background: linear-gradient(135deg, var(--highlight-yellow) 0%, var(--highlight-yellow-hover) 100%);
            color: white;
            border: 2px solid var(--highlight-yellow);
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const jurusanFilter = document.getElementById('jurusanFilter');
            const eventCards = document.querySelectorAll('.search-item');

            function filterEvents() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedJurusan = jurusanFilter.value;

                eventCards.forEach(card => {
                    const title = card.querySelector('.news-title').textContent.toLowerCase();
                    const description = card.querySelector('p').textContent.toLowerCase();
                    const cardJurusan = card.getAttribute('data-jurusan');

                    const matchesSearch = title.includes(searchTerm) || description.includes(searchTerm);
                    const matchesJurusan = !selectedJurusan || cardJurusan === selectedJurusan;

                    if (matchesSearch && matchesJurusan) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }

            searchInput.addEventListener('input', filterEvents);
            jurusanFilter.addEventListener('change', filterEvents);
        });
    </script>

@endsection
