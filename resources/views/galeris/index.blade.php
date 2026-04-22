@extends('layouts.admin')

@section('title', 'Galeri')
@section('page-title', 'Manajemen Galeri')
@section('page-description', 'Kelola semua foto galeri sekolah')

@section('content')
<div class="space-y-6">
    <!-- Filter Bar -->
    <form method="GET" class="mb-4 flex flex-wrap gap-3 items-center">
        <div>
            <label for="filter_album" class="text-sm font-medium text-gray-700 mr-2">Album:</label>
            <select name="album" id="filter_album" onchange="this.form.submit()" class="px-2 py-1 border border-gray-300 rounded">
                <option value="">Semua Album</option>
                <option value="Kegiatan Sekolah" @if(request('album')=='Kegiatan Sekolah') selected @endif>Kegiatan Sekolah</option>
                <option value="Ekstrakurikuler" @if(request('album')=='Ekstrakurikuler') selected @endif>Ekstrakurikuler</option>
                <option value="Fasilitas" @if(request('album')=='Fasilitas') selected @endif>Fasilitas</option>
                <option value="Prestasi" @if(request('album')=='Prestasi') selected @endif>Prestasi</option>
                <option value="Guru & Staff" @if(request('album')=='Guru & Staff') selected @endif>Guru & Staff</option>
                <option value="Kelas" @if(request('album')=='Kelas') selected @endif>Kelas</option>
                <option value="Kegiatan Akademik" @if(request('album')=='Kegiatan Akademik') selected @endif>Kegiatan Akademik</option>
                <option value="Event Besar" @if(request('album')=='Event Besar') selected @endif>Event Besar</option>
                <option value="Alumni" @if(request('album')=='Alumni') selected @endif>Alumni</option>
            </select>
        </div>
        <div>
            <label for="filter_jurusan" class="text-sm font-medium text-gray-700 mr-2">Jurusan:</label>
            <select name="jurusan_id" id="filter_jurusan" onchange="this.form.submit()" class="px-2 py-1 border border-gray-300 rounded">
                <option value="">Semua/Umum</option>
                @foreach(\App\Models\Jurusan::orderBy('name')->get() as $jurusan)
                    <option value="{{ $jurusan->id }}" @if(request('jurusan_id')==$jurusan->id) selected @endif>{{ $jurusan->name }}</option>
                @endforeach
            </select>
        </div>
        @if(request('album') || request('jurusan_id'))
            <a href="{{ route('admin.galeris.index') }}" class="ml-2 text-xs text-gray-500 underline">Reset Filter</a>
        @endif
    </form>
    <!-- Header Actions -->
    <div class="flex justify-between items-center">
        <div>
            <h3 class="text-2xl font-bold text-gray-800">Galeri Foto</h3>
            <p class="text-gray-600 mt-1">Total: {{ $galeris->count() }} foto</p>
        </div>
        <button onclick="openCreateModal()" class="px-4 py-2 bg-gradient-to-r from-yellow-500 to-orange-600 text-white rounded-lg hover:shadow-lg transition-all font-medium">
            <i class="fas fa-plus mr-2"></i>Upload Foto
        </button>
    </div>

    <!-- Content -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($galeris as $galeri)
            <div class="card-hover bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden group">
                <div class="relative h-48 bg-gray-200 overflow-hidden">
                    @if($galeri->path)
                        <img src="{{ asset($galeri->path) }}" alt="{{ $galeri->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-4xl"></i>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                        <div class="flex space-x-2">
                            <button onclick="viewImage('{{ asset($galeri->path) }}', '{{ $galeri->title }}')" class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-blue-600 hover:bg-blue-50 transition-colors">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button onclick="openEditModal({{ $galeri->id }}, '{{ addslashes($galeri->title) }}', '{{ asset($galeri->path) }}', '{{ addslashes($galeri->album) }}', '{{ $galeri->jurusan_id }}')" class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-yellow-600 hover:bg-yellow-50 transition-colors">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteGaleri({{ $galeri->id }})" class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-red-600 hover:bg-red-50 transition-colors">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="p-4">
                    <h4 class="font-semibold text-gray-800 truncate">{{ $galeri->title }}</h4>
                    <div class="flex flex-wrap gap-2 mt-2">
                        <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded">Album: {{ $galeri->album }}</span>
                        @if($galeri->jurusan)
                            <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">Jurusan: {{ $galeri->jurusan->name }}</span>
                        @else
                            <span class="inline-block bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded">Umum</span>
                        @endif
                    </div>
                    <p class="text-sm text-gray-500 mt-1">{{ $galeri->created_at->format('d M Y') }}</p>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-16">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                    <i class="fas fa-images text-gray-400 text-2xl"></i>
                </div>
                <h5 class="text-lg font-semibold text-gray-900 mb-2">Belum ada foto</h5>
                <p class="text-gray-500 mb-6">Mulai dengan menambahkan foto pertama.</p>
                <button onclick="openCreateModal()" class="px-4 py-2 bg-gradient-to-r from-yellow-500 to-orange-600 text-white rounded-lg hover:shadow-lg transition-all font-medium inline-flex items-center">
                    <i class="fas fa-plus mr-2"></i>Upload Foto
                </button>
            </div>
        @endforelse
    </div>
