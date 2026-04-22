@extends('layouts.admin')
@section('title', 'Tambah Link PPDB')
@section('page-title', 'Tambah Link PPDB')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
        <form action="{{ route('admin.ppdb_links.store') }}" method="POST">
            @csrf
            <div class="p-6 space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Link <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_link" value="{{ old('nama_link') }}" class="w-full px-4 py-2 border rounded-lg" placeholder="Contoh: Form Pendaftaran Online" required>
                    @error('nama_link')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">URL <span class="text-red-500">*</span></label>
                    <input type="url" name="url" value="{{ old('url') }}" class="w-full px-4 py-2 border rounded-lg" placeholder="https://..." required>
                    @error('url')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis <span class="text-red-500">*</span></label>
                        <select name="jenis" class="w-full px-4 py-2 border rounded-lg" required>
                            @foreach($jenisOptions as $jenis)
                                <option value="{{ $jenis }}" {{ old('jenis') == $jenis ? 'selected' : '' }}>{{ ucfirst($jenis) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Order</label>
                        <input type="number" name="order" value="{{ old('order', 0) }}" class="w-full px-4 py-2 border rounded-lg" min="0">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" class="w-full px-4 py-2 border rounded-lg">{{ old('deskripsi') }}</textarea>
                </div>
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }} class="rounded">
                        <span class="ml-2 text-sm">Aktif</span>
                    </label>
                </div>
            </div>
            <div class="bg-gray-50 px-6 py-4 flex justify-between border-t">
                <a href="{{ route('admin.ppdb_links.index') }}" class="px-4 py-2 text-gray-700"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg"><i class="fas fa-save mr-2"></i>Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
