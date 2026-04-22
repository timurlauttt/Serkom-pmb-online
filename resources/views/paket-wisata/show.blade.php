@extends('layouts.admin')

@section('title', 'Detail Paket Wisata')
@section('page-title', 'Detail Paket Wisata')
@section('page-description', 'Lihat detail paket wisata')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 space-y-4">
            @if($paketWisata->gambar)
            <div>
                <img src="{{ asset($paketWisata->gambar) }}" alt="Foto Paket" class="w-full h-48 object-cover rounded mb-4">
            </div>
            @endif
            <div>
                <span class="block text-xs text-gray-500 mb-1">Nama Paket</span>
                <div class="font-semibold text-gray-800">{{ $paketWisata->nama_paket }}</div>
            </div>
            <div>
                <span class="block text-xs text-gray-500 mb-1">Kategori</span>
                <div class="text-gray-700">{{ $paketWisata->kategori ?? '-' }}</div>
            </div>
            <div>
                <span class="block text-xs text-gray-500 mb-1">Durasi</span>
                <div class="text-gray-700">{{ $paketWisata->durasi_hari }} hari</div>
            </div>
            <div>
                <span class="block text-xs text-gray-500 mb-1">Harga</span>
                <div class="text-gray-700">Rp {{ number_format($paketWisata->harga,0,',','.') }}</div>
            </div>
            <div>
                <span class="block text-xs text-gray-500 mb-1">Akomodasi/Hotel</span>
                <div class="text-gray-700">
                    @if($paketWisata->akomodasi && is_array($paketWisata->akomodasi) && count($paketWisata->akomodasi) > 0)
                        <ul class="list-disc list-inside">
                            @foreach($paketWisata->akomodasi as $hotel)
                                <li>{{ $hotel }}</li>
                            @endforeach
                        </ul>
                    @else
                        -
                    @endif
                </div>
            </div>
            <div>
                <span class="block text-xs text-gray-500 mb-1">Objek Wisata</span>
                <div class="text-gray-700">
                    @if($paketWisata->objek_wisata && is_array($paketWisata->objek_wisata) && count($paketWisata->objek_wisata) > 0)
                        <ul class="list-disc list-inside">
                            @foreach($paketWisata->objek_wisata as $objek)
                                <li>{{ $objek }}</li>
                            @endforeach
                        </ul>
                    @else
                        -
                    @endif
                </div>
            </div>
            <div>
                <span class="block text-xs text-gray-500 mb-1">Slug</span>
                <div class="text-xs text-gray-500 font-mono">{{ $paketWisata->slug }}</div>
            </div>
            <div>
                <span class="block text-xs text-gray-500 mb-1">Keterangan</span>
                <div class="text-gray-700">{{ $paketWisata->keterangan }}</div>
            </div>
        </div>
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end">
            <a href="{{ route('admin.paket-wisata.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-gray-700 hover:bg-gray-300">Kembali</a>
        </div>
    </div>
</div>
@endsection
