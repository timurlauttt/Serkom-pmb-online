@extends('layouts.admin')

@section('title', 'Edit Desa Wisata')
@section('page-title', 'Edit Desa Wisata')
@section('page-description', 'Ubah data desa wisata')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.desa-wisata.update', ['desa_wisatum' => $desawisata->slug]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-6">
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama', $desawisata->nama) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('nama') border-red-500 @enderror" required>
                    @error('nama')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat <span class="text-red-500">*</span></label>
                    <input type="text" name="alamat" id="alamat" value="{{ old('alamat', $desawisata->alamat) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('alamat') border-red-500 @enderror" required>
                    @error('alamat')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="kota" class="block text-sm font-medium text-gray-700 mb-2">Kota <span class="text-red-500">*</span></label>
                    <input type="text" name="kota" id="kota" value="{{ old('kota', $desawisata->kota) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('kota') border-red-500 @enderror" required>
                    @error('kota')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="6" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi', $desawisata->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="harga_tiket" class="block text-sm font-medium text-gray-700 mb-2">Harga Tiket</label>
                    <input type="number" name="harga_tiket" id="harga_tiket" value="{{ old('harga_tiket', $desawisata->harga_tiket) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('harga_tiket') border-red-500 @enderror" min="0">
                    @error('harga_tiket')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="jam_operasional" class="block text-sm font-medium text-gray-700 mb-2">Jam Operasional</label>
                    <input type="text" name="jam_operasional" id="jam_operasional" value="{{ old('jam_operasional', $desawisata->jam_operasional) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('jam_operasional') border-red-500 @enderror" placeholder="Contoh: 08:00 - 17:00">
                    @error('jam_operasional')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">Gambar</label>
                    <input type="file" name="gambar" id="gambar" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" accept="image/*" onchange="previewImage(event)">
                    <div id="imagePreview" class="mt-2 {{ $desawisata->gambar ? '' : 'hidden' }}">
                        <img src="{{ $desawisata->gambar ? asset($desawisata->gambar) : '' }}" alt="Gambar" class="h-24 rounded">
                    </div>
                    @error('gambar')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end space-x-2">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Update</button>
                <a href="{{ route('admin.desa-wisata.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-gray-700 hover:bg-gray-300">Batal</a>
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
