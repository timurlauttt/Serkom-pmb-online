@extends('layouts.admin')

@section('title', 'Detail Pengumuman')
@section('page-title', 'Detail Pengumuman')
@section('page-description', 'Informasi lengkap pengumuman')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-8 space-y-6">
            <!-- Header Info -->
            <div class="flex items-center justify-between pb-6 border-b border-gray-100">
                <div class="flex items-center space-x-3">
                    @if($pengumuman->expires_at && $pengumuman->expires_at->isFuture())
                        <span class="px-4 py-1 bg-red-100 text-red-800 text-sm font-semibold rounded-full">
                            Penting
                        </span>
                    @endif
                    <span class="text-gray-500 text-sm">
                        <i class="fas fa-calendar mr-2"></i>{{ $pengumuman->posted_at ? $pengumuman->posted_at->format('d F Y') : $pengumuman->created_at->format('d F Y') }}
                    </span>
                </div>
                @if($pengumuman->expires_at)
                    <div class="text-gray-500 text-sm">
                        <i class="fas fa-clock mr-2"></i>Expired: {{ $pengumuman->expires_at->format('d F Y') }}
                    </div>
                @endif
            </div>

            <!-- Title -->
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $pengumuman->title }}</h1>
                <p class="text-sm text-gray-400 font-mono">Slug: {{ $pengumuman->slug }}</p>
            </div>

            <!-- Content -->
            <div class="prose max-w-none">
                <div class="text-gray-700 leading-relaxed whitespace-pre-line">
                    {{ $pengumuman->content }}
                </div>
            </div>

            <!-- Meta Info -->
            <div class="pt-6 border-t border-gray-100 grid grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="text-gray-500">Dibuat:</span>
                    <span class="text-gray-900 ml-2">{{ $pengumuman->created_at->format('d M Y H:i') }}</span>
                </div>
                <div>
                    <span class="text-gray-500">Terakhir diupdate:</span>
                    <span class="text-gray-900 ml-2">{{ $pengumuman->updated_at->format('d M Y H:i') }}</span>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="bg-gray-50 px-8 py-4 flex justify-between items-center border-t border-gray-100">
            <a href="{{ route('admin.pengumumans.index') }}" class="px-4 py-2 text-gray-700 hover:text-gray-900 font-medium">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            <div class="flex space-x-3">
                <a href="{{ route('admin.pengumumans.edit', $pengumuman->id) }}" class="px-4 py-2 bg-yellow-50 text-yellow-600 rounded-lg hover:bg-yellow-100 transition-colors font-medium">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <form action="{{ route('admin.pengumumans.destroy', $pengumuman->id) }}" method="POST" class="inline" 
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')">
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
