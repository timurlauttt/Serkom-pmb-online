@extends('utama.layouts.app')
@section('title', $event->title . ' - Event SMK Taman Siswa Purwokerto')
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($event->content ?? $event->description), 160))

@section('content')

    <section class="section-padding" style="margin-top: 80px;">
        <div class="container" style="max-width: 1200px;">
            {{-- Breadcrumb --}}
            <p class="mobile:text-xs" style="margin-bottom: 2rem; color: var(--text-muted);">
                <a href="{{ route('landingpage') }}">Beranda</a> /
                <a href="{{ route('event.index') }}">Event</a> /
                {{ Str::limit($event->title, 50) }}
            </p>

            <div style="display: grid; grid-template-columns: 1fr 350px; gap: 3rem;">
                {{-- Main Content --}}
                <article>
                    {{-- Title --}}
                    <h1 class="mobile:text-lg"
                        style="font-size: 2.25rem; font-weight: 700; color: var(--text-main); margin-bottom: 1.5rem; line-height: 1.3;">
                        {{ $event->title }}
                    </h1>

                    {{-- Meta Information --}}
                    <div class="mobile:text-sm"
                        style="display: flex; flex-wrap: wrap; gap: 1rem; margin-bottom: 2rem; padding-bottom: 1.5rem; border-bottom: 2px solid var(--border-color); align-items: center;">
                        @if ($event->status === 'upcoming')
                            <span
                                style="background: #28a745; color: white; padding: 0.5rem 1.25rem; border-radius: 2rem; font-size: 0.875rem; font-weight: 500; display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fas fa-clock"></i> Akan Datang
                            </span>
                        @elseif($event->status === 'ongoing')
                            <span
                                style="background: #ffc107; color: #333; padding: 0.5rem 1.25rem; border-radius: 2rem; font-size: 0.875rem; font-weight: 500; display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fas fa-play-circle"></i> Sedang Berlangsung
                            </span>
                        @elseif($event->status === 'completed')
                            <span
                                style="background: #6c757d; color: white; padding: 0.5rem 1.25rem; border-radius: 2rem; font-size: 0.875rem; font-weight: 500; display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fas fa-check-circle"></i> Selesai
                            </span>
                        @endif

                        @if ($event->category)
                            <a href="{{ route('event.index', ['category' => $event->category]) }}"
                                style="background: var(--primary-blue); color: white; padding: 0.5rem 1.25rem; border-radius: 2rem; font-size: 0.875rem; font-weight: 500; text-decoration: none; transition: all 0.2s;"
                                onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                                {{ $event->category }}
                            </a>
                        @endif

                        @if ($event->start_date)
                            <span
                                style="color: var(--text-muted); display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem;">
                                <i class="fas fa-calendar-day" style="color: var(--primary-blue);"></i>
                                {{ $event->start_date->format('d F Y') }}
                            </span>
                        @endif

                        @if ($event->location)
                            <span
                                style="color: var(--text-muted); display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem;">
                                <i class="fas fa-map-marker-alt" style="color: var(--primary-blue);"></i>
                                {{ $event->location }}
                            </span>
                        @endif

                        @if ($event->organizer)
                            <span
                                style="color: var(--text-muted); display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem;">
                                <i class="fas fa-user-circle" style="color: var(--primary-blue);"></i>
                                {{ $event->organizer }}
                            </span>
                        @endif

                        @if ($event->jurusan)
                            <a href="{{ route('jurusan.show', $event->jurusan->slug) }}"
                                style="background: white; border: 1px solid var(--accent-green); color: var(--accent-green); padding: 0.4rem 1rem; border-radius: 2rem; font-size: 0.875rem; font-weight: 500; text-decoration: none; display: flex; align-items: center; gap: 0.4rem; transition: all 0.2s;"
                                onmouseover="this.style.background='var(--accent-green)'; this.style.color='white'"
                                onmouseout="this.style.background='white'; this.style.color='var(--accent-green)'">
                                <i class="fas fa-graduation-cap"></i>
                                {{ $event->jurusan->name }}
                            </a>
                        @endif
                    </div>

                    {{-- Featured Image --}}
                    @if ($event->image_url)
                        <img src="{{ $event->image_url }}" alt="{{ $event->title }}"
                            style="width: 100%; height: auto; border-radius: var(--border-radius); margin-bottom: 2.5rem;">
                    @endif

                    {{-- Content --}}
                    <div class="content-article"
                        style="line-height: 1.8; font-size: 1.05rem; color: var(--text-main); text-align: justify;">
                        {!! $event->content ?? $event->description !!}
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
                            <a href="https://wa.me/?text={{ urlencode($event->title . ' ' . url()->current()) }}"
                                target="_blank" class="share-btn share-btn-whatsapp">
                                <i class="fab fa-whatsapp"></i> <span>WhatsApp</span>
                            </a>
                        </div>
                    </div>

                    {{-- Navigation --}}
                    <div style="margin-top: 3rem;">
                        <a href="{{ route('event.index') }}" class="btn btn-secondary hidden-btn">
                            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Event
                        </a>
                    </div>
                </article>

                {{-- Sidebar --}}
                <aside>
                    {{-- Upcoming Events --}}
                    <div
                        style="background: var(--bg-card); padding: 2rem; border-radius: var(--border-radius); border: 1px solid var(--border-color); margin-bottom: 2rem;">
                        <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--text-main); margin-bottom: 1.5rem;">
                            Event Mendatang</h3>

                        @php
                            $upcomingEvents = \App\Models\Event::where('id', '!=', $event->id)
                                ->where('status', 'upcoming')
                                ->orderBy('start_date', 'asc')
                                ->take(5)
                                ->get();
                        @endphp

                        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                            @forelse($upcomingEvents as $upcomingEvent)
                                <a href="{{ route('event.show', $upcomingEvent->slug) }}"
                                    style="text-decoration: none; color: inherit; display: flex; gap: 1rem; transition: transform 0.2s;"
                                    onmouseover="this.style.transform='translateX(5px)'"
                                    onmouseout="this.style.transform='translateX(0)'">
                                    @if ($upcomingEvent->image_url)
                                        <img src="{{ $upcomingEvent->image_url }}" alt="{{ $upcomingEvent->title }}"
                                            style="width: 80px; height: 80px; object-fit: cover; border-radius: var(--border-radius); flex-shrink: 0;">
                                    @else
                                        <div
                                            style="width: 80px; height: 80px; background: var(--primary-blue); border-radius: var(--border-radius); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                            <i class="fas fa-calendar-alt" style="font-size: 1.5rem; color: white;"></i>
                                        </div>
                                    @endif
                                    <div style="flex: 1; min-width: 0;">
                                        <h4
                                            style="font-size: 0.95rem; font-weight: 600; color: var(--text-main); margin-bottom: 0.5rem; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                            {{ $upcomingEvent->title }}
                                        </h4>
                                        <p
                                            style="font-size: 0.8rem; color: var(--text-muted); display: flex; align-items: center; gap: 0.5rem; margin: 0;">
                                            <i class="fas fa-calendar" style="font-size: 0.7rem;"></i>
                                            {{ optional($upcomingEvent->start_date)->format('d M Y') }}
                                        </p>
                                    </div>
                                </a>
                            @empty
                                <p style="color: var(--text-muted); font-size: 0.9rem; text-align: center;">Tidak ada event
                                    mendatang lainnya</p>
                            @endforelse
                        </div>
                    </div>

                    {{-- Categories --}}
                    @php
                        $categories = \App\Models\Event::select('category')
                            ->distinct()
                            ->whereNotNull('category')
                            ->where('category', '!=', '')
                            ->pluck('category');
                    @endphp

                    @if ($categories->count() > 0)
                        <div
                            style="background: var(--bg-card); padding: 2rem; border-radius: var(--border-radius); border: 1px solid var(--border-color);">
                            <h3
                                style="font-size: 1.25rem; font-weight: 700; color: var(--text-main); margin-bottom: 1.5rem;">
                                Kategori</h3>

                            <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                                @foreach ($categories as $cat)
                                    <a href="{{ route('event.index', ['category' => $cat]) }}"
                                        style="padding: 0.75rem 1rem; background: white; border: 1px solid var(--border-color); border-radius: var(--border-radius); text-decoration: none; color: var(--text-main); font-weight: 500; transition: all 0.2s; display: flex; align-items: center; justify-content: space-between;"
                                        onmouseover="this.style.background='var(--primary-blue)'; this.style.color='white'; this.style.borderColor='var(--primary-blue)'"
                                        onmouseout="this.style.background='white'; this.style.color='var(--text-main)'; this.style.borderColor='var(--border-color)'">
                                        {{ $cat }}
                                        <i class="fas fa-arrow-right" style="font-size: 0.8rem;"></i>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
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

            article img[style*="height: 450px"] {
                height: 250px !important;
            }
        }
    </style>
@endpush
