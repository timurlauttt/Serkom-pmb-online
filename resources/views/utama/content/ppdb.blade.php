@extends('utama.layouts.app')
@section('title', 'PPDB SMK Taman Siswa Purwokerto')

@push('styles')
    <style>
        .ppdb-header {
            background: var(--primary-blue);
            color: white;
            padding: 3rem 0;
            margin-top: 80px;
            text-align: center;
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
            box-shadow: var(--shadow-sm);
            transition: transform 0.2s ease;
            position: relative;
        }

        .jalur-item.active {
            border-left: 4px solid var(--accent-green);
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
            padding: 0.3rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            margin-bottom: 1rem;
        }

        .jalur-status.open {
            background: var(--accent-green);
            color: white;
        }

        .jalur-status.closed {
            background: #f5f5f5;
            color: var(--text-muted);
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

        .link-item {
            background: white;
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
            border-radius: 4px;
            flex: 1;
            min-width: 250px;
            transition: transform 0.2s ease;
        }

        .link-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .link-item a {
            display: flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
            color: var(--text-main);
        }

        .link-icon {
            width: 50px;
            height: 50px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .link-icon.pendaftaran {
            background: #e8f5e9;
            color: var(--accent-green);
        }

        .link-icon.info {
            background: #e3f2fd;
            color: var(--primary-blue);
        }

        .cta-section {
            background: var(--primary-blue);
            color: white;
            padding: 3rem 2rem;
            text-align: center;
            margin-top: 3rem;
        }

        .cta-section h3 {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: white;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 2rem;
        }

        .cta-btn {
            padding: 0.8rem 2rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .cta-btn.primary {
            background: white;
            color: var(--primary-blue);
        }

        .cta-btn.primary:hover {
            background: #f5f5f5;
        }

        .cta-btn.outline {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .cta-btn.outline:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        @media (max-width: 768px) {
            .ppdb-header {
                padding: 2rem 0;
            }

            .ppdb-header h1 {
                font-size: 1.8rem;
            }

            .ppdb-header p {
                font-size: 1rem;
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

            .link-item {
                min-width: 100%;
            }

            .cta-section {
                padding: 2rem 1rem;
            }

            .cta-section h3 {
                font-size: 1.5rem;
            }

            .cta-buttons {
                flex-direction: column;
                width: 100%;
            }

            .cta-btn {
                width: 100%;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .ppdb-header h1 {
                font-size: 1.5rem;
            }

            .ppdb-header p {
                font-size: 0.9rem;
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

            .jalur-status {
                font-size: 0.75rem;
                padding: 0.25rem 0.75rem;
            }

            .btn-download {
                width: 100%;
                text-align: center;
            }

            .link-icon {
                width: 40px;
                height: 40px;
                font-size: 1.2rem;
            }

            .cta-section h3 {
                font-size: 1.3rem;
            }
        }
    </style>
@endpush

@section('content')
    <!-- Page Header -->
    <section class="ppdb-header">
        <div class="container">
            <h1>Penerimaan Peserta Didik Baru</h1>
            <p style="font-size: 1.1rem; opacity: 0.95; margin: 0;">
                Bergabunglah bersama keluarga besar SMK Taman Siswa Purwokerto
            </p>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container" style="padding: 3rem 0;">


        <!-- Brosur Section -->
        @if ($brosurs->count() > 0)
            <section style="margin-bottom: 3rem;">
                <h2 class="section-title">Brosur PPDB</h2>

                <div class="brosur-grid">
                    @foreach ($brosurs as $brosur)
                        <div class="brosur-item">
                            <div class="brosur-preview">
                                @if ($brosur->path_gambar_brosur)
                                    <img src="{{ asset($brosur->path_gambar_brosur) }}" alt="{{ $brosur->judul }}"
                                        style="width: 100%; height: 100%; object-fit: contain;">
                                @elseif ($brosur->file_path)
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
            </section>
        @endif


        <!-- Jalur Pendaftaran Section -->
        @if ($jalurs->count() > 0)
            <section style="margin-bottom: 3rem;">
                <h2 class="section-title">Jalur Pendaftaran</h2>

                <div class="jalur-grid">
                    @foreach ($jalurs as $jalur)
                        <div class="jalur-item {{ $jalur->isOpen() ? 'active' : '' }}">
                            <span class="jalur-status {{ $jalur->isOpen() ? 'open' : 'closed' }}">
                                <i class="fas fa-{{ $jalur->isOpen() ? 'check-circle' : 'times-circle' }}"></i>
                                {{ $jalur->isOpen() ? 'Dibuka' : 'Ditutup' }}
                            </span>
                            <h4>{{ $jalur->nama_jalur }}</h4>
                            <p class="jalur-info">{{ $jalur->deskripsi }}</p>
                            <div class="jalur-meta">
                                <div class="jalur-meta-item">
                                    <i class="fas fa-calendar"></i>
                                    <span>{{ $jalur->tanggal_mulai->format('d M Y') }} -
                                        {{ $jalur->tanggal_selesai->format('d M Y') }}</span>
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
            </section>
        @endif


        <!-- Link Penting Section -->
        @if ($links->count() > 0)
            <section style="margin-bottom: 3rem;">
                <h2 class="section-title">Link Penting</h2>

                <div class="links-grid">
                    @foreach ($links as $link)
                        <div class="link-item">
                            <a href="{{ $link->url }}" target="_blank">
                                <div class="link-icon {{ $link->jenis }}">
                                    <i
                                        class="fas fa-{{ $link->jenis === 'pendaftaran' ? 'edit' : ($link->jenis === 'info' ? 'info-circle' : ($link->jenis === 'hasil' ? 'trophy' : 'link')) }}"></i>
                                </div>
                                <div style="flex: 1;">
                                    <h5 style="font-weight: 600; margin-bottom: 0.25rem;">{{ $link->nama_link }}</h5>
                                    @if ($link->deskripsi)
                                        <p style="font-size: 0.85rem; color: var(--text-muted); margin: 0;">
                                            {{ $link->deskripsi }}</p>
                                    @endif
                                </div>
                                <i class="fas fa-external-link-alt" style="color: var(--text-muted);"></i>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- CTA Section -->
        <section class="cta-section">
            <h3>Siap Bergabung?</h3>
            <p style="font-size: 1.1rem; opacity: 0.95;">
                Jangan lewatkan kesempatan untuk menjadi bagian dari SMK Taman Siswa Purwokerto!
            </p>
            <div class="cta-buttons">
                <a href="tel:+62XXXXXXXXXX" class="cta-btn primary">
                    <i class="fas fa-phone"></i> Hubungi Kami
                </a>
                <a href="{{ route('profilsekolah.ppdb-detail') }}" class="cta-btn outline">
                    <i class="fas fa-info-circle"></i> Informasi Lengkap
                </a>
            </div>
        </section>

    </div>
@endsection
