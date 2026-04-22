@extends('layouts.admin')
@section('title', 'Jalur PPDB')
@section('page-title', 'Manajemen Jalur PPDB')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h3 class="text-2xl font-bold text-gray-800">Daftar Jalur PPDB</h3>
        <a href="{{ route('admin.ppdb_jalurs.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            <i class="fas fa-plus mr-2"></i>Tambah Jalur
        </a>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
        @if($jalurs->count() > 0)
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Nama Jalur</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Kuota</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Periode</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Order</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($jalurs as $jalur)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $jalur->nama_jalur }}</div>
                            <div class="text-sm text-gray-500">{{ Str::limit($jalur->deskripsi, 50) }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm">{{ $jalur->kuota ?? 'Unlimited' }}</td>
                        <td class="px-6 py-4 text-sm">
                            {{ $jalur->tanggal_mulai->format('d/m/Y') }} - {{ $jalur->tanggal_selesai->format('d/m/Y') }}
                            @if($jalur->isOpen())
                                <span class="block text-green-600 text-xs mt-1"><i class="fas fa-check-circle"></i> Terbuka</span>
                            @else
                                <span class="block text-gray-400 text-xs mt-1"><i class="fas fa-times-circle"></i> Tutup</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded {{ $jalur->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $jalur->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm">{{ $jalur->order }}</td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.ppdb_jalurs.edit', $jalur->id) }}" class="text-yellow-600 hover:text-yellow-800"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.ppdb_jalurs.destroy', $jalur->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus jalur ini?')">
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
                <i class="fas fa-route text-gray-300 text-5xl mb-4"></i>
                <p class="text-gray-500">Belum ada jalur PPDB</p>
            </div>
        @endif
    </div>
</div>
@endsection