</div>

<!-- Create Modal -->
<div id="createModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-gray-100">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-800">Upload Foto Baru</h3>
                <button onclick="closeCreateModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>
        <form action="{{ route('admin.galeris.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="p-6 space-y-4">
                                <div>
                                    <label for="create_album" class="block text-sm font-medium text-gray-700 mb-2">Album <span class="text-red-500">*</span></label>
                                    <select name="album" id="create_album" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                        <option value="Kegiatan Sekolah">Kegiatan Sekolah</option>
                                        <option value="Ekstrakurikuler">Ekstrakurikuler</option>
                                        <option value="Fasilitas">Fasilitas</option>
                                        <option value="Prestasi">Prestasi</option>
                                        <option value="Guru & Staff">Guru & Staff</option>
                                        <option value="Kelas">Kelas</option>
                                        <option value="Kegiatan Akademik">Kegiatan Akademik</option>
                                        <option value="Event Besar">Event Besar</option>
                                        <option value="Alumni">Alumni</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="create_jurusan_id" class="block text-sm font-medium text-gray-700 mb-2">Jurusan (opsional)</label>
                                    <select name="jurusan_id" id="create_jurusan_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                        <option value="">-- Semua/Umum --</option>
                                        @foreach(\App\Models\Jurusan::orderBy('name')->get() as $jurusan)
                                            <option value="{{ $jurusan->id }}">{{ $jurusan->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                <div>
                    <label for="create_title" class="block text-sm font-medium text-gray-700 mb-2">
                        Judul Foto (Prefix) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" id="create_title" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500"
                           placeholder="Masukkan judul foto">
                    <p class="text-xs text-gray-500 mt-1">Untuk multiple upload, akan otomatis ditambahkan nomor urut</p>
                </div>
                
                <div>
                    <label for="create_deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi
                    </label>
                    <textarea name="deskripsi" id="create_deskripsi" rows="3"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500"
                              placeholder="Deskripsi foto (opsional)"></textarea>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        File Gambar <span class="text-red-500">*</span>
                    </label>
                    <label class="flex flex-col items-center px-4 py-8 bg-white border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:border-yellow-500 transition-colors">
                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                        <span class="text-sm text-gray-600">Klik untuk upload gambar (bisa pilih banyak)</span>
                        <span class="text-xs text-gray-400 mt-1">PNG, JPG up to 5MB per file</span>
                        <input type="file" name="images[]" id="create_path" class="hidden" accept="image/*" multiple required onchange="previewCreateImages(event)">
                    </label>
                    <div id="createImagePreview" class="mt-4 hidden">
                        <p class="text-sm font-medium text-gray-700 mb-2">Preview (<span id="imageCount">0</span> gambar dipilih)</p>
                        <div id="previewContainer" class="grid grid-cols-2 md:grid-cols-3 gap-4"></div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-3 border-t border-gray-100">
                <button type="button" onclick="closeCreateModal()" class="px-4 py-2 text-gray-700 hover:text-gray-900 font-medium">
                    Batal
                </button>
                <button type="submit" class="px-6 py-2 bg-gradient-to-r from-yellow-500 to-orange-600 text-white rounded-lg hover:shadow-lg transition-all font-medium">
                    <i class="fas fa-save mr-2"></i>Upload <span id="uploadCount"></span>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-gray-100">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-800">Edit Foto</h3>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-4">
                <div>
                    <label for="edit_title" class="block text-sm font-medium text-gray-700 mb-2">
                        Judul Foto <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" id="edit_title" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500"
                           placeholder="Masukkan judul foto">
                </div>
                <div>
                    <label for="edit_album" class="block text-sm font-medium text-gray-700 mb-2">Album <span class="text-red-500">*</span></label>
                    <select name="album" id="edit_album" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        <option value="Kegiatan Sekolah">Kegiatan Sekolah</option>
                        <option value="Ekstrakurikuler">Ekstrakurikuler</option>
                        <option value="Fasilitas">Fasilitas</option>
                        <option value="Prestasi">Prestasi</option>
                        <option value="Guru & Staff">Guru & Staff</option>
                        <option value="Kelas">Kelas</option>
                        <option value="Kegiatan Akademik">Kegiatan Akademik</option>
                        <option value="Event Besar">Event Besar</option>
                        <option value="Alumni">Alumni</option>
                    </select>
                </div>
                <div>
                    <label for="edit_jurusan_id" class="block text-sm font-medium text-gray-700 mb-2">Jurusan (opsional)</label>
                    <select name="jurusan_id" id="edit_jurusan_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        <option value="">-- Semua/Umum --</option>
                        @foreach(\App\Models\Jurusan::orderBy('name')->get() as $jurusan)
                            <option value="{{ $jurusan->id }}">{{ $jurusan->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Gambar Saat Ini
                    </label>
                    <img id="edit_current_image" src="" alt="Current" class="w-full h-48 object-cover rounded-lg mb-4">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Upload Gambar Baru (opsional)
                    </label>
                    <label class="flex flex-col items-center px-4 py-6 bg-white border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:border-yellow-500 transition-colors">
                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                        <span class="text-sm text-gray-600">Klik untuk mengganti path</span>
                        <input type="file" name="path" id="edit_path" class="hidden" accept="image/*" onchange="previewEditImage(event)">
                    </label>
                    <div id="editImagePreview" class="mt-4 hidden">
                        <img src="" alt="Preview" class="w-full h-48 object-cover rounded-lg">
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-3 border-t border-gray-100">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-gray-700 hover:text-gray-900 font-medium">
                    Batal
                </button>
                <button type="submit" class="px-6 py-2 bg-gradient-to-r from-yellow-500 to-orange-600 text-white rounded-lg hover:shadow-lg transition-all font-medium">
                    <i class="fas fa-save mr-2"></i>Update
                </button>
            </div>
        </form>
    </div>
</div>

<!-- View Modal -->
<div id="viewModal" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden flex items-center justify-center p-4">
    <div class="relative max-w-6xl w-full">
        <button onclick="closeViewModal()" class="absolute top-4 right-4 text-white hover:text-gray-300 text-2xl z-10">
            <i class="fas fa-times"></i>
        </button>
        <div class="text-center">
            <img id="viewImage" src="" alt="" class="max-w-full max-h-[85vh] mx-auto rounded-lg">
            <p id="viewTitle" class="text-white text-xl font-semibold mt-4"></p>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function openCreateModal() {
        document.getElementById('createModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    
    function closeCreateModal() {
        document.getElementById('createModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
        document.getElementById('create_title').value = '';
        document.getElementById('create_deskripsi').value = '';
        document.getElementById('create_path').value = '';
        document.getElementById('createImagePreview').classList.add('hidden');
        document.getElementById('previewContainer').innerHTML = '';
    }
    
    function openEditModal(id, title, path, album = '', jurusan_id = '') {
        document.getElementById('editModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        document.getElementById('edit_title').value = title;
        document.getElementById('edit_current_image').src = path;
        document.getElementById('editForm').action = `/admin/galeris/${id}`;
        // Set album
        if(album) document.getElementById('edit_album').value = album;
        // Set jurusan
        if(jurusan_id) document.getElementById('edit_jurusan_id').value = jurusan_id;
        else document.getElementById('edit_jurusan_id').value = '';
    }    
    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
        document.getElementById('editImagePreview').classList.add('hidden');
    }
    
    function viewImage(src, title) {
        document.getElementById('viewModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        document.getElementById('viewImage').src = src;
        document.getElementById('viewTitle').textContent = title;
    }
    
    function closeViewModal() {
        document.getElementById('viewModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
    
    function deleteGaleri(id) {
        if (confirm('Apakah Anda yakin ingin menghapus foto ini?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/galeris/${id}`;
            
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken;
            
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            
            form.appendChild(csrfInput);
            form.appendChild(methodInput);
            document.body.appendChild(form);
            form.submit();
        }
    }
    
    function previewCreateImages(event) {
        const files = event.target.files;
        const previewContainer = document.getElementById('previewContainer');
        const imageCount = document.getElementById('imageCount');
        const uploadCount = document.getElementById('uploadCount');
        
        previewContainer.innerHTML = '';
        imageCount.textContent = files.length;
        uploadCount.textContent = files.length > 1 ? `(${files.length} foto)` : '';
        
        if (files.length > 0) {
            document.getElementById('createImagePreview').classList.remove('hidden');
            
            Array.from(files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative';
                    div.innerHTML = `
                        <img src="${e.target.result}" alt="Preview ${index + 1}" class="w-full h-32 object-cover rounded-lg">
                        <div class="absolute top-2 left-2 bg-black bg-opacity-60 text-white text-xs px-2 py-1 rounded">
                            ${index + 1}
                        </div>
                    `;
                    previewContainer.appendChild(div);
                }
                reader.readAsDataURL(file);
            });
        } else {
            document.getElementById('createImagePreview').classList.add('hidden');
        }
    }
    
    function previewEditImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const preview = document.getElementById('editImagePreview');
            const img = preview.querySelector('img');
            img.src = reader.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endpush
@endsection
