@extends('layouts.admin')

@section('title', 'Edit Paket Wisata')
@section('page-title', 'Edit Paket Wisata')
@section('page-description', 'Ubah data paket wisata')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.paket-wisata.update', ['paket_wisatum' => $paketWisata->slug]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-6">
                <div>
                    <label for="nama_paket" class="block text-sm font-medium text-gray-700 mb-2">Nama Paket <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_paket" id="nama_paket" value="{{ old('nama_paket', $paketWisata->nama_paket) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('nama_paket') border-red-500 @enderror" required>
                    @error('nama_paket')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                    <input type="text" name="kategori" id="kategori" value="{{ old('kategori', $paketWisata->kategori) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('kategori') border-red-500 @enderror" placeholder="Contoh: Wisata Keluarga, Wisata Edukasi, dll" required>
                    @error('kategori')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="durasi_hari" class="block text-sm font-medium text-gray-700 mb-2">Durasi (Hari) <span class="text-red-500">*</span></label>
                    <input type="number" name="durasi_hari" id="durasi_hari" value="{{ old('durasi_hari', $paketWisata->durasi_hari) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('durasi_hari') border-red-500 @enderror" min="1" required>
                    @error('durasi_hari')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="harga" class="block text-sm font-medium text-gray-700 mb-2">Harga <span class="text-red-500">*</span></label>
                    <input type="number" name="harga" id="harga" value="{{ old('harga', $paketWisata->harga) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('harga') border-red-500 @enderror" min="0" required>
                    @error('harga')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Akomodasi/Hotel (Array) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Akomodasi/Hotel <span class="text-gray-400 text-xs">(tambahkan atau hapus sesuai kebutuhan)</span>
                    </label>
                    @php
                    $oldAkomodasi = old('akomodasi', $paketWisata->akomodasi ?? ['']);
                    if(!is_array($oldAkomodasi)) $oldAkomodasi = [''];
                    if(empty($oldAkomodasi)) $oldAkomodasi = [''];
                    @endphp

                    <div id="akomodasiList" class="space-y-2">
                        @foreach($oldAkomodasi as $item)
                        <div class="flex items-center space-x-2">
                            <input type="text" name="akomodasi[]" value="{{ $item }}" placeholder="Nama hotel/penginapan"
                                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                            <button type="button" class="remove-akomodasi inline-flex items-center justify-center px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors text-sm font-medium">
                                &minus;
                            </button>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-3">
                        <button type="button" id="addAkomodasi" class="px-4 py-2 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-100 transition-colors text-sm font-medium">
                            <i class="fas fa-plus mr-2"></i>Tambah Akomodasi
                        </button>
                    </div>
                    @error('akomodasi')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Objek Wisata (Array) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Objek Wisata <span class="text-gray-400 text-xs">(tambahkan atau hapus sesuai kebutuhan)</span>
                    </label>
                    @php
                    $oldObjekWisata = old('objek_wisata', $paketWisata->objek_wisata ?? ['']);
                    if(!is_array($oldObjekWisata)) $oldObjekWisata = [''];
                    if(empty($oldObjekWisata)) $oldObjekWisata = [''];
                    @endphp

                    <div id="objekWisataList" class="space-y-2">
                        @foreach($oldObjekWisata as $item)
                        <div class="flex items-center space-x-2">
                            <input type="text" name="objek_wisata[]" value="{{ $item }}" placeholder="Nama objek wisata"
                                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                            <button type="button" class="remove-objek-wisata inline-flex items-center justify-center px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors text-sm font-medium">
                                &minus;
                            </button>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-3">
                        <button type="button" id="addObjekWisata" class="px-4 py-2 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-100 transition-colors text-sm font-medium">
                            <i class="fas fa-plus mr-2"></i>Tambah Objek Wisata
                        </button>
                    </div>
                    @error('objek_wisata')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" rows="6" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('keterangan') border-red-500 @enderror">{{ old('keterangan', $paketWisata->keterangan) }}</textarea>
                    @error('keterangan')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">Gambar</label>
                    <input type="file" name="gambar" id="gambar" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" accept="image/*" onchange="previewImage(event)">
                    <div id="imagePreview" class="mt-2 {{ $paketWisata->gambar ? '' : 'hidden' }}">
                        <img src="{{ $paketWisata->gambar ? asset($paketWisata->gambar) : '' }}" alt="Gambar" class="h-24 rounded">
                    </div>
                    @error('gambar')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end space-x-2">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Update</button>
                <a href="{{ route('admin.paket-wisata.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-gray-700 hover:bg-gray-300">Batal</a>
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

// Akomodasi Array
document.getElementById('addAkomodasi').addEventListener('click', function() {
    const list = document.getElementById('akomodasiList');
    const div = document.createElement('div');
    div.className = 'flex items-center space-x-2';
    div.innerHTML = `
        <input type="text" name="akomodasi[]" value="" placeholder="Nama hotel/penginapan"
            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        <button type="button" class="remove-akomodasi inline-flex items-center justify-center px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors text-sm font-medium">
            &minus;
        </button>
    `;
    list.appendChild(div);
});

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-akomodasi')) {
        e.target.closest('div').remove();
    }
});

// Objek Wisata Array
document.getElementById('addObjekWisata').addEventListener('click', function() {
    const list = document.getElementById('objekWisataList');
    const div = document.createElement('div');
    div.className = 'flex items-center space-x-2';
    div.innerHTML = `
        <input type="text" name="objek_wisata[]" value="" placeholder="Nama objek wisata"
            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        <button type="button" class="remove-objek-wisata inline-flex items-center justify-center px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors text-sm font-medium">
            &minus;
        </button>
    `;
    list.appendChild(div);
});

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-objek-wisata')) {
        e.target.closest('div').remove();
    }
});
</script>
@endpush
@endsection
