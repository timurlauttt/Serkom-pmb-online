@extends('layouts.admin')

@section('title', 'Detail Transportasi')
@section('page-title', 'Detail Transportasi')
@section('page-description', 'Informasi lengkap transportasi')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 space-y-6">
            @if($transportasi->gambar)
                <div>
                    <img src="{{ asset($transportasi->gambar) }}" alt="Gambar Transportasi" class="w-full h-64 object-cover rounded-lg">
                </div>
            @endif
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Jenis Transportasi</label>
                    <p class="text-gray-900 font-medium">{{ $transportasi->jenis }}</p>
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Nama Provider</label>
                    <p class="text-gray-900 font-medium">{{ $transportasi->nama_provider }}</p>
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Harga</label>
                    <p class="text-gray-900 font-medium">Rp {{ number_format($transportasi->harga, 0, ',', '.') }}</p>
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Kontak</label>
                    <p class="text-gray-900 font-medium">{{ $transportasi->kontak ?? '-' }}</p>
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Slug</label>
                    <p class="text-gray-900 font-medium">{{ $transportasi->slug }}</p>
                </div>
            </div>
        </div>
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end">
            <a href="{{ route('admin.transportasi.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-gray-700 hover:bg-gray-300">Kembali</a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <a href="{{ route('admin.transportasi.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">
                    <i class="fas fa-arrow-left text-xl"></i>
                </a>
                <h1 class="text-3xl font-bold text-gray-800">Detail Transportasi</h1>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('admin.transportasi.edit', $transportasi->slug) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg transition duration-300">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <form action="{{ route('admin.transportasi.destroy', $transportasi->slug) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transportasi ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition duration-300">
                        <i class="fas fa-trash mr-2"></i>Hapus
                    </button>
                </form>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            @if($transportasi->gambar)
                <div class="w-full h-96 overflow-hidden">
                    <img src="{{ asset($transportasi->gambar) }}" alt="{{ $transportasi->nama_provider }}" class="w-full h-full object-cover">
                </div>
            @endif

            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="mb-4">
                        <h3 class="text-sm font-semibold text-gray-600 uppercase mb-2">Jenis Transportasi</h3>
                        <p class="text-lg text-gray-900">{{ $transportasi->jenis }}</p>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-sm font-semibold text-gray-600 uppercase mb-2">Nama Provider</h3>
                        <p class="text-lg text-gray-900">{{ $transportasi->nama_provider }}</p>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-sm font-semibold text-gray-600 uppercase mb-2">Harga</h3>
                        <p class="text-lg text-gray-900">Rp {{ number_format($transportasi->harga, 0, ',', '.') }}</p>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-sm font-semibold text-gray-600 uppercase mb-2">Kontak</h3>
                        <p class="text-lg text-gray-900">{{ $transportasi->kontak }}</p>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="flex justify-between text-sm text-gray-600">
                        <div>
                            <span class="font-semibold">Dibuat:</span> {{ $transportasi->created_at->format('d M Y H:i') }}
                        </div>
                        <div>
                            <span class="font-semibold">Diperbarui:</span> {{ $transportasi->updated_at->format('d M Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
