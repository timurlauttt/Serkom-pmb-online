@extends('pmb.layouts.app')

@section('title', 'Data Diri')

@push('styles')
    <style>
        .group-card {
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 18px;
            background: #fff;
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

        .form-input,
        .form-textarea {
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            background: #f3f4f6;
            color: #111827;
            font-size: 0.95rem;
            padding: 10px 12px;
        }

        .form-input {
            height: 44px;
            padding: 0 12px;
        }

        .form-textarea {
            min-height: 92px;
            resize: vertical;
        }

        .readonly-input {
            background: #f3f4f6;
            color: #4b5563;
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

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 md:p-8">
            <div class="mb-6 border-b border-gray-100 pb-4 flex items-start justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Data Diri Calon Siswa</h1>
                    <p class="text-sm text-gray-500 mt-1">Tampilan data yang sudah terdaftar.</p>
                </div>
            </div>

            <!-- SECTION 1: DATA PRIBADI -->
            <div class="group-card">
                <h2 class="group-title font-bold mb-4">1. DATA PRIBADI</h2>
                <div class="data-item">
                    <div class="data-label">Nama Lengkap (sesuai ijazah disertai gelar)</div>
                    <div class="data-value">{{ $casis->nama_lengkap ?? '-' }}</div>
                </div>
            </div>

            <!-- SECTION 2: ALAMAT -->
            <div class="group-card">
                <h2 class="group-title font-bold mb-4">2. ALAMAT</h2>
                
                <div class="mb-4">
                    <div class="data-label">Alamat KTP</div>
                    <div class="data-value">{{ $casis->alamat_ktp ?? '-' }}</div>
                </div>

                <div class="mb-4">
                    <div class="data-label">Alamat Lengkap Saat Ini</div>
                    <div class="data-value">{{ $casis->alamat_saat_ini ?? '-' }}</div>
                </div>

                <div class="data-row">
                    <div class="data-item">
                        <div class="data-label">Kecamatan</div>
                        <div class="data-value">{{ $casis->kecamatan ?? '-' }}</div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">Provinsi</div>
                        <div class="data-value">{{ $casis->provinsi->name ?? '-' }}</div>
                    </div>
                </div>

                <div class="data-item">
                    <div class="data-label">Kabupaten/Kota</div>
                    <div class="data-value">{{ $casis->kabupaten->name ?? '-' }}</div>
                </div>

                <div class="data-row mt-4">
                    <div class="data-item">
                        <div class="data-label">Nomor Telepon</div>
                        <div class="data-value">{{ $casis->nomor_telepon ?? '-' }}</div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">Nomor HP</div>
                        <div class="data-value">{{ $casis->no_hp ?? '-' }}</div>
                    </div>
                </div>

                <div class="data-item mt-4">
                    <div class="data-label">Email</div>
                    <div class="data-value">{{ $casis->email ?? '-' }}</div>
                </div>
            </div>

            <!-- SECTION 3: KEWARGANEGARAAN -->
            <div class="group-card">
                <h2 class="group-title font-bold mb-4">3. KEWARGANEGARAAN</h2>
                <div class="data-item">
                    <div class="data-label">Kewarganegaraan</div>
                    <div class="data-value">{{ $casis->kewarganegaraan ?? '-' }}</div>
                </div>
                @if($casis->kewarganegaraan === 'WNA')
                    <div class="data-item mt-4">
                        <div class="data-label">Negara</div>
                        <div class="data-value">{{ $casis->negara_wna ?? '-' }}</div>
                    </div>
                @endif
            </div>

            <!-- SECTION 4: TANGGAL LAHIR -->
            <div class="group-card">
                <h2 class="group-title font-bold mb-4">4. TANGGAL LAHIR (sesuai ijazah)</h2>
                <div class="data-item">
                    <div class="data-label">Tanggal Lahir</div>
                    <div class="data-value">
                        {{ $casis->tanggal_lahir ? \Carbon\Carbon::parse($casis->tanggal_lahir)->format('d-m-Y') : '-' }}
                    </div>
                </div>
            </div>

            <!-- SECTION 5: TEMPAT LAHIR -->
            <div class="group-card">
                <h2 class="group-title font-bold mb-4">5. TEMPAT LAHIR (sesuai ijazah)</h2>
                <div class="data-row">
                    <div class="data-item">
                        <div class="data-label">Provinsi</div>
                        <div class="data-value">{{ $casis->tempatLahirProvinsi->name ?? '-' }}</div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">Kabupaten/Kota</div>
                        <div class="data-value">{{ $casis->tempatLahirKabupaten->name ?? '-' }}</div>
                    </div>
                </div>
                <div class="data-item mt-4">
                    <div class="data-label">Jika lahir di luar negeri</div>
                    <div class="data-value">{{ $casis->tempat_lahir_negara ?? '-' }}</div>
                </div>
            </div>

            <!-- SECTION 6: JENIS KELAMIN -->
            <div class="group-card">
                <h2 class="group-title font-bold mb-4">6. JENIS KELAMIN</h2>
                <div class="data-item">
                    <div class="data-label">Jenis Kelamin</div>
                    <div class="data-value">{{ $casis->jenis_kelamin ?? '-' }}</div>
                </div>
            </div>

            <!-- SECTION 7: STATUS MENIKAH -->
            <div class="group-card">
                <h2 class="group-title font-bold mb-4">7. STATUS MENIKAH</h2>
                <div class="data-item">
                    <div class="data-label">Status Menikah</div>
                    <div class="data-value">{{ $casis->status_menikah ?? '-' }}</div>
                </div>
            </div>

            <!-- SECTION 8: AGAMA -->
            <div class="group-card">
                <h2 class="group-title font-bold mb-4">8. AGAMA</h2>
                <div class="data-item">
                    <div class="data-label">Agama</div>
                    <div class="data-value">{{ $casis->agama->name ?? '-' }}</div>
                </div>
            </div>

            <div class="pt-4 flex items-center gap-3">
                <a href="{{ route('pmb.dashboard.edit-data-diri') }}"
                    class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                    Edit Data Diri
                </a>
                <a href="{{ route('pmb.dashboard') }}"
                    class="px-6 py-3 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors font-semibold">
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

@endsection

