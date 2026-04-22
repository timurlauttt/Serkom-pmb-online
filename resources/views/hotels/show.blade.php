@extends('layouts.admin')

@section('title', 'Detail Hotel')
@section('page-title', 'Detail Hotel')
@section('page-description', 'Lihat detail hotel')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 space-y-4">
            @if($hotel->gambar)
            <div>
                <img src="{{ asset($hotel->gambar) }}" alt="Foto Hotel" class="w-full h-48 object-cover rounded mb-4">
            </div>
            @endif
            <div>
                <span class="block text-xs text-gray-500 mb-1">Nama</span>
                <div class="font-semibold text-gray-800">{{ $hotel->nama }}</div>
            </div>
            <div>
                <span class="block text-xs text-gray-500 mb-1">Alamat</span>
                <div class="text-gray-700">{{ $hotel->alamat }}</div>
            </div>
            <div>
                <span class="block text-xs text-gray-500 mb-1">Kota</span>
                <div class="text-gray-700">{{ $hotel->kota }}</div>
            </div>
            <div>
                <span class="block text-xs text-gray-500 mb-1">Kontak</span>
                <div class="text-gray-700">{{ $hotel->kontak }}</div>
            </div>
            <div>
                <span class="block text-xs text-gray-500 mb-1">Harga Mulai</span>
                <div class="text-gray-700">{{ $hotel->harga_mulai ? 'Rp ' . number_format($hotel->harga_mulai,0,',','.') : '-' }}</div>
            </div>
            <div>
                <span class="block text-xs text-gray-500 mb-1">Slug</span>
                <div class="text-xs text-gray-500 font-mono">{{ $hotel->slug }}</div>
            </div>
            <div>
                <span class="block text-xs text-gray-500 mb-1">Deskripsi</span>
                <div class="text-gray-700">{{ $hotel->deskripsi }}</div>
            </div>
        </div>
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end">
            <a href="{{ route('admin.hotels.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-gray-700 hover:bg-gray-300">Kembali</a>
        </div>
    </div>
</div>
@endsection
