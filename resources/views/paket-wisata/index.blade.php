@extends('layouts.admin')

@section('title', 'Paket Wisata')
@section('page-title', 'Manajemen Paket Wisata')
@section('page-description', 'Kelola semua data paket wisata')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex justify-between items-center">
        <div>
            <h3 class="text-2xl font-bold text-gray-800">Daftar Paket Wisata</h3>
            <p class="text-gray-600 mt-1">Total: {{ $paketWisata->count() }} paket wisata</p>
        </div>
        <a href="{{ route('admin.paket-wisata.create') }}" class="px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg hover:shadow-lg transition-all font-medium">
            <i class="fas fa-plus mr-2"></i>Tambah Paket Wisata
        </a>
    </div>

    <!-- Content -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        @if($paketWisata->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Paket</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durasi</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Akomodasi</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($paketWisata as $paket)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($paket->gambar)
                                    <img src="{{ asset($paket->gambar) }}" alt="Foto Paket" class="h-16 w-24 object-cover rounded">
                                @else
                                    <span class="text-xs text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $paket->nama_paket }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($paket->kategori)
                                    <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">{{ $paket->kategori }}</span>
                                @else
                                    <span class="text-xs text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $paket->durasi_hari }} hari</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">Rp {{ number_format($paket->harga,0,',','.') }}</td>
                            <td class="px-6 py-4 text-gray-700">
                                @if($paket->akomodasi && is_array($paket->akomodasi) && count($paket->akomodasi) > 0)
                                    <div class="max-w-xs">
                                        @foreach(array_slice($paket->akomodasi, 0, 2) as $hotel)
                                            <div class="text-xs">• {{ $hotel }}</div>
                                        @endforeach
                                        @if(count($paket->akomodasi) > 2)
                                            <span class="text-xs text-gray-500">+{{ count($paket->akomodasi) - 2 }} lainnya</span>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-xs text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.paket-wisata.show', ['paket_wisatum' => $paket->slug]) }}" class="text-blue-600 hover:text-blue-900 transition-colors" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.paket-wisata.edit', ['paket_wisatum' => $paket->slug]) }}" class="text-yellow-600 hover:text-yellow-900 transition-colors" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.paket-wisata.destroy', ['paket_wisatum' => $paket->slug]) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus paket wisata ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 transition-colors" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-16">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                    <i class="fas fa-suitcase text-gray-400 text-2xl"></i>
                </div>
                <h5 class="text-lg font-semibold text-gray-900 mb-2">Belum ada paket wisata</h5>
                <p class="text-gray-500 mb-6">Mulai dengan menambahkan paket wisata pertama.</p>
                <a href="{{ route('admin.paket-wisata.create') }}" class="px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg hover:shadow-lg transition-all font-medium inline-flex items-center">
                    <i class="fas fa-plus mr-2"></i>Tambah Paket Wisata
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
