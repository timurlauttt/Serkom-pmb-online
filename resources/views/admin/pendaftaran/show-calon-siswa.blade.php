@extends('layouts.admin')

@section('title', 'Detail Calon Siswa')
@section('page-title', 'Detail Calon Siswa')
@section('page-description', 'Informasi lengkap data registrasi calon siswa')

@section('content')
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.pendaftaran.calon-siswa') }}"
                class="inline-flex items-center px-4 py-2 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 text-sm font-medium">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar
            </a>
            <span class="text-sm text-gray-500">Terdaftar: {{ $casis->created_at?->format('d M Y H:i') ?? '-' }}</span>
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">{{ $casis->nama_lengkap }}</h3>
                    <p class="text-sm text-gray-500">{{ $casis->email }}</p>
                </div>
                <div class="w-full md:w-80">
                    <div class="flex items-center justify-between text-xs text-gray-500 mb-1">
                        <span>Kelengkapan Profil</span>
                        <span>{{ $terisiField }}/{{ $totalField }} ({{ $persentase }}%)</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $persentase }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6">
                    <h4 class="text-base font-semibold text-gray-800 mb-4">Data Identitas</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-gray-500">Nama Lengkap</p>
                            <p class="font-medium text-gray-800">{{ $casis->nama_lengkap ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Email</p>
                            <p class="font-medium text-gray-800">{{ $casis->email ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">No HP</p>
                            <p class="font-medium text-gray-800">{{ $casis->no_hp ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Nomor Telepon</p>
                            <p class="font-medium text-gray-800">{{ $casis->nomor_telepon ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Jenis Kelamin</p>
                            <p class="font-medium text-gray-800">{{ $casis->jenis_kelamin ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Status Menikah</p>
                            <p class="font-medium text-gray-800">{{ $casis->status_menikah ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Agama</p>
                            <p class="font-medium text-gray-800">{{ optional($casis->agama)->name ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Kewarganegaraan</p>
                            <p class="font-medium text-gray-800">{{ $casis->kewarganegaraan ?? '-' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-gray-500">Negara (jika WNA)</p>
                            <p class="font-medium text-gray-800">{{ $casis->negara_wna ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6">
                    <h4 class="text-base font-semibold text-gray-800 mb-4">Data Alamat</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div class="md:col-span-2">
                            <p class="text-gray-500">Alamat KTP</p>
                            <p class="font-medium text-gray-800">{{ $casis->alamat_ktp ?? '-' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-gray-500">Alamat Saat Ini</p>
                            <p class="font-medium text-gray-800">{{ $casis->alamat_saat_ini ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Kecamatan</p>
                            <p class="font-medium text-gray-800">{{ $casis->kecamatan ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Kabupaten/Kota</p>
                            <p class="font-medium text-gray-800">{{ optional($casis->kabupaten)->name ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Provinsi</p>
                            <p class="font-medium text-gray-800">{{ optional($casis->provinsi)->name ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6">
                    <h4 class="text-base font-semibold text-gray-800 mb-4">Data Kelahiran</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-gray-500">Tanggal Lahir</p>
                            <p class="font-medium text-gray-800">
                                {{ $casis->tanggal_lahir ? \Carbon\Carbon::parse($casis->tanggal_lahir)->format('d-m-Y') : '-' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-gray-500">Tempat Lahir - Provinsi</p>
                            <p class="font-medium text-gray-800">{{ optional($casis->tempatLahirProvinsi)->name ?? '-' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-gray-500">Tempat Lahir - Kabupaten/Kota</p>
                            <p class="font-medium text-gray-800">{{ optional($casis->tempatLahirKabupaten)->name ?? '-' }}
                            </p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-gray-500">Negara Tempat Lahir (jika luar negeri)</p>
                            <p class="font-medium text-gray-800">{{ $casis->tempat_lahir_negara ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <!-- Status Card -->
                <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6">
                    <h4 class="text-base font-semibold text-gray-800 mb-4">Status Penerimaan</h4>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                @if ($casis->status_penerimaan === 'diterima')
                                    <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                                        <i class="fas fa-check text-green-600 text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Status</p>
                                        <p class="font-bold text-green-600 text-lg">Diterima</p>
                                    </div>
                                @elseif ($casis->status_penerimaan === 'ditolak')
                                    <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                                        <i class="fas fa-times text-red-600 text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Status</p>
                                        <p class="font-bold text-red-600 text-lg">Ditolak</p>
                                    </div>
                                @else
                                    <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center">
                                        <i class="fas fa-hourglass-half text-yellow-600 text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Status</p>
                                        <p class="font-bold text-yellow-600 text-lg">Menunggu Verifikasi</p>
                                    </div>
                                @endif
                            </div>
                            <a href="{{ route('admin.pendaftaran.calon-siswa.status', $casis->id) }}"
                                class="px-4 py-2 rounded-lg bg-purple-100 text-purple-700 text-sm font-semibold hover:bg-purple-200">
                                <i class="fas fa-edit mr-1"></i> Ubah Status
                            </a>
                        </div>
                        @if ($casis->catatan_penerimaan)
                            <div class="bg-gray-50 p-3 rounded-lg border-l-4 border-blue-400">
                                <p class="text-xs font-semibold text-gray-600 mb-1">Catatan:</p>
                                <p class="text-sm text-gray-700">{{ $casis->catatan_penerimaan }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6">
                        <h4 class="text-base font-semibold text-gray-800 mb-4">Aksi</h4>
                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('admin.pendaftaran.calon-siswa.edit', $casis->id) }}"
                                class="px-4 py-2 rounded-lg bg-blue-100 text-blue-700 text-sm font-semibold hover:bg-blue-200">
                                <i class="fas fa-edit mr-1"></i> Edit Data
                            </a>
                            <form id="deleteForm" action="{{ route('admin.pendaftaran.calon-siswa.destroy', $casis->id) }}"
                                method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="deleteBtn"
                                    class="px-4 py-2 rounded-lg bg-red-100 text-red-700 text-sm font-semibold hover:bg-red-200">
                                    <i class="fas fa-trash mr-1"></i> Hapus Data
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6">
                    <h4 class="text-base font-semibold text-gray-800 mb-4">Checklist Kelengkapan</h4>
                    <ul class="space-y-2 text-sm">
                        @foreach ($kelengkapan as $label => $status)
                            <li class="flex items-start gap-2">
                                @if ($status)
                                    <i class="fas fa-check-circle text-green-600 mt-0.5"></i>
                                    <span class="text-gray-700">{{ $label }}</span>
                                @else
                                    <i class="fas fa-times-circle text-red-500 mt-0.5"></i>
                                    <span class="text-gray-500">{{ $label }}</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // SweetAlert untuk konfirmasi hapus data
            const deleteBtn = document.getElementById('deleteBtn');
            const deleteForm = document.getElementById('deleteForm');

            deleteBtn?.addEventListener('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Hapus Data Calon Siswa?',
                    text: 'Data calon siswa akan dihapus secara permanen dan tidak dapat dipulihkan.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    didOpen: (modal) => {
                        modal.querySelector('.swal2-confirm').focus();
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteForm?.submit();
                    }
                });
            });
        </script>
    @endpush
@endsection
