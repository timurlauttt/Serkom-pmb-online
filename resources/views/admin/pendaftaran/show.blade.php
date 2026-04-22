@extends('layouts.admin')

@section('title', 'Detail Pendaftaran')
@section('page-title', 'Detail Pendaftaran')
@section('page-description', 'Detail lengkap data pendaftaran siswa')

@section('content')
<div class="space-y-6">
    <!-- Back Button -->
    <div>
        <a href="{{ route('admin.pendaftaran.index') }}" class="text-blue-600 hover:text-blue-800">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
        {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Data Pribadi Siswa -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Pribadi Siswa</h3>
                <div class="space-y-3">
                    <div class="flex border-b border-gray-100 pb-3">
                        <div class="w-1/3 text-sm font-medium text-gray-600">Nama Lengkap</div>
                        <div class="w-2/3 text-sm text-gray-900">{{ $pendaftaran->nama_lengkap }}</div>
                    </div>
                    <div class="flex border-b border-gray-100 pb-3">
                        <div class="w-1/3 text-sm font-medium text-gray-600">Email</div>
                        <div class="w-2/3 text-sm text-gray-900">{{ $pendaftaran->email }}</div>
                    </div>
                    <div class="flex border-b border-gray-100 pb-3">
                        <div class="w-1/3 text-sm font-medium text-gray-600">No. HP</div>
                        <div class="w-2/3 text-sm text-gray-900">{{ $pendaftaran->no_hp_siswa }}</div>
                    </div>
                    <div class="flex border-b border-gray-100 pb-3">
                        <div class="w-1/3 text-sm font-medium text-gray-600">Tempat, Tanggal Lahir</div>
                        <div class="w-2/3 text-sm text-gray-900">{{ $pendaftaran->tempat_lahir }}, {{ $pendaftaran->tanggal_lahir->format('d F Y') }}</div>
                    </div>
                    <div class="flex border-b border-gray-100 pb-3">
                        <div class="w-1/3 text-sm font-medium text-gray-600">Jenis Kelamin</div>
                        <div class="w-2/3 text-sm text-gray-900">{{ $pendaftaran->jenis_kelamin }}</div>
                    </div>
                    <div class="flex">
                        <div class="w-1/3 text-sm font-medium text-gray-600">Alamat</div>
                        <div class="w-2/3 text-sm text-gray-900">{{ $pendaftaran->alamat }}</div>
                    </div>
                </div>
            </div>

            <!-- Data Orang Tua -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Orang Tua / Wali</h3>
                <div class="space-y-3">
                    <div class="flex border-b border-gray-100 pb-3">
                        <div class="w-1/3 text-sm font-medium text-gray-600">Nama Ayah</div>
                        <div class="w-2/3 text-sm text-gray-900">{{ $pendaftaran->nama_ayah }}</div>
                    </div>
                    <div class="flex border-b border-gray-100 pb-3">
                        <div class="w-1/3 text-sm font-medium text-gray-600">Pekerjaan Ayah</div>
                        <div class="w-2/3 text-sm text-gray-900">{{ $pendaftaran->pekerjaan_ayah }}</div>
                    </div>
                    <div class="flex border-b border-gray-100 pb-3">
                        <div class="w-1/3 text-sm font-medium text-gray-600">Nama Ibu</div>
                        <div class="w-2/3 text-sm text-gray-900">{{ $pendaftaran->nama_ibu }}</div>
                    </div>
                    <div class="flex border-b border-gray-100 pb-3">
                        <div class="w-1/3 text-sm font-medium text-gray-600">Pekerjaan Ibu</div>
                        <div class="w-2/3 text-sm text-gray-900">{{ $pendaftaran->pekerjaan_ibu }}</div>
                    </div>
                    @if($pendaftaran->nama_wali)
                    <div class="flex border-b border-gray-100 pb-3">
                        <div class="w-1/3 text-sm font-medium text-gray-600">Nama Wali</div>
                        <div class="w-2/3 text-sm text-gray-900">{{ $pendaftaran->nama_wali }}</div>
                    </div>
                    @endif
                    <div class="flex border-b border-gray-100 pb-3">
                        <div class="w-1/3 text-sm font-medium text-gray-600">No. HP Ortu/Wali</div>
                        <div class="w-2/3 text-sm text-gray-900">{{ $pendaftaran->no_hp_ortu }}</div>
                    </div>
                    <div class="flex">
                        <div class="w-1/3 text-sm font-medium text-gray-600">Alamat Ortu/Wali</div>
                        <div class="w-2/3 text-sm text-gray-900">{{ $pendaftaran->alamat_ortu }}</div>
                    </div>
                </div>
            </div>

            <!-- Data Sekolah Asal -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Sekolah Asal</h3>
                <div class="space-y-3">
                    <div class="flex border-b border-gray-100 pb-3">
                        <div class="w-1/3 text-sm font-medium text-gray-600">NISN</div>
                        <div class="w-2/3 text-sm text-gray-900">{{ $pendaftaran->nisn }}</div>
                    </div>
                    <div class="flex border-b border-gray-100 pb-3">
                        <div class="w-1/3 text-sm font-medium text-gray-600">Sekolah Asal</div>
                        <div class="w-2/3 text-sm text-gray-900">{{ $pendaftaran->sekolah_asal }}</div>
                    </div>
                    <div class="flex border-b border-gray-100 pb-3">
                        <div class="w-1/3 text-sm font-medium text-gray-600">Alamat Sekolah</div>
                        <div class="w-2/3 text-sm text-gray-900">{{ $pendaftaran->alamat_sekolah_asal }}</div>
                    </div>
                    <div class="flex border-b border-gray-100 pb-3">
                        <div class="w-1/3 text-sm font-medium text-gray-600">Tahun Lulus</div>
                        <div class="w-2/3 text-sm text-gray-900">{{ $pendaftaran->tahun_lulus }}</div>
                    </div>
                    <div class="flex border-b border-gray-100 pb-3">
                        <div class="w-1/3 text-sm font-medium text-gray-600">Rata-rata Nilai</div>
                        <div class="w-2/3 text-sm text-gray-900">{{ $pendaftaran->rata_rata_nilai }}</div>
                    </div>
                    <div class="flex">
                        <div class="w-1/3 text-sm font-medium text-gray-600">Jurusan Yang Diminati</div>
                        <div class="w-2/3 text-sm text-gray-900 font-semibold">{{ $pendaftaran->jurusan->name ?? '-' }}</div>
                    </div>
                </div>
            </div>

            <!-- Dokumen -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Dokumen</h3>
                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('admin.pendaftaran.download-document', [$pendaftaran->id, 'ijazah']) }}" class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50">
                        <i class="fas fa-file-pdf text-red-500 text-2xl mr-3"></i>
                        <div>
                            <div class="text-sm font-medium">Ijazah/SKL</div>
                            <div class="text-xs text-gray-500">Klik untuk download</div>
                        </div>
                    </a>
                    <a href="{{ route('admin.pendaftaran.download-document', [$pendaftaran->id, 'akta']) }}" class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50">
                        <i class="fas fa-file-pdf text-red-500 text-2xl mr-3"></i>
                        <div>
                            <div class="text-sm font-medium">Akta Kelahiran</div>
                            <div class="text-xs text-gray-500">Klik untuk download</div>
                        </div>
                    </a>
                    <a href="{{ route('admin.pendaftaran.download-document', [$pendaftaran->id, 'kk']) }}" class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50">
                        <i class="fas fa-file-pdf text-red-500 text-2xl mr-3"></i>
                        <div>
                            <div class="text-sm font-medium">Kartu Keluarga</div>
                            <div class="text-xs text-gray-500">Klik untuk download</div>
                        </div>
                    </a>
                    <a href="{{ route('admin.pendaftaran.download-document', [$pendaftaran->id, 'foto']) }}" class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50">
                        <i class="fas fa-image text-blue-500 text-2xl mr-3"></i>
                        <div>
                            <div class="text-sm font-medium">Pas Foto</div>
                            <div class="text-xs text-gray-500">Klik untuk download</div>
                        </div>
                    </a>
                    @if($pendaftaran->kip_path)
                    <a href="{{ route('admin.pendaftaran.download-document', [$pendaftaran->id, 'kip']) }}" class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50">
                        <i class="fas fa-file-pdf text-red-500 text-2xl mr-3"></i>
                        <div>
                            <div class="text-sm font-medium">KIP</div>
                            <div class="text-xs text-gray-500">Klik untuk download</div>
                        </div>
                    </a>
                    @endif
                    <a href="{{ route('admin.pendaftaran.download-document', [$pendaftaran->id, 'ktp']) }}" class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50">
                        <i class="fas fa-file-pdf text-red-500 text-2xl mr-3"></i>
                        <div>
                            <div class="text-sm font-medium">KTP Ortu/Wali</div>
                            <div class="text-xs text-gray-500">Klik untuk download</div>
                        </div>
                    </a>
                    @if($pendaftaran->bukti_pembayaran_path)
                    <a href="{{ route('admin.pendaftaran.download-document', [$pendaftaran->id, 'bukti_pembayaran']) }}" class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50">
                        <i class="fas fa-file-invoice-dollar text-green-500 text-2xl mr-3"></i>
                        <div>
                            <div class="text-sm font-medium">Bukti Pembayaran</div>
                            <div class="text-xs text-gray-500">Klik untuk download</div>
                        </div>
                    </a>
                    @endif
                </div>
            </div>

            <!-- Data Tambahan -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Tambahan</h3>
                <div class="space-y-3">
                    @if($pendaftaran->prestasi_ekstrakurikuler)
                    <div>
                        <div class="text-sm font-medium text-gray-600 mb-1">Prestasi/Pengalaman Ekstrakurikuler</div>
                        <div class="text-sm text-gray-900">{{ $pendaftaran->prestasi_ekstrakurikuler }}</div>
                    </div>
                    @endif
                    <div>
                        <div class="text-sm font-medium text-gray-600 mb-1">Alasan Memilih SMK Tamansiswa</div>
                        <div class="text-sm text-gray-900">{{ $pendaftaran->alasan_memilih }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Status Card -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Status</h3>
                <div class="space-y-4">
                    <div>
                        <div class="text-sm text-gray-600 mb-1">Kode Pendaftaran</div>
                        <div class="text-sm font-semibold">{{ $pendaftaran->kode_pendaftaran }}</div>
                    </div>
                    <div>
                        <div class="text-sm text-gray-600 mb-1">Tanggal Daftar</div>
                        <div class="text-sm">{{ $pendaftaran->created_at->format('d F Y H:i') }}</div>
                    </div>
                    <div>
                        <div class="text-sm text-gray-600 mb-1">Status Pembayaran</div>
                        <div>
                            @if($pendaftaran->status_pembayaran === 'paid')
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">✓ Lunas</span>
                            @else
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">{{ ucfirst($pendaftaran->status_pembayaran) }}</span>
                            @endif
                        </div>
                    </div>
                    @if($pendaftaran->paid_at)
                    <div>
                        <div class="text-sm text-gray-600 mb-1">Dibayar Pada</div>
                        <div class="text-sm">{{ $pendaftaran->paid_at->format('d F Y H:i') }}</div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Update Status Form -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Update Status</h3>
                <form action="{{ route('admin.pendaftaran.update-status', $pendaftaran->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status Pembayaran</label>
                            <select name="status_pembayaran" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                <option value="pending" {{ $pendaftaran->status_pembayaran == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="paid" {{ $pendaftaran->status_pembayaran == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="failed" {{ $pendaftaran->status_pembayaran == 'failed' ? 'selected' : '' }}>Failed</option>
                                <option value="expired" {{ $pendaftaran->status_pembayaran == 'expired' ? 'selected' : '' }}>Expired</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status Pendaftaran</label>
                            <select name="status_pendaftaran" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                <option value="draft" {{ $pendaftaran->status_pendaftaran == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="menunggu_pembayaran" {{ $pendaftaran->status_pendaftaran == 'menunggu_pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                                <option value="verifikasi_dokumen" {{ $pendaftaran->status_pendaftaran == 'verifikasi_dokumen' ? 'selected' : '' }}>Verifikasi Dokumen</option>
                                <option value="diterima" {{ $pendaftaran->status_pendaftaran == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                <option value="ditolak" {{ $pendaftaran->status_pendaftaran == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Admin</label>
                            <textarea name="catatan_admin" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">{{ $pendaftaran->catatan_admin }}</textarea>
                        </div>

                        <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                            <i class="fas fa-save mr-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            <!-- Delete -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-red-100">
                <h3 class="text-lg font-semibold text-red-600 mb-2">Zona Berbahaya</h3>
                <p class="text-sm text-gray-600 mb-4">Hapus data pendaftaran ini secara permanen</p>
                <form action="{{ route('admin.pendaftaran.destroy', $pendaftaran->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                        <i class="fas fa-trash mr-2"></i> Hapus Data
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
