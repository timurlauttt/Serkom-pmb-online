@extends('layouts.admin')

@section('title', 'Edit Jurusan')
@section('page-title', 'Edit Jurusan')
@section('page-description', 'Ubah informasi jurusan')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.jurusans.update', $jurusan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="p-6 space-y-6">
                <!-- Nama Jurusan -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Jurusan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name', $jurusan->name) }}" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('name') border-red-500 @enderror"
                           placeholder="Contoh: Teknik Komputer dan Jaringan" required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Slug -->
                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                        Slug <span class="text-gray-400 text-xs">(otomatis dari nama)</span>
                    </label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $jurusan->slug) }}" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-gray-50"
                           placeholder="teknik-komputer-dan-jaringan" readonly>
                </div>

                <!-- Foto 1 -->
                <div>
                    <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">Foto 1</label>
                    @if($jurusan->photo_path)
                        <div class="mb-4">
                            <img src="{{ asset($jurusan->photo_path) }}" alt="Current" class="w-full h-48 object-cover rounded-lg">
                            <p class="text-sm text-gray-500 mt-2">Foto saat ini (upload foto baru untuk mengganti)</p>
                        </div>
                    @endif
                    <input type="file" name="photo" id="photo" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" accept="image/*" onchange="previewImage(event, 'imagePreview1')">
                    <div id="imagePreview1" class="mt-4 hidden">
                        <img src="" alt="Preview Foto 1" class="w-full h-48 object-cover rounded-lg">
                    </div>
                    @error('photo')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Foto 2 -->
                <div>
                    <label for="photo_2" class="block text-sm font-medium text-gray-700 mb-2">Foto 2</label>
                    @if($jurusan->photo_path_2)
                        <div class="mb-4">
                            <img src="{{ asset($jurusan->photo_path_2) }}" alt="Current" class="w-full h-48 object-cover rounded-lg">
                            <p class="text-sm text-gray-500 mt-2">Foto saat ini (upload foto baru untuk mengganti)</p>
                        </div>
                    @endif
                    <input type="file" name="photo_2" id="photo_2" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" accept="image/*" onchange="previewImage(event, 'imagePreview2')">
                    <div id="imagePreview2" class="mt-4 hidden">
                        <img src="" alt="Preview Foto 2" class="w-full h-48 object-cover rounded-lg">
                    </div>
                </div>
                <!-- Foto 3 -->
                <div>
                    <label for="photo_3" class="block text-sm font-medium text-gray-700 mb-2">Foto 3</label>
                    @if($jurusan->photo_path_3)
                        <div class="mb-4">
                            <img src="{{ asset($jurusan->photo_path_3) }}" alt="Current" class="w-full h-48 object-cover rounded-lg">
                            <p class="text-sm text-gray-500 mt-2">Foto saat ini (upload foto baru untuk mengganti)</p>
                        </div>
                    @endif
                    <input type="file" name="photo_3" id="photo_3" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" accept="image/*" onchange="previewImage(event, 'imagePreview3')">
                    <div id="imagePreview3" class="mt-4 hidden">
                        <img src="" alt="Preview Foto 3" class="w-full h-48 object-cover rounded-lg">
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi Jurusan <span class="text-red-500">*</span>
                    </label>
                    <textarea name="description" id="description" rows="6" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('description') border-red-500 @enderror"
                              placeholder="Tulis deskripsi jurusan di sini..." required>{{ old('description', $jurusan->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Mata Pelajaran (one-by-one fields) -->
                <div>
                    <label for="subjects" class="block text-sm font-medium text-gray-700 mb-2">
                        Mata Pelajaran <span class="text-gray-400 text-xs">(tambahkan atau hapus sesuai kebutuhan)</span>
                    </label>
                    @php
                        $oldSubjects = old('subjects');
                        if(is_array($oldSubjects)) {
                            $subjectsArr = $oldSubjects;
                        } else {
                            if(is_array($jurusan->subjects)) {
                                $subjectsArr = $jurusan->subjects;
                            } elseif(is_string($jurusan->subjects) && strlen(trim($jurusan->subjects))) {
                                $subjectsArr = array_map('trim', explode(',', $jurusan->subjects));
                            } else {
                                $subjectsArr = [''];
                            }
                        }
                    @endphp

                    <div id="subjectsList" class="space-y-2">
                        @foreach($subjectsArr as $s)
                            <div class="flex items-center space-x-2">
                                <input type="text" name="subjects[]" value="{{ $s }}" placeholder="Nama mata pelajaran"
                                       class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                                <button type="button" class="remove-subject inline-flex items-center justify-center px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors text-sm font-medium">
                                    &minus;
                                </button>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-3">
                        <button type="button" id="addSubject" class="px-4 py-2 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-100 transition-colors text-sm font-medium">
                            <i class="fas fa-plus mr-2"></i>Tambah Mata Pelajaran
                        </button>
                    </div>

                    <p class="mt-1 text-xs text-gray-500">Gunakan tombol tambah untuk menambahkan mata pelajaran, atau &minus; untuk menghapus baris.</p>
                    @error('subjects')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Prospek Lulusan (dinamis) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Prospek Lulusan</label>
                    <div id="prospectsList" class="space-y-2">
                        @php
                            $oldProspects = old('prospects');
                            if(is_array($oldProspects)) {
                                $prospectsArr = $oldProspects;
                            } elseif(is_array($jurusan->prospects)) {
                                $prospectsArr = $jurusan->prospects;
                            } elseif(is_string($jurusan->prospects) && strlen(trim($jurusan->prospects))) {
                                $prospectsArr = array_map('trim', explode(',', $jurusan->prospects));
                            } else {
                                $prospectsArr = [''];
                            }
                        @endphp
                        @foreach($prospectsArr as $p)
                        <div class="flex items-center space-x-2">
                            <input type="text" name="prospects[]" value="{{ $p }}" placeholder="Prospek lulusan" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                            <button type="button" class="remove-prospect px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 text-sm">&minus;</button>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-3">
                        <button type="button" id="addProspect" class="px-4 py-2 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-100 text-sm font-medium"><i class="fas fa-plus mr-2"></i>Tambah Prospek</button>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Bisa tambah lebih dari satu prospek lulusan.</p>
                </div>

                <!-- Mitra Jurusan (dinamis) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Mitra Jurusan</label>
                    <div id="partnersList" class="space-y-2">
                        @php
                            $oldPartners = old('partners');
                            $partnersArr = is_array($oldPartners) ? $oldPartners : (is_array($jurusan->partners) ? $jurusan->partners : [['name'=>'','logo'=>'']]);
                        @endphp
                        @foreach($partnersArr as $idx => $mitra)
                        <div class="flex items-center space-x-2">
                            <input type="text" name="partners[{{ $idx }}][name]" value="{{ $mitra['name'] ?? '' }}" placeholder="Nama Mitra" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                            <input type="file" name="partner_logos[{{ $idx }}]" accept="image/*" class="block text-sm text-gray-500" onchange="previewPartnerLogo(event, 'partnerLogoPreview{{ $idx }}')" />
                            <div id="partnerLogoPreview{{ $idx }}" class="w-16 h-16 bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center{{ !empty($mitra['logo']) ? '' : ' hidden' }}">
                                <img src="{{ !empty($mitra['logo']) ? asset($mitra['logo']) : '' }}" alt="Preview Logo" class="object-contain w-full h-full">
                            </div>
                            <button type="button" class="remove-partner px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 text-sm">&minus;</button>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-3">
                        <button type="button" id="addPartner" class="px-4 py-2 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-100 text-sm font-medium"><i class="fas fa-plus mr-2"></i>Tambah Mitra</button>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Nama dan logo mitra jurusan. Bisa tambah lebih dari satu.</p>
                </div>

                <!-- Biaya SPP -->
                <div>
                    <label for="spp_fee" class="block text-sm font-medium text-gray-700 mb-2">Biaya SPP (Rp)</label>
                    <input type="number" name="spp_fee" id="spp_fee" value="{{ old('spp_fee', $jurusan->spp_fee ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" min="0" step="0.01" placeholder="Contoh: 250000">
                </div>

                <!-- Sertifikasi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sertifikasi yang Bisa Diperoleh</label>
                    <div id="certificationsList" class="space-y-2">
                        @php
                            $oldCerts = old('certifications');
                            $certArr = is_array($oldCerts) ? $oldCerts : (is_array($jurusan->certifications) ? $jurusan->certifications : ['']);
                        @endphp
                        @foreach($certArr as $c)
                        <div class="flex items-center space-x-2">
                            <input type="text" name="certifications[]" value="{{ $c }}" placeholder="Nama Sertifikasi" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                            <button type="button" class="remove-certification px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 text-sm">&minus;</button>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-3">
                        <button type="button" id="addCertification" class="px-4 py-2 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-100 text-sm font-medium"><i class="fas fa-plus mr-2"></i>Tambah Sertifikasi</button>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Bisa tambah lebih dari satu sertifikasi.</p>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-t border-gray-100">
                <a href="{{ route('admin.jurusans.index') }}" class="px-4 py-2 text-gray-700 hover:text-gray-900 font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <button type="submit" class="px-6 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-lg hover:shadow-lg transition-all font-medium">
                    <i class="fas fa-save mr-2"></i>Update Jurusan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Auto generate slug from name
    document.getElementById('name').addEventListener('input', function() {
        const name = this.value;
        const slug = name.toLowerCase()
            .replace(/[^\w\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .trim();
        document.getElementById('slug').value = slug;
    });

    // Image preview untuk 3 foto
    function previewImage(event, previewId) {
        const reader = new FileReader();
        reader.onload = function() {
            const preview = document.getElementById(previewId);
            const img = preview.querySelector('img');
            img.src = reader.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    // Subjects dynamic fields (same behavior as create view)
        // Prospek lulusan dinamis
        (function(){
            const prospectsList = document.getElementById('prospectsList');
            const addBtn = document.getElementById('addProspect');
            addBtn.addEventListener('click', function(e){
                e.preventDefault();
                const wrapper = document.createElement('div');
                wrapper.className = 'flex items-center space-x-2';
                wrapper.innerHTML = `<input type=\"text\" name=\"prospects[]\" placeholder=\"Prospek lulusan\" class=\"flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500\" />
                    <button type=\"button\" class=\"remove-prospect px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 text-sm\">&minus;</button>`;
                prospectsList.appendChild(wrapper);
            });
            prospectsList.addEventListener('click', function(e){
                if(e.target.classList.contains('remove-prospect')){
                    if(prospectsList.children.length > 1){
                        e.target.parentElement.remove();
                    } else {
                        e.target.parentElement.querySelector('input[type=text]').value = '';
                    }
                }
            });
        })();
    (function(){
        const subjectsList = document.getElementById('subjectsList');
        const addBtn = document.getElementById('addSubject');

        function createRow(value = ''){
            const wrapper = document.createElement('div');
            wrapper.className = 'flex items-center space-x-2';

            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'subjects[]';
            input.value = value;
            input.placeholder = 'Nama mata pelajaran';
            input.className = 'flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500';

            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'remove-subject inline-flex items-center justify-center px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors text-sm font-medium';
            btn.innerHTML = '&minus;';
            btn.addEventListener('click', function(){
                if(subjectsList.querySelectorAll('input[name="subjects[]"]').length > 1){
                    wrapper.remove();
                } else {
                    input.value = '';
                }
            });

            wrapper.appendChild(input);
            wrapper.appendChild(btn);
            return wrapper;
        }

        // wire existing remove buttons
        subjectsList.querySelectorAll('.remove-subject').forEach(function(b){
            b.addEventListener('click', function(){
                const row = this.closest('.flex');
                if(subjectsList.querySelectorAll('input[name="subjects[]"]').length > 1){
                    row.remove();
                } else {
                    row.querySelector('input[name="subjects[]"]').value = '';
                }
            });
        });

        addBtn.addEventListener('click', function(){
            subjectsList.appendChild(createRow(''));
        });
    })();

    // Mitra dinamis
    (function(){
        const partnersList = document.getElementById('partnersList');
        const addBtn = document.getElementById('addPartner');
        let partnerIdx = 1;
        addBtn.addEventListener('click', function(e){
            e.preventDefault();
            const wrapper = document.createElement('div');
            wrapper.className = 'flex items-center space-x-2';
            wrapper.innerHTML = `<input type=\"text\" name=\"partners[${partnerIdx}][name]\" placeholder=\"Nama Mitra\" class=\"flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500\" />
                <input type=\"file\" name=\"partner_logos[${partnerIdx}]\" accept=\"image/*\" class=\"block text-sm text-gray-500\" />
                <button type=\"button\" class=\"remove-partner px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 text-sm\">&minus;</button>`;
            partnersList.appendChild(wrapper);
            partnerIdx++;
        });
        partnersList.addEventListener('click', function(e){
            if(e.target.classList.contains('remove-partner')){
                if(partnersList.children.length > 1){
                    e.target.parentElement.remove();
                } else {
                    e.target.parentElement.querySelector('input[type=text]').value = '';
                }
            }
        });
    })();

    // Sertifikasi dinamis
    (function(){
        const certificationsList = document.getElementById('certificationsList');
        const addBtn = document.getElementById('addCertification');
        addBtn.addEventListener('click', function(e){
            e.preventDefault();
            const wrapper = document.createElement('div');
            wrapper.className = 'flex items-center space-x-2';
            wrapper.innerHTML = `<input type=\"text\" name=\"certifications[]\" placeholder=\"Nama Sertifikasi\" class=\"flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500\" />
                <button type=\"button\" class=\"remove-certification px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 text-sm\">&minus;</button>`;
            certificationsList.appendChild(wrapper);
        });
        certificationsList.addEventListener('click', function(e){
            if(e.target.classList.contains('remove-certification')){
                if(certificationsList.children.length > 1){
                    e.target.parentElement.remove();
                } else {
                    e.target.parentElement.querySelector('input[type=text]').value = '';
                }
            }
        });
    })();
</script>
@endpush
@endsection
