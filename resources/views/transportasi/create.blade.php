@extends('layouts.admin')

@section('title', 'Tambah Transportasi')
@section('page-title', 'Tambah Transportasi')
@section('page-description', 'Buat data transportasi baru')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.transportasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="p-6 space-y-6">
                <div>
                    <label for="jenis" class="block text-sm font-medium text-gray-700 mb-2">Jenis Transportasi <span class="text-red-500">*</span></label>
                    <input type="text" name="jenis" id="jenis" value="{{ old('jenis') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('jenis') border-red-500 @enderror" placeholder="Contoh: Mobil, Bus, Motor" required>
                    @error('jenis')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="nama_provider" class="block text-sm font-medium text-gray-700 mb-2">Nama Provider <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_provider" id="nama_provider" value="{{ old('nama_provider') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('nama_provider') border-red-500 @enderror" placeholder="Contoh: PT. Trans Jaya" required>
                    @error('nama_provider')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="harga" class="block text-sm font-medium text-gray-700 mb-2">Harga <span class="text-red-500">*</span></label>
                    <input type="number" name="harga" id="harga" value="{{ old('harga') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('harga') border-red-500 @enderror" placeholder="Contoh: 500000" min="0" required>
                    @error('harga')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="kontak" class="block text-sm font-medium text-gray-700 mb-2">Kontak</label>
                    <input type="text" name="kontak" id="kontak" value="{{ old('kontak') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('kontak') border-red-500 @enderror" placeholder="Contoh: 081234567890">
                    @error('kontak')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">Gambar</label>
                    <input type="file" name="gambar" id="gambar" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" accept="image/*" onchange="previewImage(event)">
                    <div id="imagePreview" class="mt-4 hidden">
                        <img src="" alt="Preview Gambar" class="w-full h-48 object-cover rounded-lg">
                    </div>
                    @error('gambar')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end space-x-2">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Simpan</button>
                <a href="{{ route('admin.transportasi.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-gray-700 hover:bg-gray-300">Batal</a>
            </div>
        </form>
    </div>
</div>
@push('scripts')
<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const preview = document.getElementById('imagePreview');
        const img = preview.querySelector('img');
        img.src = reader.result;
        preview.classList.remove('hidden');
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endpush
@endsection
