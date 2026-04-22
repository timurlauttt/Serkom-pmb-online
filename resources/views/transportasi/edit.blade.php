@extends('layouts.admin')

@section('title', 'Edit Transportasi')
@section('page-title', 'Edit Transportasi')
@section('page-description', 'Ubah data transportasi')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.transportasi.update', $transportasi->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-6">
                <div>
                    <label for="jenis" class="block text-sm font-medium text-gray-700 mb-2">Jenis Transportasi <span class="text-red-500">*</span></label>
                    <input type="text" name="jenis" id="jenis" value="{{ old('jenis', $transportasi->jenis) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('jenis') border-red-500 @enderror" placeholder="Contoh: Mobil, Bus, Motor" required>
                    @error('jenis')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="nama_provider" class="block text-sm font-medium text-gray-700 mb-2">Nama Provider <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_provider" id="nama_provider" value="{{ old('nama_provider', $transportasi->nama_provider) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('nama_provider') border-red-500 @enderror" placeholder="Contoh: PT. Trans Jaya" required>
                    @error('nama_provider')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="harga" class="block text-sm font-medium text-gray-700 mb-2">Harga <span class="text-red-500">*</span></label>
                    <input type="number" name="harga" id="harga" value="{{ old('harga', $transportasi->harga) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('harga') border-red-500 @enderror" placeholder="Contoh: 500000" min="0" required>
                    @error('harga')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="kontak" class="block text-sm font-medium text-gray-700 mb-2">Kontak</label>
                    <input type="text" name="kontak" id="kontak" value="{{ old('kontak', $transportasi->kontak) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('kontak') border-red-500 @enderror" placeholder="Contoh: 081234567890">
                    @error('kontak')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">Gambar</label>
                    @if($transportasi->gambar)
                        <div class="mb-4">
                            <img src="{{ asset($transportasi->gambar) }}" alt="Gambar Transportasi" class="w-full h-48 object-cover rounded-lg">
                        </div>
                    @endif
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
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Update</button>
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

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="flex items-center mb-6">
            <a href="{{ route('admin.transportasi.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
            <h1 class="text-3xl font-bold text-gray-800">Edit Transportasi</h1>
        </div>

        <div class="bg-white rounded-2xl shadow-xl p-8">
            <form action="{{ route('admin.transportasi.update', $transportasi->slug) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label for="jenis" class="block text-gray-700 text-sm font-bold mb-2">
                        Jenis Transportasi <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="jenis" 
                           id="jenis" 
                           value="{{ old('jenis', $transportasi->jenis) }}"
                           class="shadow-sm appearance-none border @error('jenis') border-red-500 @else border-gray-300 @enderror rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="Contoh: Mobil, Bus, Motor">
                    @error('jenis')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="nama_provider" class="block text-gray-700 text-sm font-bold mb-2">
                        Nama Provider <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="nama_provider" 
                           id="nama_provider" 
                           value="{{ old('nama_provider', $transportasi->nama_provider) }}"
                           class="shadow-sm appearance-none border @error('nama_provider') border-red-500 @else border-gray-300 @enderror rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="Contoh: PT. Trans Jaya">
                    @error('nama_provider')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="harga" class="block text-gray-700 text-sm font-bold mb-2">
                        Harga <span class="text-red-500">*</span>
                    </label>
                    <input type="number" 
                           name="harga" 
                           id="harga" 
                           value="{{ old('harga', $transportasi->harga) }}"
                           class="shadow-sm appearance-none border @error('harga') border-red-500 @else border-gray-300 @enderror rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="Contoh: 500000">
                    @error('harga')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="kontak" class="block text-gray-700 text-sm font-bold mb-2">
                        Kontak <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="kontak" 
                           id="kontak" 
                           value="{{ old('kontak', $transportasi->kontak) }}"
                           class="shadow-sm appearance-none border @error('kontak') border-red-500 @else border-gray-300 @enderror rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="Contoh: 081234567890">
                    @error('kontak')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="gambar" class="block text-gray-700 text-sm font-bold mb-2">
                        Gambar
                    </label>
                    @if($transportasi->gambar)
                        <div class="mb-4">
                            <img src="{{ asset($transportasi->gambar) }}" alt="{{ $transportasi->nama_provider }}" class="max-w-xs rounded-lg shadow-lg">
                            <p class="text-sm text-gray-600 mt-2">Gambar saat ini</p>
                        </div>
                    @endif
                    <input type="file" 
                           name="gambar" 
                           id="gambar" 
                           accept="image/*"
                           class="shadow-sm appearance-none border @error('gambar') border-red-500 @else border-gray-300 @enderror rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           onchange="previewImage(event)">
                    <p class="text-sm text-gray-600 mt-1">Biarkan kosong jika tidak ingin mengubah gambar</p>
                    @error('gambar')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                    <div id="imagePreview" class="mt-4 hidden">
                        <img id="preview" src="" alt="Preview" class="max-w-xs rounded-lg shadow-lg">
                    </div>
                </div>

                <div class="flex items-center justify-between pt-4">
                    <a href="{{ route('admin.transportasi.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-300">
                        Batal
                    </a>
                    <button type="submit" class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-300 shadow-lg">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('preview');
    const previewContainer = document.getElementById('imagePreview');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    } else {
        previewContainer.classList.add('hidden');
    }
}
</script>
@endsection
