@extends('utama.layouts.app')
@section('title', 'Ekstrakulikuler - SMK Taman Siswa Purwokerto')

@section('content')

    <section class="section-padding" style="margin-top: 80px;">
        <div class="container">
            {{-- Header --}}
            <h1 class="section-title mobile:text-3xl" style="margin-bottom: 0.5rem;">Ekstrakulikuler</h1>
            <p class="mobile:text-base" style="color: var(--text-muted); margin-bottom: 3rem; font-size: 1.05rem;">
                Berbagai kegiatan untuk mengembangkan minat dan bakat siswa di luar jam pelajaran akademik
            </p>

            {{-- Ekskul Grid --}}
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 2rem;">

                @forelse($ekstrakurikulers as $eskul)
                    <div class="eskul-card"
                        style="background: white; border-radius: 1rem; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: all 0.3s; height: 100%;">
                        <div
                            style="height: 180px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; position: relative;">
                            @if ($eskul->thumbnail)
                                <img src="{{ asset($eskul->thumbnail) }}" alt="{{ $eskul->nama }}"
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <i class="{{ $eskul->icon }}" style="font-size: 5rem; color: white; opacity: 0.9;"></i>
                            @endif
                        </div>
                        <div style="padding: 1.5rem;">
                            <h4 style="margin-bottom: 1rem; color: #333;">{{ $eskul->nama }}</h4>
                            <p style="color: #666; line-height: 1.6; margin-bottom: 1rem;">
                                {{ Str::limit($eskul->deskripsi, 150) }}
                            </p>
                            @if ($eskul->pembina)
                                <div
                                    style="margin-bottom: 1rem; padding: 0.75rem; background: #f8f9fa; border-radius: 0.5rem;">
                                    <small style="color: #666; display: block;"><i
                                            class="fas fa-user mr-2"></i><strong>Pembina:</strong>
                                        {{ $eskul->pembina }}</small>
                                    @if ($eskul->jadwal)
                                        <small style="color: #666; display: block; margin-top: 0.25rem;"><i
                                                class="fas fa-clock mr-2"></i><strong>Jadwal:</strong>
                                            {{ $eskul->jadwal }}</small>
                                    @endif
                                </div>
                            @endif
                            @php
                                $tags = $eskul->tags;
                                if (is_string($tags)) {
                                    $decoded = json_decode($tags, true);
                                    if (is_array($decoded)) {
                                        $tags = $decoded;
                                    } elseif (trim($tags) !== '') {
                                        // fallback: comma-separated string stored in DB
                                        $tags = array_filter(array_map('trim', explode(',', $tags)));
                                    } else {
                                        $tags = [];
                                    }
                                } elseif (is_null($tags)) {
                                    $tags = [];
                                }
                            @endphp

                            @if (count($tags) > 0)
                                <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                                    @foreach ($tags as $tag)
                                        <span
                                            style="background: #f0f0f0; padding: 0.25rem 0.75rem; border-radius: 1rem; font-size: 0.8rem; color: #666;">{{ $tag }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <i class="fas fa-users text-gray-300 text-5xl mb-4"></i>
                        <p class="text-gray-500">Belum ada data ekstrakurikuler</p>
                    </div>
                @endforelse

            </div>

            {{-- Benefits Section --}}
            <div style="margin-top: 4rem;">
                <h2 class="mobile:text-2xl"
                    style="text-align: center; margin-bottom: 2rem; color: var(--text-main); font-weight: 700; font-size: 1.75rem;">
                    Manfaat Mengikuti Ekstrakulikuler</h2>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
                    <div
                        style="text-align: center; padding: 2rem; background: var(--bg-card); border-radius: var(--border-radius); border: 1px solid var(--border-color);">
                        <div
                            style="width: 80px; height: 80px; background: var(--primary-blue); border-radius: 50%; margin: 0 auto 1.5rem; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-award" style="font-size: 2rem; color: white;"></i>
                        </div>
                        <h4 style="margin-bottom: 0.75rem; color: var(--text-main);">Prestasi</h4>
                        <p style="color: var(--text-muted); font-size: 0.95rem; line-height: 1.6;">Kesempatan meraih
                            prestasi tingkat regional dan nasional</p>
                    </div>

                    <div
                        style="text-align: center; padding: 2rem; background: var(--bg-card); border-radius: var(--border-radius); border: 1px solid var(--border-color);">
                        <div
                            style="width: 80px; height: 80px; background: var(--accent-green); border-radius: 50%; margin: 0 auto 1.5rem; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-users" style="font-size: 2rem; color: white;"></i>
                        </div>
                        <h4 style="margin-bottom: 0.75rem; color: var(--text-main);">Networking</h4>
                        <p style="color: var(--text-muted); font-size: 0.95rem; line-height: 1.6;">Membangun relasi dan
                            jaringan pertemanan</p>
                    </div>

                    <div
                        style="text-align: center; padding: 2rem; background: var(--bg-card); border-radius: var(--border-radius); border: 1px solid var(--border-color);">
                        <div
                            style="width: 80px; height: 80px; background: #f59e0b; border-radius: 50%; margin: 0 auto 1.5rem; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-brain" style="font-size: 2rem; color: white;"></i>
                        </div>
                        <h4 style="margin-bottom: 0.75rem; color: var(--text-main);">Soft Skills</h4>
                        <p style="color: var(--text-muted); font-size: 0.95rem; line-height: 1.6;">Mengembangkan leadership
                            dan teamwork</p>
                    </div>

                    <div
                        style="text-align: center; padding: 2rem; background: var(--bg-card); border-radius: var(--border-radius); border: 1px solid var(--border-color);">
                        <div
                            style="width: 80px; height: 80px; background: #ec4899; border-radius: 50%; margin: 0 auto 1.5rem; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-heart" style="font-size: 2rem; color: white;"></i>
                        </div>
                        <h4 style="margin-bottom: 0.75rem; color: var(--text-main);">Minat & Bakat</h4>
                        <p style="color: var(--text-muted); font-size: 0.95rem; line-height: 1.6;">Mengeksplorasi dan
                            mengembangkan potensi diri</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('styles')
    <style>
        .eskul-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15) !important;
        }

        @media (max-width: 768px) {
            .container>div[style*="grid-template-columns"] {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
@endpush
