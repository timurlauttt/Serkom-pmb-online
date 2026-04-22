@extends('layouts.admin')

@section('title', 'Prestasi')
@section('page-title', 'Manajemen Prestasi')
@section('page-description', 'Kelola semua prestasi siswa')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex justify-between items-center">
        <div>
            <h3 class="text-2xl font-bold text-gray-800">Daftar Prestasi</h3>
            <p class="text-gray-600 mt-1">Total: {{ $prestasis->count() }} prestasi</p>
        </div>
        <a href="{{ route('admin.prestasis.create') }}" class="px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg hover:shadow-lg transition-all font-medium">
            <i class="fas fa-plus mr-2"></i>Tambah Prestasi
        </a>
    </div>

    <!-- Content -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        @if($prestasis->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thumbnail</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tingkat</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peringkat</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jurusan</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Featured</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($prestasis as $prestasi)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="w-16 h-16 rounded-lg overflow-hidden bg-gray-200">
                                    @if($prestasi->thumbnail)
                                        <img src="{{ asset($prestasi->thumbnail) }}" alt="{{ $prestasi->judul }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <i class="fas fa-trophy text-gray-400"></i>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $prestasi->judul }}</div>
                                <div class="text-sm text-gray-500 mt-1">{{ Str::limit($prestasi->deskripsi, 60) }}</div>
                                @if($prestasi->nama_siswa)
                                    <div class="text-xs text-blue-600 mt-1">{{ $prestasi->nama_siswa }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $prestasi->tingkat === 'internasional' ? 'bg-purple-100 text-purple-800' : '' }}
                                    {{ $prestasi->tingkat === 'nasional' ? 'bg-red-100 text-red-800' : '' }}
                                    {{ $prestasi->tingkat === 'provinsi' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $prestasi->tingkat === 'kota' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $prestasi->tingkat === 'sekolah' ? 'bg-blue-100 text-blue-800' : '' }}">
                                    {{ ucfirst($prestasi->tingkat) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $prestasi->peringkat }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $prestasi->tahun }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs">
                                @if($prestasi->jurusan)
                                    <span class="inline-block bg-indigo-100 text-indigo-800 px-2 py-1 rounded">{{ $prestasi->jurusan->name }}</span>
                                @else
                                    <span class="inline-block bg-gray-100 text-gray-600 px-2 py-1 rounded">Umum</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($prestasi->is_featured)
                                    <i class="fas fa-star text-yellow-400"></i>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.prestasis.edit', $prestasi->id) }}" class="text-yellow-600 hover:text-yellow-900 transition-colors" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.prestasis.destroy', $prestasi->id) }}" method="POST" class="inline" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus prestasi ini?')">
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
                    <i class="fas fa-trophy text-gray-400 text-2xl"></i>
                </div>
                <h5 class="text-lg font-semibold text-gray-900 mb-2">Belum ada prestasi</h5>
                <p class="text-gray-500 mb-6">Mulai dengan menambahkan prestasi pertama.</p>
                <a href="{{ route('admin.prestasis.create') }}" class="px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg hover:shadow-lg transition-all font-medium inline-flex items-center">
                    <i class="fas fa-plus mr-2"></i>Tambah Prestasi
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
