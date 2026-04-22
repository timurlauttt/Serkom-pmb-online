@extends('layouts.admin')

@section('title', 'Edit Event')
@section('page-title', 'Edit Event')
@section('page-description', 'Ubah informasi event')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.events.update', $event->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="p-6 space-y-6">
                <!-- Judul -->
                <div>
                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">
                        Judul Event <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title', $event->title) }}" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 @error('title') border-red-500 @enderror"
                           placeholder="Masukkan judul event" required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                    <!-- Penyelenggara (Organizer) -->
                                                    <div>
                                                        <label for="organizer" class="block text-sm font-medium text-gray-700 mb-2">Penyelenggara</label>
                                                        <input type="text" name="organizer" id="organizer" value="{{ old('organizer', $event->organizer) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                                                    </div>
                                                    <!-- Kategori -->
                                                    <div>
                                                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                                                        <input type="text" name="category" id="category" value="{{ old('category', $event->category) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                                                    </div>
                                    <!-- Jurusan (opsional) -->
                                    <div>
                                        <label for="jurusan_id" class="block text-sm font-medium text-gray-700 mb-2">Jurusan (opsional)</label>
                                        <select name="jurusan_id" id="jurusan_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                                            <option value="">-- Semua/Umum --</option>
                                            @foreach(isset($jurusans) ? $jurusans : collect() as $jurusan)
                                                <option value="{{ $jurusan->id }}" {{ old('jurusan_id', $event->jurusan_id) == $jurusan->id ? 'selected' : '' }}>{{ $jurusan->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                    <!-- Tanggal -->
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Event
                        </label>
                        <input type="date" name="start_date" id="start_date"
                               value="{{ old('start_date') ?? \Carbon\Carbon::parse($event->start_date)->format('Y-m-d') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 @error('start_date') border-red-500 @enderror"
                               required>
                        @error('start_date')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Lokasi -->
                    <div>
                        <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-2">
                            Lokasi
                        </label>
               <input type="text" name="location" id="location" value="{{ old('location', $event->location) }}" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                   placeholder="Lokasi event">
                    </div>
                </div>

                <!-- Gambar -->
                <div>
                    <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">
                        Gambar Event
                    </label>
                    
                    @if($event->image_path)
                        <div class="mb-4">
                            <img src="{{ $event->image_url }}" alt="Current" class="w-full h-48 object-cover rounded-lg">
                            <p class="text-sm text-gray-500 mt-2">Gambar saat ini (upload gambar baru untuk mengganti)</p>
                        </div>
                    @endif
                    
                    <div class="flex items-center space-x-4">
                        <label class="flex-1 flex flex-col items-center px-4 py-6 bg-white border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:border-purple-500 transition-colors">
                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                            <span class="text-sm text-gray-600">Klik untuk upload gambar baru</span>
                            <span class="text-xs text-gray-400 mt-1">PNG, JPG up to 2MB</span>
                            <input type="file" name="image_path" id="image_path" class="hidden" accept="image/*" onchange="previewImage(event)">
                        </label>
                    </div>
                    <div id="imagePreview" class="mt-4 hidden">
                        <img src="" alt="Preview" class="w-full h-48 object-cover rounded-lg">
                    </div>
                    @error('image_path')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi Event <span class="text-red-500">*</span>
                    </label>
                    <textarea name="description" id="description" rows="10" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 @error('description') border-red-500 @enderror"
                              placeholder="Tulis deskripsi event di sini..." required>{{ old('description', $event->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-t border-gray-100">
                <a href="{{ route('admin.events.index') }}" class="px-4 py-2 text-gray-700 hover:text-gray-900 font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <button type="submit" class="px-6 py-2 bg-gradient-to-r from-purple-500 to-pink-600 text-white rounded-lg hover:shadow-lg transition-all font-medium">
                    <i class="fas fa-save mr-2"></i>Update Event
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Summernote for rich text editing
        $('#description').summernote({
            height: 400,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            placeholder: 'Tulis deskripsi event di sini...',
            tabsize: 2,
            disableDragAndDrop: true,
            callbacks: {
                onImageUpload: function(files) {
                    alert('Upload gambar tidak diizinkan. Gunakan gambar utama event.');
                }
            }
        });
    });

    // Image preview
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
