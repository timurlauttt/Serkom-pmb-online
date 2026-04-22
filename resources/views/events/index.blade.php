@extends('layouts.admin')

@section('title', 'Event')
@section('page-title', 'Manajemen Event')
@section('page-description', 'Kelola semua event dan kegiatan sekolah')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex justify-between items-center">
        <div>
            <h3 class="text-2xl font-bold text-gray-800">Daftar Event</h3>
            <p class="text-gray-600 mt-1">Total: {{ $events->count() }} event</p>
        </div>
        <a href="{{ route('admin.events.create') }}" class="px-4 py-2 bg-gradient-to-r from-purple-500 to-pink-600 text-white rounded-lg hover:shadow-lg transition-all font-medium">
            <i class="fas fa-plus mr-2"></i>Tambah Event
        </a>
    </div>

    <!-- Content: Table -->
    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jurusan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider" style="min-width:160px">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($events as $event)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap w-28">
                                        <div class="w-20 h-12 bg-gray-100 rounded overflow-hidden flex items-center justify-center">
                                            @if($event->image_path)
                                                <img src="{{ $event->image_url }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                                            @else
                                                <i class="fas fa-calendar text-gray-300"></i>
                                            @endif
                                        </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $event->title }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                {{ \Carbon\Carbon::parse($event->start_date)->format('d-m-Y') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ Str::limit(strip_tags($event->description), 120) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs">
                                                            <td class="px-6 py-4 whitespace-nowrap text-xs">
                                                                @if($event->status === 'published')
                                                                    <span class="inline-block bg-green-100 text-green-800 px-2 py-1 rounded">Published</span>
                                                                @else
                                                                    <span class="inline-block bg-gray-200 text-gray-700 px-2 py-1 rounded">Draft</span>
                                                                @endif
                                @if($event->jurusan)
                                    <span class="inline-block bg-yellow-100 text-yellow-800 px-2 py-1 rounded">{{ $event->jurusan->name }}</span>
                                @else
                                    <span class="inline-block bg-gray-100 text-gray-600 px-2 py-1 rounded">Umum</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-right">
                                <div class="flex space-x-2 justify-end">
                                    <form action="{{ route('admin.events.toggle-status', $event->slug) }}" method="POST" onsubmit="return confirm('Ubah status event ini?')">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-900 transition-colors" title="Toggle Status">
                                            @if($event->status === 'published')
                                                <i class="fas fa-eye-slash"></i>
                                            @else
                                                <i class="fas fa-upload"></i>
                                            @endif
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.events.show', $event->slug) }}" class="text-blue-600 hover:text-blue-900 transition-colors" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.events.edit', $event->slug) }}" class="text-yellow-600 hover:text-yellow-900 transition-colors" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.events.destroy', $event->slug) }}" method="POST" class="inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus event ini?')">
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
                                    <i class="fas fa-calendar-alt text-gray-400 text-2xl"></i>
                                </div>
                                <div class="text-lg font-semibold text-gray-900">Belum ada event</div>
                                <p class="text-gray-500 mt-2">Mulai dengan menambahkan event pertama.</p>
                                <a href="{{ route('admin.events.create') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-500 to-pink-600 text-white rounded-lg hover:shadow-lg transition-all font-medium">
                                    <i class="fas fa-plus mr-2"></i>Tambah Event
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
