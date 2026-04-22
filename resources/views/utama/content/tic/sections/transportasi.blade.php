@if (isset($transportasiList) && $transportasiList->count() > 0)
    <div class="category-section" style="margin-bottom: 5rem;">
        <div
            style="display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 3px solid var(--highlight-yellow);">
            <i class="fas fa-bus" style="font-size: 1.75rem; color: var(--highlight-yellow);"></i>
            <h3 class="mobile:text-lg" style="font-size: 1.75rem; font-weight: 700; color: var(--text-main); margin: 0;">
                Transportasi</h3>
            <span class="mobile:text-sm"
                style="background: var(--highlight-yellow); color: white; padding: 0.25rem 0.75rem; border-radius: 2rem; font-size: 0.875rem; font-weight: 600;">
                {{ $transportasiList->count() }} Provider
            </span>
        </div>

        <div class="news-grid"
            style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
            @foreach ($transportasiList->take(8) as $tr)
                <article class="news-card search-item" data-category="transportasi"
                    data-title="{{ strtolower($tr->nama_provider) }}"
                    data-desc="{{ strtolower(strip_tags($tr->kontak ?? '')) }}">
                    <img src="{{ $resolveImage($tr) }}" alt="{{ $tr->nama_provider }}" class="news-img">
                    <div class="news-content">
                        <span class="news-meta mobile:text-xs"
                            style="color: var(--highlight-yellow-hover);">{{ $tr->jenis ?? 'Transportasi' }}</span>
                        <h3 class="news-title">{{ $tr->nama_provider }}</h3>
                        <p class="mobile:text-sm"
                            style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">
                            {{ Str::limit(strip_tags($tr->kontak), 80) }}
                        </p>
                        <a href="{{ route('transportasi-detail', ['slug' => $tr->slug]) }}"
                            class="btn-link mobile:text-sm" style="color: var(--highlight-yellow-hover);">Hubungi <i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                </article>
            @endforeach
        </div>

        @if ($transportasiList->count() > 8)
            <div class="hidden-items-transport" style="display: none;">
                <div class="news-grid"
                    style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem; margin-top: 1.5rem;">
                    @foreach ($transportasiList->skip(8) as $tr)
                        <article class="news-card search-item" data-category="transportasi"
                            data-title="{{ strtolower($tr->nama_provider) }}"
                            data-desc="{{ strtolower(strip_tags($tr->kontak ?? '')) }}">
                            <img src="{{ $resolveImage($tr) }}" alt="{{ $tr->nama_provider }}" class="news-img">
                            <div class="news-content">
                                <span class="news-meta mobile:text-xs"
                                    style="color: var(--highlight-yellow-hover);">{{ $tr->jenis ?? 'Transportasi' }}</span>
                                <h3 class="news-title">{{ $tr->nama_provider }}</h3>
                                <p class="mobile:text-sm"
                                    style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">
                                    {{ Str::limit(strip_tags($tr->kontak), 80) }}
                                </p>
                                <a href="{{ route('transportasi-detail', $tr->slug) }}" class="btn-link mobile:text-sm"
                                    style="color: var(--highlight-yellow-hover);">Hubungi <i
                                        class="fas fa-arrow-right"></i></a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>

            <div style="text-align: center; margin-top: 2rem;">
                <button class="show-more-btn mobile:text-sm" data-target="hidden-items-transport"
                    style="padding: 0.875rem 2rem; background: var(--highlight-yellow); color: white; border: none; border-radius: 2rem; cursor: pointer; font-weight: 600; font-size: 1rem; transition: all 0.3s; display: inline-flex; align-items: center; gap: 0.5rem;">
                    <i class="fas fa-chevron-down"></i>
                    Tampilkan Lebih Banyak ({{ $transportasiList->count() - 8 }} provider)
                </button>
            </div>
        @endif
    </div>
@endif
