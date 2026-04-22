@extends('layouts.admin')

@section('title', 'Pengumuman')
@section('page-title', 'Manajemen Pengumuman')
@section('page-description', 'Kelola semua pengumuman sekolah')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex justify-between items-center">
        <div>
            <h3 class="text-2xl font-bold text-gray-800">Daftar Pengumuman</h3>
            <p class="text-gray-600 mt-1">Total: {{ $pengumumans->count() }} pengumuman</p>
        </div>
        <a href="{{ route('admin.pengumumans.create') }}" class="px-4 py-2 bg-gradient-to-r from-green-500 to-teal-600 text-white rounded-lg hover:shadow-lg transition-all font-medium">
            <i class="fas fa-plus mr-2"></i>Tambah Pengumuman
        </a>
    </div>

    <!-- Content: Table -->
    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Post</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider" style="min-width:160px">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($pengumumans as $pengumuman)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $pengumuman->title }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                {{ $pengumuman->posted_at ? $pengumuman->posted_at->format('d-m-Y') : $pengumuman->created_at->format('d-m-Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if(is_null($pengumuman->expires_at) || $pengumuman->expires_at->isFuture())
                                    <span class="px-2 py-1 text-xs font-semibold rounded bg-green-100 text-green-800">Aktif</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold rounded bg-gray-100 text-gray-600">Kadaluarsa</span>
                                @endif
                                @if($pengumuman->expires_at)
                                    <div class="text-xs text-gray-400 mt-1">Expires: {{ $pengumuman->expires_at->format('d-m-Y') }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-right">
                                <div class="flex space-x-3 justify-end">
                                    <a href="{{ route('admin.pengumumans.show', $pengumuman->id) }}" class="text-blue-600 hover:text-blue-900 transition-colors" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.pengumumans.edit', $pengumuman->id) }}" class="text-yellow-600 hover:text-yellow-900 transition-colors" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.pengumumans.destroy', $pengumuman->id) }}" method="POST" class="inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 transition-colors" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4 mx-auto">
                                    <i class="fas fa-bullhorn text-gray-400 text-2xl"></i>
                                </div>
                                <div class="text-lg font-semibold text-gray-900">Belum ada pengumuman</div>
                                <p class="text-gray-500 mt-2">Mulai dengan menambahkan pengumuman pertama.</p>
                                <a href="{{ route('admin.pengumumans.create') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-teal-600 text-white rounded-lg hover:shadow-lg transition-all font-medium">
                                    <i class="fas fa-plus mr-2"></i>Tambah Pengumuman
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
