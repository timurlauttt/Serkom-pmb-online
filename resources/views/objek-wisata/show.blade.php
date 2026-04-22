@extends('layouts.admin')

@section('title', 'Detail Objek Wisata')
@section('page-title', 'Detail Objek Wisata')
@section('page-description', 'Lihat detail objek wisata')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 space-y-4">
            @if($objekWisata->gambar)
            <div>
                <img src="{{ asset($objekWisata->gambar) }}" alt="Foto Objek Wisata" class="w-full h-48 object-cover rounded mb-4">
            </div>
            @endif
            <div>
                <span class="block text-xs text-gray-500 mb-1">Nama</span>
                <div class="font-semibold text-gray-800">{{ $objekWisata->nama }}</div>
            </div>
            <div>
                <span class="block text-xs text-gray-500 mb-1">Alamat</span>
                <div class="text-gray-700">{{ $objekWisata->alamat }}</div>
            </div>
            <div>
                <span class="block text-xs text-gray-500 mb-1">Kota</span>
                <div class="text-gray-700">{{ $objekWisata->kota }}</div>
            </div>
            <div>
                <span class="block text-xs text-gray-500 mb-1">Harga Tiket</span>
                <div class="text-gray-700">{{ $objekWisata->harga_tiket ? 'Rp ' . number_format($objekWisata->harga_tiket,0,',','.') : '-' }}</div>
            </div>
            <div>
                <span class="block text-xs text-gray-500 mb-1">Jam Operasional</span>
                <div class="text-gray-700">{{ $objekWisata->jam_operasional ?? '-' }}</div>
            </div>
            <div>
                <span class="block text-xs text-gray-500 mb-1">Slug</span>
                <div class="text-xs text-gray-500 font-mono">{{ $objekWisata->slug }}</div>
            </div>
            <div>
                <span class="block text-xs text-gray-500 mb-1">Deskripsi</span>
                <div class="text-gray-700">{{ $objekWisata->deskripsi }}</div>
            </div>
        </div>
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end">
            <a href="{{ route('admin.objek-wisata.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-gray-700 hover:bg-gray-300">Kembali</a>
        </div>
    </div>
</div>
@endsection
