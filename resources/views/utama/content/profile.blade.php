@extends('utama.layouts.app')

@section('title', 'Tentang Kami - SMK Tamansiswa Purwokerto')

@section('content')

    <!-- Page Header -->
    <section
        style="background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white; padding: 3rem 0; margin-top: 80px;">
        <div class="container" style="text-align: center;">
            <h1 style="font-size: 2.5rem; margin-bottom: 1rem; color: white; line-height: 1.3;">
                Tentang SMK<br>
                Taman Siswa Purwokerto
            </h1>
            <img src="{{ asset('images/logo.png') }}" alt="Logo SMK Tamansiswa"
                style="width: 120px; height: 120px; object-fit: contain; display: block; margin: 0 auto;">
        </div>
    </section>

    <!-- Main Content -->
    <div class="container" style="padding: 3rem 0;">

        <!-- Sejarah -->
        <section style="margin-bottom: 3rem;">
            <h2
                style="font-size: 1.8rem; margin-bottom: 1.5rem; color: var(--text-main); padding-bottom: 0.5rem; display: inline-block;">
                Sejarah
            </h2>

            <div style="background: white; padding: 2rem; box-shadow: var(--shadow-sm); margin-top: 1.5rem;">
                @if ($profile->history)
                    <p style="line-height: 1.8; color: var(--text-main);">{!! nl2br(e($profile->history)) !!}</p>
                @else
                    <p style="color: var(--text-muted); text-align: center;">Sejarah sekolah akan segera ditambahkan.</p>
                @endif
            </div>
        </section>

        <!-- Visi & Misi -->
        <section style="margin-bottom: 3rem;">
            <h2
                style="font-size: 1.8rem; margin-bottom: 1.5rem; color: var(--text-main);   padding-bottom: 0.5rem; display: inline-block;">
                Visi & Misi
            </h2>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-top: 1.5rem;">
                <!-- Visi -->
                <div
                    style="background: white; padding: 2rem; border-left: 4px solid var(--primary-blue); box-shadow: var(--shadow-sm);">
                    <h3 style="color: var(--primary-blue); margin-bottom: 1rem; font-size: 1.3rem;">Visi</h3>
                    <div style="line-height: 2; color: var(--text-main);">
                        @if ($profile->vision)
                            {!! nl2br(e($profile->vision)) !!}
                        @else
                            <p>Menjadi Sekolah Menengah Kejuruan yang unggul dalam menghasilkan lulusan yang kompeten,
                                berkarakter, dan berdaya saing global.</p>
                        @endif
                    </div>
                </div>

                <!-- Misi -->
                <div
                    style="background: white; padding: 2rem; border-left: 4px solid var(--accent-green); box-shadow: var(--shadow-sm);">
                    <h3 style="color: var(--accent-green); margin-bottom: 1rem; font-size: 1.3rem;">Misi</h3>
                    @if (is_array($profile->mission) && count($profile->mission) > 0)
                        <ol style="padding-left: 1.2rem; line-height: 1.8; color: var(--text-main);">
                            @foreach ($profile->mission as $misi)
                                <li style="margin-bottom: 0.5rem;">{{ $misi }}</li>
                            @endforeach
                        </ol>
                    @else
                        <p style="color: var(--text-muted);">Misi sekolah belum tersedia.</p>
                    @endif
                </div>
            </div>
        </section>

        <!-- Akreditasi & Fasilitas -->
        <section style="margin-bottom: 3rem;">
            <h2
                style="font-size: 1.8rem; margin-bottom: 1.5rem; color: var(--text-main);   padding-bottom: 0.5rem; display: inline-block;">
                Akreditasi & Fasilitas
            </h2>

            <!-- Akreditasi -->
            <div
                style="background: white; padding: 1.5rem; box-shadow: var(--shadow-sm); margin-top: 1.5rem; margin-bottom: 1.5rem;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="color: var(--accent-green); font-size: 3rem; font-weight: bold;">
                        {{ $profile->accreditation ?? 'A' }}
                    </div>
                    <div>
                        <p style="font-weight: 600; color: var(--text-main); margin-bottom: 0.25rem;">Akreditasi Sekolah</p>
                        <p style="color: var(--text-muted); font-size: 0.9rem;">Badan Akreditasi Nasional Sekolah/Madrasah
                        </p>
                    </div>
                </div>
            </div>

            <!-- Fasilitas -->
            @if (is_array($profile->facilities) && count($profile->facilities) > 0)
                <div style="background: white; padding: 1.5rem; box-shadow: var(--shadow-sm);">
                    <p style="font-weight: 600; color: var(--text-main); margin-bottom: 1rem;">Fasilitas Sekolah:</p>
                    <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                        @foreach ($profile->facilities as $fasilitas)
                            <span
                                style="background: linear-gradient(135deg, var(--primary-blue), #1976d2); color: white; padding: 0.5rem 1rem; border-radius: 20px; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                <i class="fas fa-check-circle"></i>
                                @if (is_array($fasilitas) && isset($fasilitas['name']))
                                    {{ $fasilitas['name'] }}
                                @elseif(is_object($fasilitas) && isset($fasilitas->name))
                                    {{ $fasilitas->name }}
                                @else
                                    {{ is_string($fasilitas) ? $fasilitas : 'Fasilitas' }}
                                @endif
                            </span>
                        @endforeach
                    </div>
                </div>
            @else
                <div style="background: white; padding: 2rem; box-shadow: var(--shadow-sm); text-align: center;">
                    <i class="fas fa-building"
                        style="font-size: 2.5rem; color: var(--text-muted); margin-bottom: 1rem;"></i>
                    <p style="color: var(--text-muted);">Data fasilitas akan segera ditambahkan.</p>
                </div>
            @endif
        </section>

        <!-- Struktur Organisasi -->
        <section style="margin-bottom: 3rem;">
            <h2
                style="font-size: 1.8rem; margin-bottom: 1.5rem; color: var(--text-main);   padding-bottom: 0.5rem; display: inline-block;">
                Struktur Organisasi
            </h2>

            @if ($profile->org_chart_path)
                <div style="background: white; padding: 2rem; box-shadow: var(--shadow-sm); margin-top: 1.5rem;">
                    <img src="{{ asset($profile->org_chart_path) }}" alt="Struktur Organisasi"
                        style="max-width: 100%; height: auto;">
                </div>
            @else
                <div
                    style="background: white; padding: 3rem; box-shadow: var(--shadow-sm); text-align: center; margin-top: 1.5rem;">
                    <i class="fas fa-sitemap" style="font-size: 3rem; color: var(--text-muted); margin-bottom: 1rem;"></i>
                    <p style="color: var(--text-muted);">Struktur organisasi akan segera ditambahkan.</p>
                </div>
            @endif
        </section>

    </div>

