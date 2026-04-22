@extends('layouts.admin')

@section('title', 'Tambah Berita')
@section('page-title', 'Tambah Berita')
@section('page-description', 'Buat berita baru')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.beritas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="p-6 space-y-6">
                <!-- Judul -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Judul Berita <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror"
                           placeholder="Masukkan judul berita" required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Slug -->
                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                        Slug <span class="text-gray-400 text-xs">(otomatis dari judul)</span>
                    </label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug') }}" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-50"
                           placeholder="otomatis-dari-judul" readonly>
                    @error('slug')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Jurusan (opsional) -->
                                    <div>
                                        <label for="jurusan_id" class="block text-sm font-medium text-gray-700 mb-2">Jurusan (opsional)</label>
                                        <select name="jurusan_id" id="jurusan_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            <option value="">-- Semua/Umum --</option>
                                            @foreach($jurusans as $jurusan)
                                                <option value="{{ $jurusan->id }}" {{ old('jurusan_id') == $jurusan->id ? 'selected' : '' }}>{{ $jurusan->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                    <!-- Kategori -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <select name="category" id="category" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('category') border-red-500 @enderror" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Event" {{ old('category') == 'Event' ? 'selected' : '' }}>Event</option>
                            <option value="Kegiatan" {{ old('category') == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                            <option value="Kesiswaan" {{ old('category') == 'Kesiswaan' ? 'selected' : '' }}>Kesiswaan</option>
                            <option value="Kurikulum" {{ old('category') == 'Kurikulum' ? 'selected' : '' }}>Kurikulum</option>
                            <option value="Prestasi" {{ old('category') == 'Prestasi' ? 'selected' : '' }}>Prestasi</option>
                            <option value="Humas" {{ old('category') == 'Humas' ? 'selected' : '' }}>Humas</option>
                            <option value="Iptek" {{ old('category') == 'Iptek' ? 'selected' : '' }}>Iptek</option>
                        </select>
                        @error('category')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Penulis -->
                    <div>
                        <label for="author" class="block text-sm font-medium text-gray-700 mb-2">
                            Penulis <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="author" id="author" value="{{ old('author', auth()->user()->name ?? 'Admin') }}" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('author') border-red-500 @enderror"
                               placeholder="Nama penulis" required>
                        @error('author')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Tanggal Posting -->
                <div>
                    <label for="posted_at" class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal Posting <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="posted_at" id="posted_at" value="{{ old('posted_at', date('Y-m-d')) }}" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('posted_at') border-red-500 @enderror" required>
                    @error('posted_at')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gambar -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                        Gambar Berita
                    </label>
                    <div class="flex items-center space-x-4">
                        <label class="flex-1 flex flex-col items-center px-4 py-6 bg-white border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:border-blue-500 transition-colors">
                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                            <span class="text-sm text-gray-600">Klik untuk upload gambar</span>
                            <span class="text-xs text-gray-400 mt-1">PNG, JPG up to 2MB</span>
                            <input type="file" name="image" id="image" class="hidden" accept="image/*" onchange="previewImage(event)">
                        </label>
                    </div>
                    <div id="imagePreview" class="mt-4 hidden">
                        <img src="" alt="Preview" class="w-full h-48 object-cover rounded-lg">
                    </div>
                    @error('image')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Konten -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                        Konten Berita <span class="text-red-500">*</span>
                    </label>
                    <textarea name="content" id="content" rows="10" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('content') border-red-500 @enderror"
                              placeholder="Tulis konten berita di sini..." required>{{ old('content') }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Hashtags -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Hashtag (opsional)</label>
                    <div id="hashtagsContainer">
                        @php $hashtags = old('hashtags', []); if(is_string($hashtags)) $hashtags = json_decode($hashtags, true) ?: []; @endphp
                        @foreach($hashtags as $i => $hashtag)
                            <div class="flex items-center mb-2">
                                <input type="text" name="hashtags[]" value="{{ $hashtag }}" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg mr-2" placeholder="#hashtag">
                                <button type="button" class="removeHashtag px-2 py-1 bg-red-100 text-red-600 rounded">Hapus</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" id="addHashtag" class="mt-2 px-3 py-1 bg-blue-100 text-blue-700 rounded">Tambah Hashtag</button>
                    <p class="text-xs text-gray-400 mt-1">Contoh: #ppdb #prestasi</p>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-t border-gray-100">
                <a href="{{ route('admin.beritas.index') }}" class="px-4 py-2 text-gray-700 hover:text-gray-900 font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <button type="submit" class="px-6 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg hover:shadow-lg transition-all font-medium">
                    <i class="fas fa-save mr-2"></i>Simpan Berita
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
        // Initialize Summernote
        $('#content').summernote({
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
            placeholder: 'Tulis konten berita di sini...',
            tabsize: 2,
            // Disable image upload
            disableDragAndDrop: true,
            callbacks: {
                onImageUpload: function(files) {
                    // Prevent image upload
                    alert('Upload gambar tidak diizinkan. Gunakan gambar utama berita.');
                }
            }
        });
    });

    // Auto generate slug from title
    document.getElementById('title').addEventListener('input', function() {
        const title = this.value;
        const slug = title.toLowerCase()
            .replace(/[^\w\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .trim();
        document.getElementById('slug').value = slug;
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

    // Hashtag management
    document.getElementById('addHashtag').addEventListener('click', function() {
        const container = document.getElementById('hashtagsContainer');
        const div = document.createElement('div');
        div.className = 'flex items-center mb-2';
        div.innerHTML = `
            <input type="text" name="hashtags[]" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg mr-2" placeholder="#hashtag">
            <button type="button" class="removeHashtag px-2 py-1 bg-red-100 text-red-600 rounded">Hapus</button>
        `;
        container.appendChild(div);
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('removeHashtag')) {
            e.target.closest('.flex').remove();
        }
    });
</script>
@endpush
