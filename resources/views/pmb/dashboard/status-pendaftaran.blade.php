@extends('pmb.layouts.app')

@section('title', 'Status Pendaftaran')

@push('styles')
    <style>
        .group-card {
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 18px;
            background: #fff;
            margin-bottom: 16px;
        }

        .section-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 12px;
        }

        .form-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }

        .data-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 12px;
        }

        .data-item {
            display: flex;
            flex-direction: column;
        }

        .data-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }

        .data-value {
            font-size: 0.95rem;
            color: #111827;
            padding: 10px;
            background: #f9fafb;
            border-radius: 8px;
        }

        .empty-value {
            color: #9ca3af;
            font-style: italic;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            border-radius: 10px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .status-badge.accepted {
            background: #d1fae5;
            color: #065f46;
        }

        .status-badge.rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        .status-badge.pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-icon {
            font-size: 1.25rem;
        }

        .note-box {
            border-left: 4px solid #3b82f6;
            background: #eff6ff;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 12px;
        }

        .note-box p {
            color: #1e40af;
            font-size: 0.95rem;
        }
    </style>
@endpush

@section('content')
    <div class="max-w-6xl mx-auto">
        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg">
                <p class="text-green-700 font-semibold">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Error Message -->
        @if (session('error'))
            <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
                <p class="text-red-700 font-semibold">{{ session('error') }}</p>
            </div>
        @endif

        @if (!$casis)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 md:p-8">
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                    <p class="text-yellow-800 font-semibold">Anda harus login untuk melihat status pendaftaran.</p>
                </div>
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 md:p-8">
                <div class="mb-6 border-b border-gray-100 pb-4">
                    <h1 class="text-2xl font-bold text-gray-800">Status Pendaftaran Anda</h1>
                    <p class="text-sm text-gray-500 mt-1">Cek status penerimaan Anda di SMK Taman Siswa</p>
                </div>

                <!-- STATUS DISPLAY -->
                <div class="group-card">
                    <h2 class="group-title font-bold mb-4">Status Penerimaan</h2>

                    @if ($casis->status_penerimaan === 'diterima')
                        <div class="status-badge accepted">
                            <span class="status-icon">✅</span>
                            <span>Diterima di SMK Taman Siswa</span>
                        </div>
                        <p class="text-gray-700 mb-4">Selamat! Anda telah diterima sebagai siswa di SMK Taman Siswa.</p>
                    @elseif ($casis->status_penerimaan === 'ditolak')
                        <div class="status-badge rejected">
                            <span class="status-icon">❌</span>
                            <span>Tidak Diterima</span>
                        </div>
                        <p class="text-gray-700 mb-4">Mohon maaf, Anda belum memenuhi kriteria penerimaan.</p>
                    @else
                        <div class="status-badge pending">
                            <span class="status-icon">⏳</span>
                            <span>Sedang Diproses</span>
                        </div>
                        <p class="text-gray-700 mb-4">Data Anda sedang dalam proses verifikasi. Silakan tunggu pengumuman
                            resmi.</p>
                    @endif

                    @if ($casis->catatan_penerimaan)
                        <div class="note-box">
                            <p><strong>Catatan dari Admin:</strong></p>
                            <p>{{ $casis->catatan_penerimaan }}</p>
                        </div>
                    @endif

                    <div class="data-row">
                        <div class="data-item">
                            <div class="data-label">Tanggal Daftar</div>
                            <div class="data-value">{{ $casis->created_at->format('d-m-Y H:i') }}</div>
                        </div>
                        <div class="data-item">
                            <div class="data-label">Status Pembaruan</div>
                            <div class="data-value">{{ now()->format('d-m-Y') }}</div>
                        </div>
                    </div>
                </div>

                <!-- DATA PRIBADI -->
                <div class="group-card">
                    <h2 class="group-title font-bold mb-4">1. DATA PRIBADI</h2>

                    <div class="data-item">
                        <div class="data-label">Nama Lengkap</div>
                        <div class="data-value">{{ $casis->nama_lengkap ?? '-' }}</div>
                    </div>

                    <div class="data-row mt-4">
                        <div class="data-item">
                            <div class="data-label">Email</div>
                            <div class="data-value">{{ $casis->email ?? '-' }}</div>
                        </div>
                        <div class="data-item">
                            <div class="data-label">No HP</div>
                            <div class="data-value">{{ $casis->no_hp ?? '-' }}</div>
                        </div>
                    </div>

                    <div class="data-row mt-4">
                        <div class="data-item">
                            <div class="data-label">Jenis Kelamin</div>
                            <div class="data-value">{{ $casis->jenis_kelamin ?? '-' }}</div>
                        </div>
                        <div class="data-item">
                            <div class="data-label">Status Menikah</div>
                            <div class="data-value">{{ $casis->status_menikah ?? '-' }}</div>
                        </div>
                    </div>

                    <div class="data-row mt-4">
                        <div class="data-item">
                            <div class="data-label">Agama</div>
                            <div class="data-value">{{ $casis->agama?->name ?? '-' }}</div>
                        </div>
                        <div class="data-item">
                            <div class="data-label">Kewarganegaraan</div>
                            <div class="data-value">{{ $casis->kewarganegaraan ?? '-' }}</div>
                        </div>
                    </div>

                    @if ($casis->kewarganegaraan === 'WNA')
                        <div class="data-item mt-4">
                            <div class="data-label">Negara WNA</div>
                            <div class="data-value">{{ $casis->negara_wna ?? '-' }}</div>
                        </div>
                    @endif
                </div>

                <!-- ALAMAT -->
                <div class="group-card">
                    <h2 class="group-title font-bold mb-4">2. ALAMAT</h2>

                    <div class="data-item">
                        <div class="data-label">Alamat KTP</div>
                        <div class="data-value">{{ $casis->alamat_ktp ?? '-' }}</div>
                    </div>

                    <div class="data-item mt-4">
                        <div class="data-label">Alamat Saat Ini</div>
                        <div class="data-value">{{ $casis->alamat_saat_ini ?? '-' }}</div>
                    </div>

                    <div class="data-row mt-4">
                        <div class="data-item">
                            <div class="data-label">Kecamatan</div>
                            <div class="data-value">{{ $casis->kecamatan ?? '-' }}</div>
                        </div>
                        <div class="data-item">
                            <div class="data-label">Provinsi</div>
                            <div class="data-value">{{ $casis->provinsi?->name ?? '-' }}</div>
                        </div>
                    </div>

                    <div class="data-item mt-4">
                        <div class="data-label">Kabupaten/Kota</div>
                        <div class="data-value">{{ $casis->kabupaten?->name ?? '-' }}</div>
                    </div>

                    <div class="data-row mt-4">
                        <div class="data-item">
                            <div class="data-label">Nomor Telepon</div>
                            <div class="data-value">{{ $casis->nomor_telepon ?? '-' }}</div>
                        </div>
                    </div>
                </div>

                <!-- TANGGAL LAHIR -->
                <div class="group-card">
                    <h2 class="group-title font-bold mb-4">3. TANGGAL LAHIR</h2>
                    <div class="data-item">
                        <div class="data-label">Tanggal Lahir (sesuai ijazah)</div>
                        <div class="data-value">
                            @if ($casis->tanggal_lahir)
                                {{ \Carbon\Carbon::parse($casis->tanggal_lahir)->format('d-m-Y') }}
                            @else
                                -
                            @endif
                        </div>
                    </div>
                </div>

                <!-- TEMPAT LAHIR -->
                <div class="group-card">
                    <h2 class="group-title font-bold mb-4">4. TEMPAT LAHIR</h2>

                    <div class="data-row">
                        <div class="data-item">
                            <div class="data-label">Provinsi</div>
                            <div class="data-value">{{ $casis->tempatLahirProvinsi?->name ?? '-' }}</div>
                        </div>
                        <div class="data-item">
                            <div class="data-label">Kabupaten/Kota</div>
                            <div class="data-value">{{ $casis->tempatLahirKabupaten?->name ?? '-' }}</div>
                        </div>
                    </div>

                    @if ($casis->tempat_lahir_negara)
                        <div class="data-item mt-4">
                            <div class="data-label">Negara (lahir di luar negeri)</div>
                            <div class="data-value">{{ $casis->tempat_lahir_negara }}</div>
                        </div>
                    @endif
                </div>

                <!-- KELENGKAPAN DATA -->
                <div class="group-card">
                    <h2 class="group-title font-bold mb-4">Kelengkapan Data</h2>

                    @php
                        $kelengkapan = [
                            'Nama Lengkap' => !empty($casis->nama_lengkap),
                            'Email' => !empty($casis->email),
                            'No HP' => !empty($casis->no_hp),
                            'Jenis Kelamin' => !empty($casis->jenis_kelamin),
                            'Status Menikah' => !empty($casis->status_menikah),
                            'Agama' => !empty($casis->religion_id),
                            'Alamat KTP' => !empty($casis->alamat_ktp),
                            'Alamat Saat Ini' => !empty($casis->alamat_saat_ini),
                            'Kecamatan' => !empty($casis->kecamatan),
                            'Kabupaten' => !empty($casis->kabupaten_id),
                            'Provinsi' => !empty($casis->provinsi_id),
                            'Kewarganegaraan' => !empty($casis->kewarganegaraan),
                            'Tanggal Lahir' => !empty($casis->tanggal_lahir),
                            'Tempat Lahir' =>
                                !empty($casis->tempat_lahir_provinsi_id) || !empty($casis->tempat_lahir_negara),
                        ];
                        $totalField = count($kelengkapan);
                        $terisiField = collect($kelengkapan)->filter()->count();
                        $persentase = $totalField > 0 ? (int) round(($terisiField / $totalField) * 100) : 0;
                    @endphp

                    <div class="mb-4">
                        <div class="flex items-center justify-between mb-2">
                            <p class="font-semibold text-gray-800">Progress Pengisian Data</p>
                            <p class="text-sm font-bold text-blue-600">{{ $persentase }}%</p>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-blue-600 h-2.5 rounded-full transition-all duration-300"
                                style="width: {{ $persentase }}%"></div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        @foreach ($kelengkapan as $label => $status)
                            <div
                                class="flex items-center gap-2 p-3 rounded-lg @if ($status) bg-green-50 @else bg-red-50 @endif text-sm">
                                @if ($status)
                                    <i class="fas fa-check-circle text-green-600"></i>
                                    <span class="text-gray-700">{{ $label }}</span>
                                @else
                                    <i class="fas fa-times-circle text-red-500"></i>
                                    <span class="text-gray-500">{{ $label }}</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="pt-4 flex items-center gap-3">
                    @if ($persentase < 100)
                        <a href="{{ route('pmb.dashboard.edit-data-diri') }}"
                            class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold">
                            Lengkapi Data Diri
                        </a>
                    @endif

                    <a href="{{ route('pmb.cetak.bukti') }}" target="_blank"
                        class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 font-semibold">
                        Cetak Bukti Pendaftaran
                    </a>

                    <a href="{{ route('pmb.dashboard') }}"
                        class="px-6 py-3 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 font-semibold">
                        Kembali ke Dashboard
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection
