@if (isset($restoranList) && $restoranList->count() > 0)
    <div class="category-section" style="margin-bottom: 5rem;">
        <div
            style="display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 3px solid var(--primary-blue);">
            <i class="fas fa-utensils" style="font-size: 1.75rem; color: var(--primary-blue);"></i>
            <h3 class="mobile:text-lg" style="font-size: 1.75rem; font-weight: 700; color: var(--text-main); margin: 0;">
                Restoran</h3>
            <span class="mobile:text-sm"
                style="background: var(--primary-blue); color: white; padding: 0.25rem 0.75rem; border-radius: 2rem; font-size: 0.875rem; font-weight: 600;">
                {{ $restoranList->count() }} Tempat
            </span>
        </div>

        <div class="news-grid"
            style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
            @foreach ($restoranList->take(8) as $resto)
                <article class="news-card search-item" data-category="restoran"
                    data-title="{{ strtolower($resto->nama) }}"
                    data-desc="{{ strtolower(strip_tags($resto->deskripsi ?? '')) }}">
                    <img src="{{ $resolveImage($resto) }}" alt="{{ $resto->nama }}" class="news-img">
                    <div class="news-content">
                        <span class="news-meta mobile:text-xs"
                            style="color: var(--primary-blue-hover);">{{ $resto->kota ?? 'Lokasi' }}</span>
                        <h3 class="news-title">{{ $resto->nama }}</h3>
                        <p class="mobile:text-sm"
                            style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">
                            {{ Str::limit(strip_tags($resto->deskripsi), 80) }}
                        </p>
                        <a href="{{ route('restoran-detail', ['slug' => $resto->slug]) }}"
                            class="btn-link mobile:text-sm" style="color: var(--primary-blue-hover);">Lihat Menu <i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                </article>
            @endforeach
        </div>

        @if ($restoranList->count() > 8)
            <div class="hidden-items-restoran" style="display: none;">
                <div class="news-grid"
                    style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem; margin-top: 1.5rem;">
                    @foreach ($restoranList->skip(8) as $resto)
                        <article class="news-card search-item" data-category="restoran"
                            data-title="{{ strtolower($resto->nama) }}"
                            data-desc="{{ strtolower(strip_tags($resto->deskripsi ?? '')) }}">
                            <img src="{{ $resolveImage($resto) }}" alt="{{ $resto->nama }}" class="news-img">
                            <div class="news-content">
                                <span class="news-meta mobile:text-xs"
                                    style="color: var(--primary-blue-hover);">{{ $resto->kota ?? 'Lokasi' }}</span>
                                <h3 class="news-title">{{ $resto->nama }}</h3>
                                <p class="mobile:text-sm"
                                    style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">
                                    {{ Str::limit(strip_tags($resto->deskripsi), 80) }}
                                </p>
                                <a href="{{ route('restoran-detail', $resto->slug) }}" class="btn-link mobile:text-sm"
                                    style="color: var(--primary-blue-hover);">Lihat Menu <i
                                        class="fas fa-arrow-right"></i></a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>

            <div style="text-align: center; margin-top: 2rem;">
                <button class="show-more-btn mobile:text-sm" data-target="hidden-items-restoran"
                    style="padding: 0.875rem 2rem; background: var(--primary-blue); color: white; border: none; border-radius: 2rem; cursor: pointer; font-weight: 600; font-size: 1rem; transition: all 0.3s; display: inline-flex; align-items: center; gap: 0.5rem;">
                    <i class="fas fa-chevron-down"></i>
                    Tampilkan Lebih Banyak ({{ $restoranList->count() - 8 }} restoran)
                </button>
            </div>
        @endif
    </div>
@endif