@endsection

@push('styles')
    <style>
        @media (max-width: 768px) {

            /* Header adjustments */
            section[style*="margin-top: 80px"] {
                padding: 2rem 0 !important;
            }

            section[style*="margin-top: 80px"] h1 {
                font-size: 1.5rem !important;
            }

            section[style*="margin-top: 80px"] img {
                width: 80px !important;
                height: 80px !important;
            }

            /* Container padding */
            .container {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }

            /* Section headings */
            .container>section h2 {
                font-size: 1.3rem !important;
            }

            /* Visi & Misi grid */
            div[style*="grid-template-columns: 1fr 1fr"] {
                grid-template-columns: 1fr !important;
            }

            /* Akreditasi layout */
            div[style*="display: flex"][style*="align-items: center"] {
                flex-direction: column !important;
                text-align: center !important;
            }

            div[style*="display: flex"][style*="align-items: center"]>div:first-child {
                margin-bottom: 0.5rem !important;
            }

            /* Badge fasilitas */
            div[style*="flex-wrap: wrap"] span {
                font-size: 0.8rem !important;
                padding: 0.4rem 0.8rem !important;
            }

            /* Reduce padding on white boxes */
            div[style*="background: white"][style*="padding: 2rem"] {
                padding: 1.25rem !important;
            }

            div[style*="background: white"][style*="padding: 1.5rem"] {
                padding: 1rem !important;
            }
        }
    </style>
@endpush
