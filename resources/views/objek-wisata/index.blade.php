@extends('layouts.admin')

@section('title', 'Objek Wisata')
@section('page-title', 'Manajemen Objek Wisata')
@section('page-description', 'Kelola semua data objek wisata')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex justify-between items-center">
        <div>
            <h3 class="text-2xl font-bold text-gray-800">Daftar Objek Wisata</h3>
            <p class="text-gray-600 mt-1">Total: {{ $objekWisata->count() }} objek wisata</p>
        </div>
        <a href="{{ route('admin.objek-wisata.create') }}" class="px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg hover:shadow-lg transition-all font-medium">
            <i class="fas fa-plus mr-2"></i>Tambah Objek Wisata
        </a>
    </div>

    <!-- Content -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        @if($objekWisata->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kota</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Tiket</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jam Operasional</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($objekWisata as $objek)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($objek->gambar)
                                    <img src="{{ asset($objek->gambar) }}" alt="Foto Objek Wisata" class="h-16 w-24 object-cover rounded">
                                @else
                                    <span class="text-xs text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $objek->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $objek->alamat }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $objek->kota }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $objek->harga_tiket ? 'Rp ' . number_format($objek->harga_tiket,0,',','.') : '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $objek->jam_operasional ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.objek-wisata.show', ['objek_wisatum' => $objek->slug]) }}" class="text-blue-600 hover:text-blue-900 transition-colors" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.objek-wisata.edit', ['objek_wisatum' => $objek->slug]) }}" class="text-yellow-600 hover:text-yellow-900 transition-colors" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.objek-wisata.destroy', ['objek_wisatum' => $objek->slug]) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus objek wisata ini?')">
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
                    <i class="fas fa-map-marked-alt text-gray-400 text-2xl"></i>
                </div>
                <h5 class="text-lg font-semibold text-gray-900 mb-2">Belum ada objek wisata</h5>
                <p class="text-gray-500 mb-6">Mulai dengan menambahkan objek wisata pertama.</p>
                <a href="{{ route('admin.objek-wisata.create') }}" class="px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg hover:shadow-lg transition-all font-medium inline-flex items-center">
                    <i class="fas fa-plus mr-2"></i>Tambah Objek Wisata
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
