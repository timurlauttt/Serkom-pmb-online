@extends('layouts.admin')

@section('title', 'Edit Profile Sekolah')
@section('page-title', 'Edit Profile Sekolah')
@section('page-description', 'Perbarui informasi profile sekolah')

@section('content')
<div class="max-w-4xl">
    <form id="profileForm" action="{{ route('admin.profiles.update', $profile->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        @csrf
        @method('PUT')
        
        <div class="p-8 space-y-6">
            <!-- Vision -->
            <div>
                <label for="vision" class="block text-sm font-semibold text-gray-700 mb-2">
                    Visi Sekolah <span class="text-red-500">*</span>
                </label>
                <textarea 
                    name="vision" 
                    id="vision" 
                    rows="3" 
                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 transition-colors @error('vision') border-red-500 @enderror"
                    required>{{ old('vision', $profile->vision) }}</textarea>
                @error('vision')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mission -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Misi Sekolah <span class="text-red-500">*</span>
                </label>
                <div id="missionsList" class="space-y-2">
                    <!-- dynamic mission inputs inserted here -->
                </div>
                <div class="mt-2">
                    <button type="button" id="addMissionBtn" class="px-3 py-1 bg-blue-50 text-blue-600 rounded-md">Tambah Misi</button>
                </div>
                @error('mission')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- History -->
            <div>
                <label for="history" class="block text-sm font-semibold text-gray-700 mb-2">
                    Sejarah Sekolah <span class="text-red-500">*</span>
                </label>
                <textarea 
                    name="history" 
                    id="history" 
                    rows="6" 
                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 transition-colors @error('history') border-red-500 @enderror"
                    required>{{ old('history', $profile->history) }}</textarea>
                @error('history')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Facilities -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Fasilitas Sekolah <span class="text-red-500">*</span>
                </label>
                <div id="facilitiesList" class="space-y-2">
                    <!-- dynamic facility inputs inserted here -->
                </div>
                <div class="mt-2">
                    <button type="button" id="addFacilityBtn" class="px-3 py-1 bg-blue-50 text-blue-600 rounded-md">Tambah Fasilitas</button>
                </div>
                @error('facilities')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Accreditation -->
            <div>
                <label for="accreditation" class="block text-sm font-semibold text-gray-700 mb-2">
                    Akreditasi <span class="text-red-500">*</span>
                </label>
                <select 
                    name="accreditation" 
                    id="accreditation" 
                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 transition-colors @error('accreditation') border-red-500 @enderror"
                    required>
                    <option value="">Pilih Akreditasi</option>
                    <option value="A" {{ old('accreditation', $profile->accreditation) == 'A' ? 'selected' : '' }}>A (Unggul)</option>
                    <option value="B" {{ old('accreditation', $profile->accreditation) == 'B' ? 'selected' : '' }}>B (Baik)</option>
                    <option value="C" {{ old('accreditation', $profile->accreditation) == 'C' ? 'selected' : '' }}>C (Cukup)</option>
                </select>
                @error('accreditation')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Organization Chart -->
            <div>
                <label for="org_chart_path" class="block text-sm font-semibold text-gray-700 mb-2">
                    Struktur Organisasi
                    <span class="text-xs text-gray-500 font-normal">(Format: JPG, PNG, maksimal 2MB)</span>
                </label>
                
                @if($profile->org_chart_path)
                    <div class="mb-3">
                        <p class="text-sm text-gray-600 mb-2">Gambar saat ini:</p>
                        <img src="{{ asset($profile->org_chart_path) }}" alt="Current Organization Chart" class="max-w-xs rounded-lg shadow-md">
                    </div>
                @endif
                
                <div class="mt-2">
                    <input 
                        type="file" 
                        name="org_chart" 
                        id="org_chart_path" 
                        accept="image/*"
                        class="hidden"
                        onchange="previewImage(event)">
                    <label for="org_chart_path" class="cursor-pointer inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        <i class="fas fa-cloud-upload-alt mr-2"></i>
                        {{ $profile->org_chart_path ? 'Ganti Gambar' : 'Pilih Gambar' }}
                    </label>
                </div>
                <div id="imagePreview" class="mt-4 hidden">
                    <p class="text-sm text-gray-600 mb-2">Preview gambar baru:</p>
                    <img src="" alt="Preview" class="max-w-xs rounded-lg shadow-md">
                </div>
                @error('org_chart_path')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Actions -->
        <div class="bg-gray-50 px-8 py-4 flex justify-between items-center border-t border-gray-100">
            <a href="{{ route('admin.profiles.index') }}" class="px-4 py-2 text-gray-700 hover:text-gray-900 font-medium">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            <button type="submit" class="px-6 py-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-lg hover:from-purple-600 hover:to-pink-600 transition-all font-medium shadow-md hover:shadow-lg">
                <i class="fas fa-save mr-2"></i>Update Profile
            </button>
        </div>
    </form>
</div>

