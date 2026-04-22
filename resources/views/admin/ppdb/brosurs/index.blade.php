@extends('layouts.admin')

@section('title', 'Brosur PPDB')
@section('page-title', 'Manajemen Brosur PPDB')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h3 class="text-2xl font-bold text-gray-800">Daftar Brosur PPDB</h3>
        <a href="{{ route('admin.ppdb_brosurs.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            <i class="fas fa-plus mr-2"></i>Tambah Brosur
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
        @if($brosurs->count() > 0)
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Tahun Ajaran</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Cover</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">File</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Order</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($brosurs as $brosur)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $brosur->judul }}</div>
                            <div class="text-sm text-gray-500">{{ Str::limit($brosur->deskripsi, 50) }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm">{{ $brosur->tahun_ajaran }}</td>
                        <td class="px-6 py-4">
                            @if($brosur->path_gambar_brosur)
                                <img src="{{ asset($brosur->path_gambar_brosur) }}" alt="Cover" class="h-10 w-10 object-cover rounded">
                            @else
                                <span class="text-xs text-gray-400">No Image</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ asset($brosur->file_path) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-file-pdf mr-1"></i>Lihat PDF
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded {{ $brosur->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $brosur->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm">{{ $brosur->order }}</td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.ppdb_brosurs.edit', $brosur->id) }}" class="text-yellow-600 hover:text-yellow-800">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.ppdb_brosurs.destroy', $brosur->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus brosur ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="text-center py-12">
                <i class="fas fa-file-pdf text-gray-300 text-5xl mb-4"></i>
                <p class="text-gray-500">Belum ada brosur</p>
            </div>
        @endif
    </div>
</div>
@endsection
