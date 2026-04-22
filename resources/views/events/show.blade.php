@extends('layouts.admin')

@section('title', 'Detail Event')
@section('page-title', 'Detail Event')
@section('page-description', 'Informasi lengkap event')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <!-- Image Header -->
        @if($event->image_path)
            <div class="h-96 bg-gray-200 overflow-hidden">
                <img src="{{ $event->image_url }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
            </div>
        @endif

        <div class="p-8 space-y-6">
            <!-- Header Info -->
            <div class="flex items-center justify-between pb-6 border-b border-gray-100">
                <div class="flex items-center space-x-3">
                    <span class="px-4 py-1 bg-purple-100 text-purple-800 text-sm font-semibold rounded-full">
                        <i class="fas fa-calendar-alt mr-2"></i>Event
                    </span>
                    @if($event->jurusan)
                        <span class="px-4 py-1 bg-yellow-100 text-yellow-800 text-sm font-semibold rounded-full">Jurusan: {{ $event->jurusan->name }}</span>
                    @else
                        <span class="px-4 py-1 bg-gray-100 text-gray-600 text-sm font-semibold rounded-full">Umum</span>
                    @endif
                    <span class="text-gray-500 text-sm">
                        {{ \Carbon\Carbon::parse($event->start_date)->format('d-m-Y') }}
                    </span>
                </div>
                @if($event->lokasi)
                    <div class="text-gray-500 text-sm">
                        <i class="fas fa-map-marker-alt mr-2"></i>{{ $event->location }}
                    </div>
                @endif
            </div>

            <!-- Title & Meta -->
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $event->title }}</h1>
                <div class="flex flex-wrap gap-2 mt-2">
                    <span class="inline-block bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded">Kategori: {{ $event->category ?? '-' }}</span>
                    <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">Penyelenggara: {{ $event->organizer ?? '-' }}</span>
                    @if($event->jurusan)
                        <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded">Jurusan: {{ $event->jurusan->name }}</span>
                    @else
                        <span class="inline-block bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded">Umum</span>
                    @endif
                    <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Status: {{ $event->status ?? '-' }}</span>
                </div>
            </div>

            <!-- Tanggal & Lokasi -->
            <div class="mt-4 flex flex-wrap gap-4 text-sm">
                <div class="flex items-center gap-1">
                    <i class="fas fa-calendar-alt text-gray-400"></i>
                    <span>Tanggal Mulai: <b>{{ $event->start_date ? \Carbon\Carbon::parse($event->start_date)->format('d-m-Y') : '-' }}</b></span>
                </div>
                <div class="flex items-center gap-1">
                    <i class="fas fa-calendar-check text-gray-400"></i>
                    <span>Tanggal Selesai: <b>{{ $event->end_date ? \Carbon\Carbon::parse($event->end_date)->format('d-m-Y') : '-' }}</b></span>
                </div>
                <div class="flex items-center gap-1">
                    <i class="fas fa-map-marker-alt text-gray-400"></i>
                    <span>Lokasi: <b>{{ $event->location ?? '-' }}</b></span>
                </div>
            </div>

            <!-- Content -->
            <div class="prose max-w-none mt-6">
                <div class="text-gray-700 leading-relaxed whitespace-pre-line">
                    {{ $event->description }}
                </div>
            </div>

            <!-- Meta Info -->
            <div class="pt-6 border-t border-gray-100 grid grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="text-gray-500">Dibuat:</span>
                    <span class="text-gray-900 ml-2">{{ $event->created_at->format('d M Y H:i') }}</span>
                </div>
                <div>
                    <span class="text-gray-500">Terakhir diupdate:</span>
                    <span class="text-gray-900 ml-2">{{ $event->updated_at->format('d M Y H:i') }}</span>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="bg-gray-50 px-8 py-4 flex justify-between items-center border-t border-gray-100">
            <a href="{{ route('admin.events.index') }}" class="px-4 py-2 text-gray-700 hover:text-gray-900 font-medium">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            <div class="flex space-x-3">
                <a href="{{ route('admin.events.edit', $event->slug) }}" class="px-4 py-2 bg-yellow-50 text-yellow-600 rounded-lg hover:bg-yellow-100 transition-colors font-medium">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <form action="{{ route('admin.events.destroy', $event->slug) }}" method="POST" class="inline" 
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus event ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors font-medium">
                        <i class="fas fa-trash mr-2"></i>Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
