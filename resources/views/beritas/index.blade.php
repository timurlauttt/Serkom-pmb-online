@extends('layouts.admin')

@section('title', 'Berita')
@section('page-title', 'Manajemen Berita')
@section('page-description', 'Kelola semua berita sekolah')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex justify-between items-center">
        <div>
            <h3 class="text-2xl font-bold text-gray-800">Daftar Berita</h3>
            <p class="text-gray-600 mt-1">Total: {{ $beritas->count() }} berita</p>
        </div>
        <a href="{{ route('admin.beritas.create') }}" class="px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg hover:shadow-lg transition-all font-medium">
            <i class="fas fa-plus mr-2"></i>Tambah Berita
        </a>
    </div>

    <!-- Content -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        @if($beritas->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jurusan</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penulis</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($beritas as $berita)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="w-16 h-16 rounded-lg overflow-hidden bg-gray-200">
                                    @if($berita->image_path)
                                        <img src="{{ $berita->image_url }}" alt="{{ $berita->title }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <i class="fas fa-image text-gray-400"></i>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $berita->title }}</div>
                                <div class="text-sm text-gray-500 mt-1">{{ Str::limit(strip_tags($berita->content), 60) }}</div>
                                <div class="text-xs text-gray-400 mt-1 font-mono">{{ $berita->slug }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $berita->category }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs">
                                @if($berita->status === 'published')
                                    <span class="inline-block bg-green-100 text-green-800 px-2 py-1 rounded">Published</span>
                                @else
                                    <span class="inline-block bg-gray-200 text-gray-700 px-2 py-1 rounded">Draft</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs">
                                @if($berita->jurusan)
                                    <span class="inline-block bg-yellow-100 text-yellow-800 px-2 py-1 rounded">{{ $berita->jurusan->name }}</span>
                                @else
                                    <span class="inline-block bg-gray-100 text-gray-600 px-2 py-1 rounded">Umum</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $berita->author }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $berita->posted_at ? $berita->posted_at->format('d/m/Y') : '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    @if($berita->status === 'draft')
                                        <form action="{{ route('admin.beritas.publish', $berita->slug) }}" method="POST" onsubmit="return confirm('Publish berita ini?')">
                                            @csrf
                                            <button type="submit" class="text-green-600 hover:text-green-900 transition-colors" title="Publish">
                                                <i class="fas fa-upload"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('admin.beritas.show', $berita->slug) }}" class="text-blue-600 hover:text-blue-900 transition-colors" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.beritas.edit', $berita->slug) }}" class="text-yellow-600 hover:text-yellow-900 transition-colors" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.beritas.destroy', $berita->slug) }}" method="POST" class="inline" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
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
                    <i class="fas fa-newspaper text-gray-400 text-2xl"></i>
                </div>
                <h5 class="text-lg font-semibold text-gray-900 mb-2">Belum ada berita</h5>
                <p class="text-gray-500 mb-6">Mulai dengan menambahkan berita pertama.</p>
                <a href="{{ route('admin.beritas.create') }}" class="px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg hover:shadow-lg transition-all font-medium inline-flex items-center">
                    <i class="fas fa-plus mr-2"></i>Tambah Berita
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
