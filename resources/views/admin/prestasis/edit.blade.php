@extends('layouts.admin')
@section('title', 'Edit Prestasi')
@section('page-title', 'Edit Prestasi')
@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
        <form action="{{ route('admin.prestasis.update', $prestasi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Judul <span class="text-red-500">*</span></label>
                    <input type="text" name="judul" value="{{ old('judul', $prestasi->judul) }}" class="w-full px-4 py-2 border rounded-lg" required>
                </div>
                <div class="grid grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tingkat <span class="text-red-500">*</span></label>
                        <select name="tingkat" class="w-full px-4 py-2 border rounded-lg" required>
                            @foreach($tingkatOptions as $t)
                                <option value="{{ $t }}" {{ $prestasi->tingkat == $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Peringkat</label>
                        <input type="text" name="peringkat" value="{{ old('peringkat', $prestasi->peringkat) }}" class="w-full px-4 py-2 border rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tahun <span class="text-red-500">*</span></label>
                        <input type="number" name="tahun" value="{{ old('tahun', $prestasi->tahun) }}" class="w-full px-4 py-2 border rounded-lg" required>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Siswa</label>
                        <input type="text" name="nama_siswa" value="{{ old('nama_siswa', $prestasi->nama_siswa) }}" class="w-full px-4 py-2 border rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jurusan</label>
                        <select name="jurusan_id" class="w-full px-4 py-2 border rounded-lg">
                            <option value="">-- Umum --</option>
                            @foreach($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}" {{ $prestasi->jurusan_id == $jurusan->id ? 'selected' : '' }}>{{ $jurusan->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Penyelenggara</label>
                    <input type="text" name="penyelenggara" value="{{ old('penyelenggara', $prestasi->penyelenggara) }}" class="w-full px-4 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" name="is_featured" value="1" {{ $prestasi->is_featured ? 'checked' : '' }} class="rounded">
                        <span class="ml-2 text-sm">Prestasi unggulan</span>
                    </label>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Thumbnail</label>
                    @if($prestasi->thumbnail)
                        <img src="{{ asset($prestasi->thumbnail) }}" class="w-32 h-32 object-cover rounded-lg mb-2">
                    @endif
                    <input type="file" name="thumbnail" accept="image/*" class="w-full">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi <span class="text-red-500">*</span></label>
                    <textarea name="deskripsi" rows="6" class="w-full px-4 py-2 border rounded-lg" required>{{ old('deskripsi', $prestasi->deskripsi) }}</textarea>
                </div>
            </div>
            <div class="bg-gray-50 px-6 py-4 flex justify-between border-t">
                <a href="{{ route('admin.prestasis.index') }}" class="px-4 py-2 text-gray-700"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg"><i class="fas fa-save mr-2"></i>Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
