@extends('utama.layouts.app')
@section('title', 'Detail PPDB')

@push('styles')
    <style>
        .ppdb-header {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            color: white;
            padding: 3rem 0;
            margin-top: 80px;
            text-align: center;
        }

        /* PPDB CTA buttons wrapper */
        .ppdb-cta-wrapper {
            margin-top: 2rem;
            display: flex;
            gap: 1rem;
            justify-content: center;
            align-items: center;
        }

        .ppdb-cta-wrapper .btn-cta {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem 2.5rem;
            border-radius: 6px;
            text-decoration: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
            font-size: 1.05rem;
            font-weight: 600;
        }

        .ppdb-cta-wrapper .btn-cta.primary {
            background: #10b981;
            color: white;
        }

        .ppdb-cta-wrapper .btn-cta.secondary {
            background: white;
            color: var(--primary-blue);
        }

        .ppdb-header h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: white;
            line-height: 1.3;
        }

        .section-title {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            color: var(--text-main);
            padding-bottom: 0.5rem;
            display: inline-block;
        }

        .brosur-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 1.5rem;
        }

        .brosur-item {
            background: white;
            box-shadow: var(--shadow-sm);
            border-radius: 4px;
            overflow: hidden;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .brosur-item:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .brosur-preview {
            width: 100%;
            height: 320px;
            background: linear-gradient(135deg, #f5f5f5 0%, #e0e0e0 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 3px solid var(--primary-blue);
            position: relative;
            overflow: hidden;
        }

        .brosur-preview iframe {
            width: 100%;
            height: 100%;
            border: none;
            pointer-events: none;
        }

        .brosur-preview .pdf-icon {
            font-size: 4rem;
            color: #dc3545;
            opacity: 0.3;
        }

        .brosur-content {
            padding: 1.5rem;
        }

        .brosur-content h4 {
            font-size: 1.1rem;
            color: var(--text-main);
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .brosur-content .meta {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .btn-download {
            display: inline-block;
            background: var(--primary-blue);
            color: white;
            padding: 0.6rem 1.5rem;
            border-radius: 4px;
            text-decoration: none;
            font-size: 0.9rem;
            transition: background 0.2s ease;
        }

        .btn-download:hover {
            background: #1976d2;
            color: white;
        }

        .jalur-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
            gap: 2rem;
            margin-top: 1.5rem;
        }

        .jalur-item {
            background: white;
            padding: 2rem;
            border-left: 4px solid var(--accent-green);
            box-shadow: var(--shadow-sm);
            transition: transform 0.2s ease;
        }

        .jalur-item:hover {
            transform: translateX(4px);
        }

        .jalur-item h4 {
            color: var(--text-main);
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
        }

        .jalur-status {
            display: inline-block;
            background: var(--accent-green);
            color: white;
            padding: 0.3rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            margin-bottom: 1rem;
        }

        .jalur-info {
            color: var(--text-main);
            line-height: 1.8;
            margin-bottom: 1rem;
        }

        .jalur-meta {
            display: flex;
            gap: 2rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #e0e0e0;
        }

        .jalur-meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .jalur-meta-item i {
            color: var(--primary-blue);
        }

        .links-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .link-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--primary-blue);
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.2s ease;
        }

        .link-btn:hover {
            background: #1976d2;
            color: white;
        }

        .empty-state {
            background: white;
            padding: 3rem;
            text-align: center;
            box-shadow: var(--shadow-sm);
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.3;
        }

        @media (max-width: 768px) {
            .ppdb-header {
                padding: 2rem 0;
            }

            .ppdb-header h1 {
                font-size: 1.8rem;
            }

            .section-title {
                font-size: 1.5rem;
            }

            .container {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }

            .brosur-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            /* Make CTA buttons vertical and equal width on mobile */
            .ppdb-cta-wrapper {
                flex-direction: column;
                gap: 0.75rem;
            }

            .ppdb-cta-wrapper .btn-cta {
                width: min(380px, 100%);
                max-width: 100%;
                padding: 0.9rem 1.25rem;
                font-size: 1rem;
                justify-content: center;
            }

            .brosur-preview {
                height: 250px;
            }

            .jalur-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .jalur-item {
                padding: 1.5rem;
            }

            .jalur-meta {
                flex-direction: column;
                gap: 0.5rem;
            }

            .links-grid {
                flex-direction: column;
            }

            .link-btn {
                width: 100%;
                justify-content: space-between;
            }

            .empty-state {
                padding: 2rem 1rem;
            }
        }

        @media (max-width: 480px) {
            .ppdb-header h1 {
                font-size: 1.5rem;
            }

            .section-title {
                font-size: 1.3rem;
            }

            .brosur-content {
                padding: 1rem;
            }

            .brosur-content h4 {
                font-size: 1rem;
            }

            .jalur-item h4 {
                font-size: 1.1rem;
            }

            .btn-download {
                width: 100%;
                text-align: center;
            }
        }
    </style>
@endpush

@section('content')
    <!-- Page Header -->
    <section class="ppdb-header">
        <div class="container">
            <h1 class="mobile:text-lg">Informasi Lengkap PPDB</h1>
            <p class="mobile:text-sm" style="font-size: 1.1rem; opacity: 0.95; margin: 1rem 0;">
                Brosur, jalur pendaftaran yang sedang dibuka, dan link pendaftaran
            </p>
            <div class="ppdb-cta-wrapper">
                <a href="{{ route('pendaftaran.siswa.login') }}" class="btn-cta primary">
                    <i class="fas fa-edit" aria-hidden="true"></i>
                    <span>Daftar Sekarang</span>
                </a>
                <a href="{{ route('pendaftaran.siswa.login') }}" class="btn-cta secondary">
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <span>Cek Status Pendaftaran</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container" style="padding: 3rem 0;">


        <!-- Brosur Section -->
        <section style="margin-bottom: 3rem;">
            <h2 class="section-title">Brosur PPDB</h2>

            @if (isset($brosurs) && $brosurs->count())
                <div class="brosur-grid">
                    @foreach ($brosurs as $brosur)
                        <div class="brosur-item">
                            <div class="brosur-preview">
                                @if ($brosur->path_gambar_brosur)
                                    <img src="{{ asset($brosur->path_gambar_brosur) }}" alt="{{ $brosur->judul }}"
                                        style="width: 100%; height: 100%; object-fit: contain;">
                                @elseif($brosur->file_path)
                                    <iframe src="{{ asset($brosur->file_path) }}#view=FitH&toolbar=0&navpanes=0"
                                        title="{{ $brosur->judul }}"></iframe>
                                @else
                                    <i class="fas fa-file-pdf pdf-icon"></i>
                                @endif
                            </div>
                            <div class="brosur-content">
                                <h4>{{ $brosur->judul }}</h4>
                                <div class="meta">
                                    <i class="fas fa-calendar-alt"></i> {{ $brosur->tahun_ajaran }}
                                    @if ($brosur->deskripsi)
                                        <br>{{ Str::limit($brosur->deskripsi, 80) }}
                                    @endif
                                </div>
                                <a href="{{ asset($brosur->file_path) }}" download class="btn-download">
                                    <i class="fas fa-download"></i> Download PDF
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-file-pdf"></i>
                    <p>Brosur PPDB akan segera tersedia</p>
                </div>
            @endif
        </section>


        <!-- Jalur Pendaftaran Section -->
        <section style="margin-bottom: 3rem;">
            <h2 class="section-title">Jalur yang Sedang Dibuka</h2>

            @php
                $now = \Carbon\Carbon::now();
                $openJalurs = collect();
                if (isset($jalurs)) {
                    $openJalurs = $jalurs->filter(
                        fn($j) => \Illuminate\Support\Carbon::parse($j->tanggal_mulai)->startOfDay() <= $now &&
                            \Illuminate\Support\Carbon::parse($j->tanggal_selesai)->endOfDay() >= $now &&
                            $j->is_active,
                    );
                }
            @endphp

            @if ($openJalurs->count())
                <div class="jalur-grid">
                    @foreach ($openJalurs as $jalur)
                        <div class="jalur-item">
                            <span class="jalur-status">
                                <i class="fas fa-check-circle"></i> Sedang Dibuka
                            </span>
                            <h4>{{ $jalur->nama_jalur }}</h4>
                            @if ($jalur->deskripsi)
                                <p class="jalur-info">{{ $jalur->deskripsi }}</p>
                            @endif
                            <div class="jalur-meta">
                                <div class="jalur-meta-item">
                                    <i class="fas fa-calendar"></i>
                                    <span>{{ \Carbon\Carbon::parse($jalur->tanggal_mulai)->format('d M Y') }} -
                                        {{ \Carbon\Carbon::parse($jalur->tanggal_selesai)->format('d M Y') }}</span>
                                </div>
                                @if ($jalur->kuota)
                                    <div class="jalur-meta-item">
                                        <i class="fas fa-users"></i>
                                        <span>Kuota: {{ $jalur->kuota }} siswa</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-door-closed"></i>
                    <p>Saat ini tidak ada jalur pendaftaran yang sedang dibuka</p>
                </div>
            @endif
        </section>


        <!-- Link Pendaftaran Section -->
        <section style="margin-bottom: 3rem;">
            <h2 class="section-title">Tautan Pendaftaran</h2>

            @if (isset($links) && $links->where('jenis', 'pendaftaran')->count())
                <div class="links-grid">
                    @foreach ($links->where('jenis', 'pendaftaran') as $link)
                        <a href="{{ $link->url }}" target="_blank" class="link-btn">
                            <i class="fas fa-edit"></i>
                            <span>{{ $link->nama_link }}</span>
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    @endforeach
                </div>
                @elseb
                <div class="empty-state">
                    <i class="fas fa-link"></i>
                    <p>Tautan pendaftaran akan tersedia saat jalur pendaftaran dibuka</p>
                </div>
            @endif
        </section>

    </div>
@endsection
