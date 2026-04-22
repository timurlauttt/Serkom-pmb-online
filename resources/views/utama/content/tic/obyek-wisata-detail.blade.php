@extends('utama.layouts.app')
@section('title', $objekWisata->nama . ' - Objek Wisata TIC SMK Taman Siswa Purwokerto')

@section('content')

<section class="section-padding" style="margin-top: 80px;">
    <div class="container" style="max-width: 1200px;">
        {{-- Breadcrumb --}}
        <p style="margin-bottom: 2rem; color: var(--text-muted);">
            <a href="{{ route('landingpage') }}">Beranda</a> / 
            <a href="{{ route('tic.index') }}">TIC</a> / 
            <a href="{{ route('tic.index') }}#objek-wisata">Objek Wisata</a> / 
            {{ Str::limit($objekWisata->nama, 50) }}
        </p>

        <div style="display: grid; grid-template-columns: 1fr 350px; gap: 3rem;">
            {{-- Main Content --}}
            <article>
                {{-- Title --}}
                <h1 style="font-size: 2.25rem; font-weight: 700; color: var(--text-main); margin-bottom: 1.5rem; line-height: 1.3;">
                    {{ $objekWisata->nama }}
                </h1>

                {{-- Meta Information --}}
                <div style="display: flex; flex-wrap: wrap; gap: 1rem; margin-bottom: 2rem; padding-bottom: 1.5rem; border-bottom: 2px solid var(--border-color); align-items: center;">
                    <span style="background: var(--primary-blue); color: white; padding: 0.5rem 1.25rem; border-radius: 2rem; font-size: 0.875rem; font-weight: 500; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-landmark"></i> Objek Wisata
                    </span>
                    
                    @if($objekWisata->kota)
                        <span style="color: var(--text-muted); display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem;">
                            <i class="fas fa-map-marker-alt" style="color: var(--primary-blue);"></i> 
                            {{ $objekWisata->kota }}
                        </span>
                    @endif

                    @if($objekWisata->jam_operasional)
                        <span style="color: var(--text-muted); display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem;">
                            <i class="fas fa-clock" style="color: var(--accent-green);"></i> 
                            {{ $objekWisata->jam_operasional }}
                        </span>
                    @endif

                    @if($objekWisata->harga_tiket)
                        <span style="background: #ffc107; color: #333; padding: 0.5rem 1rem; border-radius: 2rem; font-size: 0.875rem; font-weight: 500; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fas fa-ticket-alt"></i> Rp {{ number_format($objekWisata->harga_tiket, 0, ',', '.') }}
                        </span>
                    @endif
                </div>

                {{-- Featured Image --}}
                @if($objekWisata->gambar)
                    <img src="{{ asset($objekWisata->gambar) }}" alt="{{ $objekWisata->nama }}" 
                         style="width: 100%; height: 450px; object-fit: cover; border-radius: var(--border-radius); margin-bottom: 2.5rem;">
                @endif

                {{-- Description --}}
                @if($objekWisata->deskripsi)
                    <div style="background: var(--bg-card); padding: 2rem; border-radius: var(--border-radius); margin-bottom: 2rem; border: 1px solid var(--border-color);">
                        <h3 style="font-size: 1.5rem; font-weight: 700; color: var(--text-main); margin-bottom: 1.5rem;">
                            <i class="fas fa-info-circle" style="color: var(--primary-blue);"></i> Deskripsi
                        </h3>
                        <div class="content-article" style="line-height: 1.8; font-size: 1.05rem; color: var(--text-main);">
                            {!! nl2br(e($objekWisata->deskripsi)) !!}
                        </div>
                    </div>
                @endif

                {{-- Location Information --}}
                @if($objekWisata->alamat)
                    <div style="background: var(--bg-card); padding: 2rem; border-radius: var(--border-radius); margin-bottom: 2rem; border: 1px solid var(--border-color);">
                        <h3 style="font-size: 1.5rem; font-weight: 700; color: var(--text-main); margin-bottom: 1.5rem;">
                            <i class="fas fa-location-arrow" style="color: var(--primary-blue);"></i> Lokasi
                        </h3>
                        <p style="line-height: 1.8; font-size: 1.05rem; color: var(--text-main); margin: 0;">
                            <i class="fas fa-map-marker-alt" style="color: var(--accent-green); margin-right: 0.5rem;"></i>
                            {{ $objekWisata->alamat }}
                        </p>
                    </div>
                @endif

                {{-- Share Buttons --}}
                <div style="margin-top: 2.5rem; padding-top: 2rem; border-top: 1px solid var(--border-color);">
                    <h5 style="margin-bottom: 1rem; color: var(--text-main); font-weight: 600;">Bagikan:</h5>
                    <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" 
                           style="padding: 0.75rem 1.5rem; background: #3b5998; color: white; border-radius: var(--border-radius); text-decoration: none; display: flex; align-items: center; gap: 0.5rem; font-weight: 500; transition: transform 0.2s;"
                           onmouseover="this.style.transform='translateY(-2px)'"
                           onmouseout="this.style.transform='translateY(0)'">
                            <i class="fab fa-facebook"></i> Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($objekWisata->nama) }}" target="_blank"
                           style="padding: 0.75rem 1.5rem; background: #1da1f2; color: white; border-radius: var(--border-radius); text-decoration: none; display: flex; align-items: center; gap: 0.5rem; font-weight: 500; transition: transform 0.2s;"
                           onmouseover="this.style.transform='translateY(-2px)'"
                           onmouseout="this.style.transform='translateY(0)'">
                            <i class="fab fa-twitter"></i> Twitter
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($objekWisata->nama . ' ' . url()->current()) }}" target="_blank"
                           style="padding: 0.75rem 1.5rem; background: #25d366; color: white; border-radius: var(--border-radius); text-decoration: none; display: flex; align-items: center; gap: 0.5rem; font-weight: 500; transition: transform 0.2s;"
                           onmouseover="this.style.transform='translateY(-2px)'"
                           onmouseout="this.style.transform='translateY(0)'">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                    </div>
                </div>

                {{-- Navigation --}}
                <div style="margin-top: 3rem;">
                    <a href="{{ route('tic.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali ke TIC
                    </a>
                </div>
            </article>

            {{-- Sidebar --}}
            <aside>
                {{-- Quick Info Card --}}
                <div style="background: var(--bg-card); padding: 2rem; border-radius: var(--border-radius); border: 1px solid var(--border-color); margin-bottom: 2rem;">
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--text-main); margin-bottom: 1.5rem;">Informasi Cepat</h3>
                    
                    <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                        @if($objekWisata->kota)
                            <div style="display: flex; gap: 1rem; align-items: start;">
                                <div style="width: 40px; height: 40px; background: var(--primary-blue); border-radius: var(--border-radius); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fas fa-city" style="color: white;"></i>
                                </div>
                                <div>
                                    <p style="font-size: 0.85rem; color: var(--text-muted); margin: 0 0 0.25rem 0;">Kota</p>
                                    <p style="font-size: 0.95rem; font-weight: 600; color: var(--text-main); margin: 0;">{{ $objekWisata->kota }}</p>
                                </div>
                            </div>
                        @endif

                        @if($objekWisata->jam_operasional)
                            <div style="display: flex; gap: 1rem; align-items: start;">
                                <div style="width: 40px; height: 40px; background: var(--accent-green); border-radius: var(--border-radius); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fas fa-clock" style="color: white;"></i>
                                </div>
                                <div>
                                    <p style="font-size: 0.85rem; color: var(--text-muted); margin: 0 0 0.25rem 0;">Jam Operasional</p>
                                    <p style="font-size: 0.95rem; font-weight: 600; color: var(--text-main); margin: 0;">{{ $objekWisata->jam_operasional }}</p>
                                </div>
                            </div>
                        @endif

                        @if($objekWisata->harga_tiket)
                            <div style="display: flex; gap: 1rem; align-items: start;">
                                <div style="width: 40px; height: 40px; background: #ffc107; border-radius: var(--border-radius); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fas fa-ticket-alt" style="color: white;"></i>
                                </div>
                                <div>
                                    <p style="font-size: 0.85rem; color: var(--text-muted); margin: 0 0 0.25rem 0;">Harga Tiket</p>
                                    <p style="font-size: 0.95rem; font-weight: 600; color: var(--text-main); margin: 0;">Rp {{ number_format($objekWisata->harga_tiket, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endif

                        @if($objekWisata->alamat)
                            <div style="display: flex; gap: 1rem; align-items: start;">
                                <div style="width: 40px; height: 40px; background: #28a745; border-radius: var(--border-radius); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fas fa-map-marker-alt" style="color: white;"></i>
                                </div>
                                <div>
                                    <p style="font-size: 0.85rem; color: var(--text-muted); margin: 0 0 0.25rem 0;">Alamat</p>
                                    <p style="font-size: 0.95rem; font-weight: 600; color: var(--text-main); margin: 0; line-height: 1.5;">{{ $objekWisata->alamat }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Other Objek Wisata --}}
                @php
                    $otherObjekWisata = \App\Models\ObjekWisata::where('id', '!=', $objekWisata->id)
                        ->orderBy('nama', 'asc')
                        ->take(5)
                        ->get();
                @endphp

                @if($otherObjekWisata->count() > 0)
                    <div style="background: var(--bg-card); padding: 2rem; border-radius: var(--border-radius); border: 1px solid var(--border-color);">
                        <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--text-main); margin-bottom: 1.5rem;">Objek Wisata Lainnya</h3>
                        
                        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                            @foreach($otherObjekWisata as $other)
                                <a href="{{ route('objek-wisata-detail', $other->slug) }}" style="text-decoration: none; color: inherit; display: flex; gap: 1rem; transition: transform 0.2s;"
                                   onmouseover="this.style.transform='translateX(5px)'"
                                   onmouseout="this.style.transform='translateX(0)'">
                                    @if($other->gambar)
                                        <img src="{{ asset($other->gambar) }}" alt="{{ $other->nama }}"
                                             style="width: 80px; height: 80px; object-fit: cover; border-radius: var(--border-radius); flex-shrink: 0;">
                                    @else
                                        <div style="width: 80px; height: 80px; background: var(--primary-blue); border-radius: var(--border-radius); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                            <i class="fas fa-landmark" style="font-size: 1.5rem; color: white;"></i>
                                        </div>
                                    @endif
                                    <div style="flex: 1; min-width: 0;">
                                        <h4 style="font-size: 0.95rem; font-weight: 600; color: var(--text-main); margin-bottom: 0.5rem; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                            {{ $other->nama }}
                                        </h4>
                                        <p style="font-size: 0.8rem; color: var(--text-muted); display: flex; align-items: center; gap: 0.5rem; margin: 0;">
                                            <i class="fas fa-map-marker-alt" style="font-size: 0.7rem;"></i>
                                            {{ $other->kota ?? 'N/A' }}
                                        </p>
                                    </div>
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
    @media (max-width: 768px) {
        section.section-padding > div > div {
            grid-template-columns: 1fr !important;
        }
        
        aside {
            order: 2;
        }
        
        article {
            order: 1;
        }
    }
</style>
@endpush
