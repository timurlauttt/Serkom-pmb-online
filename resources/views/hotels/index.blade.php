@extends('layouts.admin')

@section('title', 'Hotel')
@section('page-title', 'Manajemen Hotel')
@section('page-description', 'Kelola semua data hotel yang terdaftar')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex justify-between items-center">
        <div>
            <h3 class="text-2xl font-bold text-gray-800">Daftar Hotel</h3>
            <p class="text-gray-600 mt-1">Total: {{ $hotels->count() }} hotel</p>
        </div>
        <a href="{{ route('admin.hotels.create') }}" class="px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg hover:shadow-lg transition-all font-medium">
            <i class="fas fa-plus mr-2"></i>Tambah Hotel
        </a>
    </div>

    <!-- Content -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        @if($hotels->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kota</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kontak</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($hotels as $hotel)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($hotel->gambar)
                                    <img src="{{ asset($hotel->gambar) }}" alt="Foto Hotel" class="h-16 w-24 object-cover rounded">
                                @else
                                    <span class="text-xs text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $hotel->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $hotel->alamat }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $hotel->kota }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $hotel->kontak }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500 font-mono">{{ $hotel->slug }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ Str::limit(strip_tags($hotel->deskripsi), 60) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.hotels.show', $hotel) }}" class="text-blue-600 hover:text-blue-900 transition-colors" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.hotels.edit', $hotel) }}" class="text-yellow-600 hover:text-yellow-900 transition-colors" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.hotels.destroy', $hotel) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus hotel ini?')">
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
                    <i class="fas fa-hotel text-gray-400 text-2xl"></i>
                </div>
                <h5 class="text-lg font-semibold text-gray-900 mb-2">Belum ada hotel</h5>
                <p class="text-gray-500 mb-6">Mulai dengan menambahkan hotel pertama.</p>
                <a href="{{ route('admin.hotels.create') }}" class="px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg hover:shadow-lg transition-all font-medium inline-flex items-center">
                    <i class="fas fa-plus mr-2"></i>Tambah Hotel
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
