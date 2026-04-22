@extends('layouts.admin')
@section('title', 'Link PPDB')
@section('page-title', 'Manajemen Link PPDB')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h3 class="text-2xl font-bold text-gray-800">Daftar Link PPDB</h3>
        <a href="{{ route('admin.ppdb_links.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            <i class="fas fa-plus mr-2"></i>Tambah Link
        </a>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
        @if($links->count() > 0)
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Nama Link</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">URL</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Jenis</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Order</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($links as $link)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $link->nama_link }}</div>
                            <div class="text-sm text-gray-500">{{ Str::limit($link->deskripsi, 50) }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ $link->url }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm">
                                <i class="fas fa-external-link-alt mr-1"></i>{{ Str::limit($link->url, 40) }}
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded
                                {{ $link->jenis === 'pendaftaran' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $link->jenis === 'info' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $link->jenis === 'hasil' ? 'bg-purple-100 text-purple-800' : '' }}
                                {{ $link->jenis === 'lainnya' ? 'bg-gray-100 text-gray-800' : '' }}">
                                {{ ucfirst($link->jenis) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded {{ $link->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $link->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm">{{ $link->order }}</td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.ppdb_links.edit', $link->id) }}" class="text-yellow-600 hover:text-yellow-800"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.ppdb_links.destroy', $link->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus link ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="text-center py-12">
                <i class="fas fa-link text-gray-300 text-5xl mb-4"></i>
                <p class="text-gray-500">Belum ada link PPDB</p>
            </div>
        @endif
    </div>
</div>
@endsection
