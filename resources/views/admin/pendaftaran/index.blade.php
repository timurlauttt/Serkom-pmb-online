@extends('layouts.admin')

@section('title', 'Data Pendaftaran')
@section('page-title', 'Data Pendaftaran Siswa')
@section('page-description', 'Kelola data pendaftaran siswa baru')

@section('content')
<div class="space-y-6">
    <!-- Filter & Search -->
    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
        <form method="GET" action="{{ route('admin.pendaftaran.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Cari</label>
                <input type="text" name="search" value="{{ request('search') }}" 
                    placeholder="Nama, NISN, Email..." 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status Pembayaran</label>
                <select name="status_pembayaran" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua</option>
                    <option value="pending" {{ request('status_pembayaran') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ request('status_pembayaran') == 'paid' ? 'selected' : '' }}>Lunas</option>
                    <option value="failed" {{ request('status_pembayaran') == 'failed' ? 'selected' : '' }}>Gagal</option>
                    <option value="expired" {{ request('status_pembayaran') == 'expired' ? 'selected' : '' }}>Kadaluarsa</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status Pendaftaran</label>
                <select name="status_pendaftaran" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua</option>
                    <option value="draft" {{ request('status_pendaftaran') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="menunggu_pembayaran" {{ request('status_pendaftaran') == 'menunggu_pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                    <option value="verifikasi_dokumen" {{ request('status_pendaftaran') == 'verifikasi_dokumen' ? 'selected' : '' }}>Verifikasi Dokumen</option>
                    <option value="diterima" {{ request('status_pendaftaran') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                    <option value="ditolak" {{ request('status_pendaftaran') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
            
            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    <i class="fas fa-search mr-2"></i> Filter
                </button>
                <a href="{{ route('admin.pendaftaran.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300">
                    <i class="fas fa-redo"></i>
                </a>
            </div>
        </form>
    </div>

    <!-- Export Button -->
    <div class="flex justify-end">
        <a href="{{ route('admin.pendaftaran.export', request()->all()) }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
            <i class="fas fa-file-excel mr-2"></i> Export CSV
        </a>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        @if($pendaftarans->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Kode</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">NISN</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Nama</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Jurusan</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Status Bayar</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($pendaftarans as $pendaftaran)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $pendaftaran->kode_pendaftaran }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $pendaftaran->nisn }}</td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $pendaftaran->nama_lengkap }}</div>
                            <div class="text-sm text-gray-500">{{ $pendaftaran->email }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $pendaftaran->jurusan->name ?? '-' }}</td>
                        <td class="px-6 py-4">
                            @if($pendaftaran->status_pembayaran === 'paid')
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Lunas</span>
                            @elseif($pendaftaran->status_pembayaran === 'pending')
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                            @elseif($pendaftaran->status_pembayaran === 'failed')
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Gagal</span>
                            @else
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">{{ ucfirst($pendaftaran->status_pembayaran) }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($pendaftaran->status_pendaftaran === 'diterima')
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Diterima</span>
                            @elseif($pendaftaran->status_pendaftaran === 'ditolak')
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Ditolak</span>
                            @elseif($pendaftaran->status_pendaftaran === 'verifikasi_dokumen')
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Verifikasi</span>
                            @elseif($pendaftaran->status_pendaftaran === 'menunggu_pembayaran')
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu Bayar</span>
                            @else
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">{{ ucfirst($pendaftaran->status_pendaftaran) }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $pendaftaran->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('admin.pendaftaran.show', $pendaftaran->id) }}" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $pendaftarans->links() }}
        </div>
        @else
        <div class="text-center py-12">
            <i class="fas fa-inbox text-gray-300 text-5xl mb-4"></i>
            <p class="text-gray-500">Belum ada data pendaftaran</p>
        </div>
        @endif
    </div>
</div>
@endsection
