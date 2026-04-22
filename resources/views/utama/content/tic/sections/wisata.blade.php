@if (isset($objekWisataList) && $objekWisataList->count() > 0)
    <div class="category-section" style="margin-bottom: 5rem;">
        <div
            style="display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 3px solid var(--accent-green);">
            <i class="fas fa-map-marked-alt" style="font-size: 1.75rem; color: var(--accent-green);"></i>
            <h3 class="mobile:text-lg" style="font-size: 1.75rem; font-weight: 700; color: var(--text-main); margin: 0;">
                Obyek Wisata</h3>
            <span class="mobile:text-sm"
                style="background: var(--accent-green); color: white; padding: 0.25rem 0.75rem; border-radius: 2rem; font-size: 0.875rem; font-weight: 600;">
                {{ $objekWisataList->count() }} Tempat
            </span>
        </div>

        <div class="news-grid"
            style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
            @foreach ($objekWisataList->take(8) as $dest)
                <article class="news-card search-item" data-category="wisata" data-title="{{ strtolower($dest->nama) }}"
                    data-desc="{{ strtolower(strip_tags($dest->deskripsi ?? '')) }}">
                    <img src="{{ $resolveImage($dest) }}" alt="{{ $dest->nama }}" class="news-img">
                    <div class="news-content">
                        <span class="news-meta mobile:text-xs"
                            style="color: var(--accent-green-hover);">{{ $dest->kota ?? ($dest->alamat ?? 'Lokasi') }}</span>
                        <h3 class="news-title">{{ $dest->nama }}</h3>
                        <p class="mobile:text-sm"
                            style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">
                            {{ Str::limit(strip_tags($dest->deskripsi), 80) }}
                        </p>
                        <a href="{{ route('objek-wisata-detail', ['slug' => $dest->slug]) }}"
                            class="btn-link mobile:text-sm" style="color: var(--accent-green-hover);">Selengkapnya <i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                </article>
            @endforeach
        </div>

        @if ($objekWisataList->count() > 8)
            <div class="hidden-items-wisata" style="display: none;">
                <div class="news-grid"
                    style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem; margin-top: 1.5rem;">
                    @foreach ($objekWisataList->skip(8) as $dest)
                        <article class="news-card search-item" data-category="wisata"
                            data-title="{{ strtolower($dest->nama) }}"
                            data-desc="{{ strtolower(strip_tags($dest->deskripsi ?? '')) }}">
                            <img src="{{ $resolveImage($dest) }}" alt="{{ $dest->nama }}" class="news-img">
                            <div class="news-content">
                                <span class="news-meta mobile:text-xs"
                                    style="color: var(--accent-green-hover);">{{ $dest->kota ?? ($dest->alamat ?? 'Lokasi') }}</span>
                                <h3 class="news-title">{{ $dest->nama }}</h3>
                                <p class="mobile:text-sm"
                                    style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">
                                    {{ Str::limit(strip_tags($dest->deskripsi), 80) }}
                                </p>
                                <a href="{{ route('objek-wisata-detail', $dest->slug) }}"
                                    class="btn-link mobile:text-sm"
                                    style="color: var(--accent-green-hover);">Selengkapnya <i
                                        class="fas fa-arrow-right"></i></a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>

            <div style="text-align: center; margin-top: 2rem;">
                <button class="show-more-btn mobile:text-sm" data-target="hidden-items-wisata"
                    style="padding: 0.875rem 2rem; background: var(--accent-green); color: white; border: none; border-radius: 2rem; cursor: pointer; font-weight: 600; font-size: 1rem; transition: all 0.3s; display: inline-flex; align-items: center; gap: 0.5rem;">
                    <i class="fas fa-chevron-down"></i>
                    Tampilkan Lebih Banyak ({{ $objekWisataList->count() - 8 }} wisata)
                </button>
            </div>
        @endif
    </div>
@endif
