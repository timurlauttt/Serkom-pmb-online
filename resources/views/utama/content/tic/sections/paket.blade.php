@if (isset($paketWisataList) && $paketWisataList->count() > 0)
    <div class="category-section" style="margin-bottom: 5rem;">
        <div
            style="display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 3px solid var(--highlight-yellow);">
            <i class="fas fa-suitcase" style="font-size: 1.75rem; color: var(--highlight-yellow);"></i>
            <h3 style="font-size: 1.75rem; font-weight: 700; color: var(--text-main); margin: 0;">Paket Wisata</h3>
            <span
                style="background: var(--highlight-yellow); color: white; padding: 0.25rem 0.75rem; border-radius: 2rem; font-size: 0.875rem; font-weight: 600;">
                {{ $paketWisataList->count() }} Paket
            </span>
        </div>

        <div class="news-grid"
            style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
            @foreach ($paketWisataList->take(8) as $pw)
                <article class="news-card search-item" data-category="paket"
                    data-title="{{ strtolower($pw->nama_paket) }}"
                    data-desc="{{ strtolower(strip_tags($pw->keterangan ?? '')) }}">
                    <img src="{{ $resolveImage($pw) }}" alt="{{ $pw->nama_paket }}" class="news-img">
                    <div class="news-content">
                        <div
                            style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem; flex-wrap: wrap;">
                            @if ($pw->kategori)
                                <span
                                    style="background: var(--primary-blue); color: white; padding: 0.25rem 0.75rem; border-radius: 1rem; font-size: 0.75rem; font-weight: 600;">
                                    <i class="fas fa-tag"></i> {{ $pw->kategori }}
                                </span>
                            @endif
                            <span class="news-meta"
                                style="color: var(--highlight-yellow-hover);">{{ $pw->durasi_hari ? $pw->durasi_hari . ' Hari' : '-' }}</span>
                        </div>
                        <h3 class="news-title">{{ $pw->nama_paket }}</h3>
                        <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">
                            {{ Str::limit(strip_tags($pw->keterangan), 80) }}
                        </p>
                        <a href="{{ route('paket-wisata-detail', ['slug' => $pw->slug]) }}" class="btn-link"
                            style="color: var(--highlight-yellow-hover);">Detail Paket <i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                </article>
            @endforeach
        </div>

        @if ($paketWisataList->count() > 8)
            <div class="hidden-items-paket" style="display: none;">
                <div class="news-grid"
                    style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem; margin-top: 1.5rem;">
                    @foreach ($paketWisataList->skip(8) as $pw)
                        <article class="news-card search-item" data-category="paket"
                            data-title="{{ strtolower($pw->nama_paket) }}"
                            data-desc="{{ strtolower(strip_tags($pw->keterangan ?? '')) }}">
                            <img src="{{ $resolveImage($pw) }}" alt="{{ $pw->nama_paket }}" class="news-img">
                            <div class="news-content">
                                <div
                                    style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem; flex-wrap: wrap;">
                                    @if ($pw->kategori)
                                        <span
                                            style="background: var(--primary-blue); color: white; padding: 0.25rem 0.75rem; border-radius: 1rem; font-size: 0.75rem; font-weight: 600;">
                                            <i class="fas fa-tag"></i> {{ $pw->kategori }}
                                        </span>
                                    @endif
                                    <span class="news-meta"
                                        style="color: var(--highlight-yellow-hover);">{{ $pw->durasi_hari ? $pw->durasi_hari . ' Hari' : '-' }}</span>
                                </div>
                                <h3 class="news-title">{{ $pw->nama_paket }}</h3>
                                <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">
                                    {{ Str::limit(strip_tags($pw->keterangan), 80) }}
                                </p>
                                <a href="{{ route('paket-wisata-detail', $pw->slug) }}" class="btn-link"
                                    style="color: var(--highlight-yellow-hover);">Detail Paket <i
                                        class="fas fa-arrow-right"></i></a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>

            <div style="text-align: center; margin-top: 2rem;">
                <button class="show-more-btn" data-target="hidden-items-paket"
                    style="padding: 0.875rem 2rem; background: var(--highlight-yellow); color: white; border: none; border-radius: 2rem; cursor: pointer; font-weight: 600; font-size: 1rem; transition: all 0.3s; display: inline-flex; align-items: center; gap: 0.5rem;">
                    <i class="fas fa-chevron-down"></i>
                    Tampilkan Lebih Banyak ({{ $paketWisataList->count() - 8 }} paket)
                </button>
            </div>
        @endif
    </div>
@endif
