@extends('layouts.admin')

@section('title', 'Edit Ekstrakurikuler')
@section('page-title', 'Edit Ekstrakurikuler')
@section('page-description', 'Edit data ekstrakurikuler')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.ekstrakurikulers.update', $ekstrakurikuler->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="p-6 space-y-6">
                <!-- Nama -->
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Ekstrakurikuler <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama', $ekstrakurikuler->nama) }}" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nama') border-red-500 @enderror"
                           placeholder="Contoh: Pramuka, Basket, PMR" required>
                    @error('nama')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Icon -->
                    <div>
                        <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">
                            Icon (FontAwesome)
                        </label>
                        <input type="text" name="icon" id="icon" value="{{ old('icon', $ekstrakurikuler->icon) }}" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="fas fa-star">
                        <p class="text-xs text-gray-400 mt-1">Contoh: fas fa-futbol, fas fa-basketball-ball</p>
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="is_active" class="block text-sm font-medium text-gray-700 mb-2">
                            Status
                        </label>
                        <select name="is_active" id="is_active" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="1" {{ old('is_active', $ekstrakurikuler->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('is_active', $ekstrakurikuler->is_active) == 0 ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Pembina -->
                    <div>
                        <label for="pembina" class="block text-sm font-medium text-gray-700 mb-2">
                            Pembina
                        </label>
                        <input type="text" name="pembina" id="pembina" value="{{ old('pembina', $ekstrakurikuler->pembina) }}" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Nama pembina">
                    </div>

                    <!-- Jadwal -->
                    <div>
                        <label for="jadwal" class="block text-sm font-medium text-gray-700 mb-2">
                            Jadwal
                        </label>
                        <input type="text" name="jadwal" id="jadwal" value="{{ old('jadwal', $ekstrakurikuler->jadwal) }}" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Contoh: Sabtu 14:00-16:00">
                    </div>
                </div>

                <!-- Thumbnail -->
                <div>
                    <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-2">
                        Thumbnail
                    </label>
                    @if($ekstrakurikuler->thumbnail)
                        <div class="mb-2">
                            <img src="{{ asset($ekstrakurikuler->thumbnail) }}" alt="Current" class="w-32 h-32 object-cover rounded-lg">
                            <p class="text-xs text-gray-500 mt-1">Gambar saat ini</p>
                        </div>
                    @endif
                    <div class="flex items-center space-x-4">
                        <label class="flex-1 flex flex-col items-center px-4 py-6 bg-white border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:border-blue-500 transition-colors">
                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                            <span class="text-sm text-gray-600">Klik untuk upload gambar baru</span>
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

                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi <span class="text-red-500">*</span>
                    </label>
                    <textarea name="deskripsi" id="deskripsi" rows="6" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('deskripsi') border-red-500 @enderror"
                              placeholder="Deskripsi ekstrakurikuler..." required>{{ old('deskripsi', $ekstrakurikuler->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tags -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tags (opsional)</label>
                    <div id="tagsContainer">
                        @php 
                            $tags = old('tags', $ekstrakurikuler->tags ?? []); 
                            if(is_string($tags)) $tags = json_decode($tags, true) ?: []; 
                        @endphp
                        @forelse($tags as $i => $tag)
                            <div class="flex items-center mb-2">
                                <input type="text" name="tags[]" value="{{ $tag }}" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg mr-2" placeholder="Tag">
                                <button type="button" class="removeTag px-2 py-1 bg-red-100 text-red-600 rounded">Hapus</button>
                            </div>
                        @empty
                        @endforelse
                    </div>
                    <button type="button" id="addTag" class="mt-2 px-3 py-1 bg-blue-100 text-blue-700 rounded">Tambah Tag</button>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-t border-gray-100">
                <a href="{{ route('admin.ekstrakurikulers.index') }}" class="px-4 py-2 text-gray-700 hover:text-gray-900 font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <button type="submit" class="px-6 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg hover:shadow-lg transition-all font-medium">
                    <i class="fas fa-save mr-2"></i>Update
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

// Add Tag
document.getElementById('addTag').addEventListener('click', function() {
    const container = document.getElementById('tagsContainer');
    const div = document.createElement('div');
    div.className = 'flex items-center mb-2';
    div.innerHTML = `
        <input type="text" name="tags[]" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg mr-2" placeholder="Tag">
        <button type="button" class="removeTag px-2 py-1 bg-red-100 text-red-600 rounded">Hapus</button>
    `;
    container.appendChild(div);
});

// Remove Tag
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('removeTag')) {
        e.target.parentElement.remove();
    }
});
</script>
@endpush
