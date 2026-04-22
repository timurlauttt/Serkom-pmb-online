@extends('layouts.admin')
@section('title', 'Edit Brosur PPDB')
@section('page-title', 'Edit Brosur PPDB')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
        <form action="{{ route('admin.ppdb_brosurs.update', $ppdbBrosur->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Judul <span class="text-red-500">*</span></label>
                    <input type="text" name="judul" value="{{ old('judul', $ppdbBrosur->judul) }}" class="w-full px-4 py-2 border rounded-lg" required>
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Ajaran <span class="text-red-500">*</span></label>
                        <input type="text" name="tahun_ajaran" value="{{ old('tahun_ajaran', $ppdbBrosur->tahun_ajaran) }}" class="w-full px-4 py-2 border rounded-lg" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Order</label>
                        <input type="number" name="order" value="{{ old('order', $ppdbBrosur->order) }}" class="w-full px-4 py-2 border rounded-lg" min="0">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">File PDF</label>
                    @if($ppdbBrosur->file_path)
                        <div class="mb-2">
                            <a href="{{ asset($ppdbBrosur->file_path) }}" target="_blank" class="text-blue-600"><i class="fas fa-file-pdf mr-1"></i>Lihat file saat ini</a>
                        </div>
                    @endif
                    <input type="file" name="file_path" accept=".pdf" class="w-full">
                    <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah file</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Cover</label>
                    @if($ppdbBrosur->path_gambar_brosur)
                        <div class="mb-2">
                            <img src="{{ asset($ppdbBrosur->path_gambar_brosur) }}" alt="Current Image" class="h-32 object-contain border rounded-lg">
                        </div>
                    @endif
                    <input type="file" name="path_gambar_brosur" accept="image/*" class="w-full">
                    <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah gambar. Max 2MB. Format: JPG, PNG, GIF</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="deskripsi" rows="4" class="w-full px-4 py-2 border rounded-lg">{{ old('deskripsi', $ppdbBrosur->deskripsi) }}</textarea>
                </div>
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $ppdbBrosur->is_active) ? 'checked' : '' }} class="rounded">
                        <span class="ml-2 text-sm">Aktif</span>
                    </label>
                </div>
            </div>
            <div class="bg-gray-50 px-6 py-4 flex justify-between border-t">
                <a href="{{ route('admin.ppdb_brosurs.index') }}" class="px-4 py-2 text-gray-700"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg"><i class="fas fa-save mr-2"></i>Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
