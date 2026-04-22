@extends('pmb.layouts.app')

@section('title', 'Dashboard')

@push('styles')
    <style>
        .group-card {
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 18px;
            background: #fff;
            margin-bottom: 16px;
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

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            border-radius: 10px;
            font-weight: 600;
        }

        .accepted {
            background: #d1fae5;
            color: #065f46;
        }

        .rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        .pending {
            background: #fef3c7;
            color: #92400e;
        }
    </style>
@endpush

@section('content')

    <div class="max-w-6xl mx-auto">

        <!-- NOTIF -->
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg">
                <p class="text-green-700 font-semibold">{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
                <p class="text-red-700 font-semibold">{{ session('error') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 md:p-8">

            <!-- HEADER -->
            <div class="mb-6 border-b border-gray-100 pb-4">
                <h1 class="text-2xl font-bold text-gray-800">Dashboard PPDB</h1>
                <p class="text-sm text-gray-500 mt-1">
                    Ringkasan data dan status pendaftaran Anda.
                </p>
            </div>

            @if (!$casis)
                <div class="group-card">
                    <p class="text-yellow-600 font-semibold">
                        Anda belum login atau belum mengisi data.
                    </p>
                </div>
            @else
                <!-- STATUS -->
                <div class="group-card">
                    <h2 class="font-bold mb-4">Status Pendaftaran</h2>

                    @if ($casis->status_penerimaan === 'diterima')
                        <div class="status-badge accepted">
                            ✅ Diterima
                        </div>
                    @elseif ($casis->status_penerimaan === 'ditolak')
                        <div class="status-badge rejected">
                            ❌ Ditolak
                        </div>
                    @else
                        <div class="status-badge pending">
                            ⏳ Sedang Diproses
                        </div>
                    @endif

                    <div class="data-row mt-4">
                        <div class="data-item">
                            <div class="data-label">Tanggal Daftar</div>
                            <div class="data-value">
                                {{ $casis->created_at ? $casis->created_at->format('d-m-Y H:i') : '-' }}
                            </div>
                        </div>
                        <div class="data-item">
                            <div class="data-label">Update Terakhir</div>
                            <div class="data-value">
                                {{ now()->format('d-m-Y') }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DATA SINGKAT -->
                <div class="group-card">
                    <h2 class="font-bold mb-4">Data Singkat</h2>

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
                            <div class="data-label">Agama</div>
                            <div class="data-value">{{ $casis->agama?->name ?? '-' }}</div>
                        </div>
                    </div>
                </div>

                <!-- PROGRESS -->
                @php
                    $fields = [
                        $casis->nama_lengkap,
                        $casis->email,
                        $casis->no_hp,
                        $casis->jenis_kelamin,
                        $casis->alamat_ktp,
                        $casis->tanggal_lahir,
                    ];

                    $total = count($fields);
                    $filled = collect($fields)->filter()->count();
                    $percent = $total > 0 ? round(($filled / $total) * 100) : 0;
                @endphp

                <div class="group-card">
                    <h2 class="font-bold mb-4">Progress Pengisian Data</h2>

                    <div class="flex justify-between mb-2">
                        <span class="text-sm text-gray-600">Kelengkapan</span>
                        <span class="text-sm font-bold text-blue-600">{{ $percent }}%</span>
                    </div>

                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $percent }}%"></div>
                    </div>
                </div>

                <!-- ACTION -->
                <div class="pt-4 flex items-center gap-3">
                    <a href="{{ route('pmb.dashboard.data-diri') }}"
                        class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold">
                        Lihat Data Diri
                    </a>

                    <a href="{{ route('pmb.dashboard.status-pendaftaran') }}"
                        class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 font-semibold">
                        Cek Status
                    </a>
                </div>

            @endif

        </div>
    </div>


    // use case
    // ss aplikasi
    // link github/drive
    // 
@endsection
