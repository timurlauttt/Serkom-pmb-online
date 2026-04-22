@extends('layouts.admin')

@section('title', 'Tambah Prestasi')
@section('page-title', 'Tambah Prestasi')
@section('page-description', 'Tambah prestasi siswa baru')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.prestasis.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="p-6 space-y-6">
                <div>
                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">
                        Judul Prestasi <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="judul" id="judul" value="{{ old('judul') }}" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('judul') border-red-500 @enderror"
                           placeholder="Contoh: Juara 1 Lomba Robotika" required>
                    @error('judul')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="tingkat" class="block text-sm font-medium text-gray-700 mb-2">
                            Tingkat <span class="text-red-500">*</span>
                        </label>
                        <select name="tingkat" id="tingkat" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('tingkat') border-red-500 @enderror" required>
                            <option value="">Pilih Tingkat</option>
                            @foreach($tingkatOptions as $tingkat)
                                <option value="{{ $tingkat }}" {{ old('tingkat') == $tingkat ? 'selected' : '' }}>{{ ucfirst($tingkat) }}</option>
                            @endforeach
                        </select>
                        @error('tingkat')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="peringkat" class="block text-sm font-medium text-gray-700 mb-2">
                            Peringkat
                        </label>
                        <input type="text" name="peringkat" id="peringkat" value="{{ old('peringkat') }}" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Contoh: Juara 1">
                    </div>

                    <div>
                        <label for="tahun" class="block text-sm font-medium text-gray-700 mb-2">
                            Tahun <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="tahun" id="tahun" value="{{ old('tahun', date('Y')) }}" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('tahun') border-red-500 @enderror"
                               min="1900" max="{{ date('Y') + 1 }}" required>
                        @error('tahun')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nama_siswa" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Siswa
                        </label>
                        <input type="text" name="nama_siswa" id="nama_siswa" value="{{ old('nama_siswa') }}" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Nama siswa yang berprestasi">
                    </div>

                    <div>
                        <label for="jurusan_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Jurusan
                        </label>
                        <select name="jurusan_id" id="jurusan_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Umum --</option>
                            @foreach($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}" {{ old('jurusan_id') == $jurusan->id ? 'selected' : '' }}>{{ $jurusan->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label for="penyelenggara" class="block text-sm font-medium text-gray-700 mb-2">
                        Penyelenggara
                    </label>
                    <input type="text" name="penyelenggara" id="penyelenggara" value="{{ old('penyelenggara') }}" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Contoh: Dinas Pendidikan">
                </div>

                <div>
                    <label class="flex items-center">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} 
                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-700">Tampilkan sebagai prestasi unggulan</span>
                    </label>
                </div>

                <div>
                    <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-2">
                        Thumbnail
                    </label>
                    <div class="flex items-center space-x-4">
                        <label class="flex-1 flex flex-col items-center px-4 py-6 bg-white border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:border-blue-500 transition-colors">
                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                            <span class="text-sm text-gray-600">Klik untuk upload gambar</span>
                            <span class="text-xs text-gray-400 mt-1">PNG, JPG up to 5MB</span>
                            <input type="file" name="thumbnail" id="thumbnail" class="hidden" accept="image/*" onchange="previewImage(event)">
                        </label>
                    </div>
                    <div id="imagePreview" class="mt-4 hidden">
                        <img src="" alt="Preview" class="w-full h-48 object-cover rounded-lg">
                    </div>
                    @error('thumbnail')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi <span class="text-red-500">*</span>
                    </label>
                    <textarea name="deskripsi" id="deskripsi" rows="6" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('deskripsi') border-red-500 @enderror"
                              placeholder="Deskripsi prestasi..." required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-t border-gray-100">
                <a href="{{ route('admin.prestasis.index') }}" class="px-4 py-2 text-gray-700 hover:text-gray-900 font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <button type="submit" class="px-6 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg hover:shadow-lg transition-all font-medium">
                    <i class="fas fa-save mr-2"></i>Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imagePreview').classList.remove('hidden');
            document.getElementById('imagePreview').querySelector('img').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endpush
