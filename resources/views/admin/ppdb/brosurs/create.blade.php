@extends('layouts.admin')
@section('title', 'Tambah Brosur PPDB')
@section('page-title', 'Tambah Brosur PPDB')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
        <form action="{{ route('admin.ppdb_brosurs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="p-6 space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Judul <span class="text-red-500">*</span></label>
                    <input type="text" name="judul" value="{{ old('judul') }}" class="w-full px-4 py-2 border rounded-lg @error('judul') border-red-500 @enderror" required>
                    @error('judul')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Ajaran <span class="text-red-500">*</span></label>
                        <input type="text" name="tahun_ajaran" value="{{ old('tahun_ajaran', date('Y').'/'.((int)date('Y')+1)) }}" class="w-full px-4 py-2 border rounded-lg" placeholder="2025/2026" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Order</label>
                        <input type="number" name="order" value="{{ old('order', 0) }}" class="w-full px-4 py-2 border rounded-lg" min="0">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">File PDF <span class="text-red-500">*</span></label>
                    <input type="file" name="file_path" accept=".pdf" class="w-full" required>
                    <p class="text-xs text-gray-500 mt-1">Max 10MB</p>
                    @error('file_path')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Cover (Opsional)</label>
                    <input type="file" name="path_gambar_brosur" accept="image/*" class="w-full">
                    <p class="text-xs text-gray-500 mt-1">Max 2MB. Format: JPG, PNG, GIF</p>
                    @error('path_gambar_brosur')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="deskripsi" rows="4" class="w-full px-4 py-2 border rounded-lg">{{ old('deskripsi') }}</textarea>
                </div>
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }} class="rounded">
                        <span class="ml-2 text-sm">Aktif</span>
                    </label>
                </div>
            </div>
            <div class="bg-gray-50 px-6 py-4 flex justify-between border-t">
                <a href="{{ route('admin.ppdb_brosurs.index') }}" class="px-4 py-2 text-gray-700"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg"><i class="fas fa-save mr-2"></i>Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
