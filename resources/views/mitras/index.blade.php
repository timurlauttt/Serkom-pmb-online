@extends('layouts.admin')

@section('title', 'Mitra')
@section('page-title', 'Data Mitra')
@section('page-description', 'Kelola mitra sekolah')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex justify-between items-center">
        <div>
            <h3 class="text-2xl font-bold text-gray-800">Mitra</h3>
            <p class="text-gray-600 mt-1">Total: {{ $mitras->count() }} mitra</p>
        </div>
        <button onclick="openCreateModal()" class="px-4 py-2 bg-gradient-to-r from-yellow-500 to-orange-600 text-white rounded-lg hover:shadow-lg transition-all font-medium">
            <i class="fas fa-plus mr-2"></i>Tambah Mitra
        </button>
    </div>

    <!-- Content -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($mitras as $mitra)
            <div class="card-hover bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden group">
                <div class="relative h-40 bg-gray-50 overflow-hidden flex items-center justify-center">
                    @if($mitra->logo)
                        <img src="{{ asset($mitra->logo) }}" alt="{{ $mitra->nama }}" class="max-h-full max-w-full object-contain group-hover:scale-105 transition-transform duration-300">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <i class="fas fa-building text-gray-400 text-4xl"></i>
                        </div>
                    @endif

                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                        <div class="flex space-x-2">
                            <a href="{{ $mitra->url }}" target="_blank" class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-blue-600 hover:bg-blue-50 transition-colors">
                                <i class="fas fa-link"></i>
                            </a>
                            <button onclick="openEditModal({{ $mitra->id }}, '{{ addslashes($mitra->nama) }}', '{{ $mitra->url }}', '{{ asset($mitra->logo) }}')" class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-yellow-600 hover:bg-yellow-50 transition-colors">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteMitra({{ $mitra->id }})" class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-red-600 hover:bg-red-50 transition-colors">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="p-4">
                    <h4 class="font-semibold text-gray-800 truncate">{{ $mitra->nama }}</h4>
                    <p class="text-sm text-gray-500 mt-1 truncate">{{ $mitra->url }}</p>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-16">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                    <i class="fas fa-handshake text-gray-400 text-2xl"></i>
                </div>
                <h5 class="text-lg font-semibold text-gray-900 mb-2">Belum ada mitra</h5>
                <p class="text-gray-500 mb-6">Tambahkan mitra untuk ditampilkan pada halaman utama.</p>
                <button onclick="openCreateModal()" class="px-4 py-2 bg-gradient-to-r from-yellow-500 to-orange-600 text-white rounded-lg hover:shadow-lg transition-all font-medium inline-flex items-center">
                    <i class="fas fa-plus mr-2"></i>Tambah Mitra
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
                <h3 class="text-xl font-bold text-gray-800">Tambah Mitra</h3>
                <button onclick="closeCreateModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>
        <form action="{{ route('admin.mitras.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="p-6 space-y-4">
                <div>
                    <label for="create_nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Mitra <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" id="create_nama" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Masukkan nama mitra">
                </div>

                <div>
                    <label for="create_url" class="block text-sm font-medium text-gray-700 mb-2">URL</label>
                    <input type="url" name="url" id="create_url" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="https://example.com (opsional)">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Logo</label>
                    <label class="flex flex-col items-center px-4 py-8 bg-white border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:border-yellow-500 transition-colors">
                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                        <span class="text-sm text-gray-600">Klik untuk upload logo</span>
                        <span class="text-xs text-gray-400 mt-1">PNG, JPG up to 5MB</span>
                        <input type="file" name="logo" id="create_logo" class="hidden" accept="image/*" onchange="previewCreateLogo(event)">
                    </label>
                    <div id="createLogoPreview" class="mt-4 hidden">
                        <img src="" alt="Preview" class="w-full h-48 object-contain rounded-lg">
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-3 border-t border-gray-100">
                <button type="button" onclick="closeCreateModal()" class="px-4 py-2 text-gray-700 hover:text-gray-900 font-medium">Batal</button>
                <button type="submit" class="px-6 py-2 bg-gradient-to-r from-yellow-500 to-orange-600 text-white rounded-lg hover:shadow-lg transition-all font-medium"><i class="fas fa-save mr-2"></i>Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-gray-100">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-800">Edit Mitra</h3>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times text-xl"></i></button>
            </div>
        </div>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-4">
                <div>
                    <label for="edit_nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Mitra <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" id="edit_nama" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Masukkan nama mitra">
                </div>

                <div>
                    <label for="edit_url" class="block text-sm font-medium text-gray-700 mb-2">URL</label>
                    <input type="url" name="url" id="edit_url" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="https://example.com (opsional)">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Logo Saat Ini</label>
                    <img id="edit_current_logo" src="" alt="Current" class="w-full h-48 object-contain rounded-lg mb-4">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Upload Logo Baru (opsional)</label>
                    <label class="flex flex-col items-center px-4 py-6 bg-white border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:border-yellow-500 transition-colors">
                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                        <span class="text-sm text-gray-600">Klik untuk mengganti logo</span>
                        <input type="file" name="logo" id="edit_logo" class="hidden" accept="image/*" onchange="previewEditLogo(event)">
                    </label>
                    <div id="editLogoPreview" class="mt-4 hidden"><img src="" alt="Preview" class="w-full h-48 object-contain rounded-lg"></div>
                </div>
            </div>
            <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-3 border-t border-gray-100">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-gray-700 hover:text-gray-900 font-medium">Batal</button>
                <button type="submit" class="px-6 py-2 bg-gradient-to-r from-yellow-500 to-orange-600 text-white rounded-lg hover:shadow-lg transition-all font-medium"><i class="fas fa-save mr-2"></i>Update</button>
            </div>
        </form>
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
        document.getElementById('create_nama').value = '';
        document.getElementById('create_url').value = '';
        document.getElementById('create_logo').value = '';
        document.getElementById('createLogoPreview').classList.add('hidden');
    }
    
    function openEditModal(id, nama, url, logo) {
        document.getElementById('editModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_url').value = url;
        document.getElementById('edit_current_logo').src = logo;
        document.getElementById('editForm').action = `/admin/mitras/${id}`;
    }
    
    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
        document.getElementById('editLogoPreview').classList.add('hidden');
    }
    
    function deleteMitra(id) {
        if (confirm('Apakah Anda yakin ingin menghapus mitra ini?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/mitras/${id}`;
            
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
    
    function previewCreateLogo(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const preview = document.getElementById('createLogoPreview');
            const img = preview.querySelector('img');
            img.src = reader.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(event.target.files[0]);
    }
    
    function previewEditLogo(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const preview = document.getElementById('editLogoPreview');
            const img = preview.querySelector('img');
            img.src = reader.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endpush

@endsection
