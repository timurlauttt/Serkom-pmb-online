@if (isset($desaWisataList) && $desaWisataList->count() > 0)
    <div class="category-section" style="margin-bottom: 5rem;">
        <div
            style="display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 3px solid var(--accent-green);">
            <i class="fas fa-tree" style="font-size: 1.75rem; color: var(--accent-green);"></i>
            <h3 class="mobile:text-lg" style="font-size: 1.75rem; font-weight: 700; color: var(--text-main); margin: 0;">
                Desa Wisata</h3>
            <span class="mobile:text-sm"
                style="background: var(--accent-green); color: white; padding: 0.25rem 0.75rem; border-radius: 2rem; font-size: 0.875rem; font-weight: 600;">
                {{ $desaWisataList->count() }} Tempat
            </span>
        </div>

        <div class="news-grid"
            style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
            @foreach ($desaWisataList->take(8) as $desa)
                <article class="news-card search-item" data-category="desa" data-title="{{ strtolower($desa->nama) }}"
                    data-desc="{{ strtolower(strip_tags($desa->deskripsi ?? '')) }}">
                    <img src="{{ $resolveImage($desa) }}" alt="{{ $desa->nama }}" class="news-img">
                    <div class="news-content">
                        <span class="news-meta mobile:text-xs"
                            style="color: var(--accent-green-hover);">{{ $desa->kota ?? ($desa->alamat ?? 'Lokasi') }}</span>
                        <h3 class="news-title mobile:text-lg">{{ $desa->nama }}</h3>
                        <p class="mobile:text-sm"
                            style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">
                            {{ Str::limit(strip_tags($desa->deskripsi), 80) }}
                        </p>
                        <a href="{{ route('desa-wisata-detail', ['slug' => $desa->slug]) }}"
                            class="btn-link mobile:text-sm" style="color: var(--accent-green-hover);">Selengkapnya <i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                </article>
            @endforeach
        </div>

        @if ($desaWisataList->count() > 8)
            <div class="hidden-items-desa" style="display: none;">
                <div class="news-grid"
                    style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem; margin-top: 1.5rem;">
                    @foreach ($desaWisataList->skip(8) as $desa)
                        <article class="news-card search-item" data-category="desa"
                            data-title="{{ strtolower($desa->nama) }}"
                            data-desc="{{ strtolower(strip_tags($desa->deskripsi ?? '')) }}">
                            <img src="{{ $resolveImage($desa) }}" alt="{{ $desa->nama }}" class="news-img">
                            <div class="news-content">
                                <span class="news-meta mobile:text-xs"
                                    style="color: var(--accent-green-hover);">{{ $desa->kota ?? ($desa->alamat ?? 'Lokasi') }}</span>
                                <h3 class="news-title">{{ $desa->nama }}</h3>
                                <p class="mobile:text-sm"
                                    style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">
                                    {{ Str::limit(strip_tags($desa->deskripsi), 80) }}
                                </p>
                                <a href="{{ route('desa-wisata-detail', $desa->slug) }}"
                                    class="btn-link mobile:text-sm"
                                    style="color: var(--accent-green-hover);">Selengkapnya <i
                                        class="fas fa-arrow-right"></i></a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>

            <div style="text-align: center; margin-top: 2rem;">
                <button class="show-more-btn mobile:text-sm" data-target="hidden-items-desa"
                    style="padding: 0.875rem 2rem; background: var(--accent-green); color: white; border: none; border-radius: 2rem; cursor: pointer; font-weight: 600; font-size: 1rem; transition: all 0.3s; display: inline-flex; align-items: center; gap: 0.5rem;">
                    <i class="fas fa-chevron-down"></i>
                    Tampilkan Lebih Banyak ({{ $desaWisataList->count() - 8 }} desa)
                </button>
            </div>
        @endif
    </div>
@endif