<script>
function previewImage(event) {
    const preview = document.getElementById('imagePreview');
    const previewImg = preview.querySelector('img');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    } else {
        preview.classList.add('hidden');
    }
}
</script>
<script>
// Prepare mission[] and facilities[][name] inputs before submitting
document.getElementById('profileForm').addEventListener('submit', function(e) {
    // remove any previous dynamic inputs
    document.querySelectorAll('.dynamic-input').forEach(function(n){ n.remove(); });

    // mission textarea -> mission[]
    const missionTextarea = document.getElementById('mission');
    if (missionTextarea) {
        const lines = missionTextarea.value.split(/\r?\n/).map(l => l.trim()).filter(l => l.length > 0);
        lines.forEach(function(line) {
            const inp = document.createElement('input');
            inp.type = 'hidden';
            inp.name = 'mission[]';
            inp.value = line;
            inp.className = 'dynamic-input';
            e.target.appendChild(inp);
        });
    }

    // facilities textarea -> facilities[][name]
    const facilitiesTextarea = document.getElementById('facilities');
    if (facilitiesTextarea) {
        const lines = facilitiesTextarea.value.split(/\r?\n/).map(l => l.trim()).filter(l => l.length > 0);
        lines.forEach(function(line) {
            const inp = document.createElement('input');
            inp.type = 'hidden';
            inp.name = 'facilities[][name]';
            inp.value = line;
            inp.className = 'dynamic-input';
            e.target.appendChild(inp);
        });
    }
    // allow form to submit normally
});
</script>
<script>
// Dynamic add/remove for missions and facilities (edit)
(function(){
    function createMissionInput(value = ''){
        const wrapper = document.createElement('div');
        wrapper.className = 'flex items-center gap-2';
        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'mission[]';
        input.required = true;
        input.value = value;
        input.className = 'w-full px-4 py-2 rounded-lg border border-gray-200';
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'px-3 py-1 bg-red-50 text-red-600 rounded-md';
        btn.innerText = 'Hapus';
        btn.addEventListener('click', function(){ wrapper.remove(); });
        wrapper.appendChild(input);
        wrapper.appendChild(btn);
        return wrapper;
    }

    function createFacilityInput(value = ''){
        const wrapper = document.createElement('div');
        wrapper.className = 'flex items-center gap-2';
        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'facilities[][name]';
        input.required = true;
        input.value = value;
        input.className = 'w-full px-4 py-2 rounded-lg border border-gray-200';
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'px-3 py-1 bg-red-50 text-red-600 rounded-md';
        btn.innerText = 'Hapus';
        btn.addEventListener('click', function(){ wrapper.remove(); });
        wrapper.appendChild(input);
        wrapper.appendChild(btn);
        return wrapper;
    }

    const missionsList = document.getElementById('missionsList');
    const facilitiesList = document.getElementById('facilitiesList');
    const addMissionBtn = document.getElementById('addMissionBtn');
    const addFacilityBtn = document.getElementById('addFacilityBtn');

    // Prefill from old or profile data
    const oldMissions = {!! json_encode(old('mission', [])) !!};
    const oldFacilities = {!! json_encode(old('facilities', [])) !!};
    const profileMissions = {!! json_encode(is_array($profile->mission) ? $profile->mission : []) !!};
    const profileFacilities = {!! json_encode(is_array($profile->facilities) ? $profile->facilities : []) !!};

    function populateMissions(){
        if (Array.isArray(oldMissions) && oldMissions.length > 0) {
            oldMissions.forEach(function(m){ missionsList.appendChild(createMissionInput(m)); });
        } else if (Array.isArray(profileMissions) && profileMissions.length > 0) {
            profileMissions.forEach(function(m){ missionsList.appendChild(createMissionInput(m)); });
        } else {
            missionsList.appendChild(createMissionInput(''));
        }
    }

    function populateFacilities(){
        if (Array.isArray(oldFacilities) && oldFacilities.length > 0) {
            oldFacilities.forEach(function(f){
                if (typeof f === 'string') {
                    facilitiesList.appendChild(createFacilityInput(f));
                } else if (f && f.name) {
                    facilitiesList.appendChild(createFacilityInput(f.name));
                } else {
                    facilitiesList.appendChild(createFacilityInput(''));
                }
            });
        } else if (Array.isArray(profileFacilities) && profileFacilities.length > 0) {
            profileFacilities.forEach(function(f){
                if (typeof f === 'string') {
                    facilitiesList.appendChild(createFacilityInput(f));
                } else if (f && f.name) {
                    facilitiesList.appendChild(createFacilityInput(f.name));
                } else {
                    facilitiesList.appendChild(createFacilityInput(''));
                }
            });
        } else {
            facilitiesList.appendChild(createFacilityInput(''));
        }
    }

    populateMissions();
    populateFacilities();

    addMissionBtn.addEventListener('click', function(){ missionsList.appendChild(createMissionInput('')); });
    addFacilityBtn.addEventListener('click', function(){ facilitiesList.appendChild(createFacilityInput('')); });
})();
</script>
@endsection
