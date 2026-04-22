@extends('layouts.admin')

@section('title', 'Detail Berita')
@section('page-title', 'Detail Berita')
@section('page-description', 'Informasi lengkap berita')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <!-- Image Header -->
        @if($berita->image_path)
            <div class="h-96 bg-gray-200 overflow-hidden">
                <img src="{{ asset($berita->image_path) }}" alt="{{ $berita->title }}" class="w-full h-full object-cover">
            </div>
        @endif

        <div class="p-8 space-y-6">
            <!-- Header Info -->
            <div class="flex items-center justify-between pb-6 border-b border-gray-100">
                <div class="flex items-center space-x-3">
                    <span class="px-4 py-1 bg-blue-100 text-blue-800 text-sm font-semibold rounded-full">
                        {{ $berita->category }}
                    </span>
                    @if($berita->jurusan)
                        <span class="px-4 py-1 bg-yellow-100 text-yellow-800 text-sm font-semibold rounded-full">Jurusan: {{ $berita->jurusan->name }}</span>
                    @else
                        <span class="px-4 py-1 bg-gray-100 text-gray-600 text-sm font-semibold rounded-full">Umum</span>
                    @endif
                    <span class="text-gray-500 text-sm">
                        <i class="fas fa-calendar mr-2"></i>{{ $berita->posted_at ? $berita->posted_at->format('d F Y') : '-' }}
                    </span>
                </div>
                <div class="text-gray-500 text-sm">
                    <i class="fas fa-user mr-2"></i>{{ $berita->author }}
                </div>
            </div>

            <!-- Title -->
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $berita->title }}</h1>
                <p class="text-sm text-gray-400 font-mono">Slug: {{ $berita->slug }}</p>
            </div>

            <!-- Content -->
            <div class="prose max-w-none">
                <div class="text-gray-700 leading-relaxed whitespace-pre-line">
                    {{ $berita->content }}
                </div>
                @php
                    $hashtags = $berita->hashtags;
                    if (is_string($hashtags)) {
                        $decoded = json_decode($hashtags, true);
                        if (is_array($decoded)) $hashtags = $decoded;
                        else $hashtags = [];
                    }
                @endphp
                @if($hashtags && is_array($hashtags) && count($hashtags))
                    <div class="mt-4">
                        <span class="text-xs text-gray-500 mr-2">Hashtag:</span>
                        @foreach($hashtags as $tag)
                            <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded mr-1">#{{ ltrim($tag, '#') }}</span>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Meta Info -->
            <div class="pt-6 border-t border-gray-100 grid grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="text-gray-500">Dibuat:</span>
                    <span class="text-gray-900 ml-2">{{ $berita->created_at->format('d M Y H:i') }}</span>
                </div>
                <div>
                    <span class="text-gray-500">Terakhir diupdate:</span>
                    <span class="text-gray-900 ml-2">{{ $berita->updated_at->format('d M Y H:i') }}</span>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="bg-gray-50 px-8 py-4 flex justify-between items-center border-t border-gray-100">
            <a href="{{ route('admin.beritas.index') }}" class="px-4 py-2 text-gray-700 hover:text-gray-900 font-medium">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            <div class="flex space-x-3">
                <a href="{{ route('admin.beritas.edit', $berita->slug) }}" class="px-4 py-2 bg-yellow-50 text-yellow-600 rounded-lg hover:bg-yellow-100 transition-colors font-medium">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <form action="{{ route('admin.beritas.destroy', $berita->slug) }}" method="POST" class="inline" 
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
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
