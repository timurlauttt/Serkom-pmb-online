@extends('layouts.admin')

@section('title', 'Edit Data Calon Siswa')
@section('page-title', 'Edit Data Calon Siswa')
@section('page-description', 'Ubah informasi data registrasi calon siswa')

@section('content')
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.pendaftaran.calon-siswa.show', $casis->id) }}"
                class="inline-flex items-center px-4 py-2 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 text-sm font-medium">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Detail
            </a>
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6">
            <div class="mb-6 border-b border-gray-100 pb-4">
                <h1 class="text-2xl font-bold text-gray-800">Edit Data Calon Siswa</h1>
                <p class="text-sm text-gray-500 mt-1">{{ $casis->nama_lengkap }} ({{ $casis->email }})</p>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
                    <p class="text-red-700 font-semibold mb-2">Terjadi kesalahan validasi:</p>
                    <ul class="list-disc list-inside text-red-600 text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.pendaftaran.calon-siswa.update', $casis->id) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- SECTION 1: DATA PRIBADI -->
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                    <h3 class="text-base font-semibold text-gray-800 mb-4">1. Data Pribadi</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-600 mb-1 text-sm font-medium">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap"
                                value="{{ old('nama_lengkap', $casis->nama_lengkap) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                            @error('nama_lengkap')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-600 mb-1 text-sm font-medium">Email</label>
                            <input type="email" name="email" value="{{ old('email', $casis->email) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-600 mb-1 text-sm font-medium">No HP</label>
                            <input type="text" name="no_hp" value="{{ old('no_hp', $casis->no_hp) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                            @error('no_hp')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-600 mb-1 text-sm font-medium">Nomor Telepon</label>
                            <input type="text" name="nomor_telepon" value="{{ old('nomor_telepon', $casis->nomor_telepon) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                            @error('nomor_telepon')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-600 mb-1 text-sm font-medium">Jenis Kelamin</label>
                            <select name="jenis_kelamin"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                <option value="">-- Pilih --</option>
                                <option value="Pria" @selected(old('jenis_kelamin', $casis->jenis_kelamin) === 'Pria')>Pria</option>
                                <option value="Wanita" @selected(old('jenis_kelamin', $casis->jenis_kelamin) === 'Wanita')>Wanita</option>
                            </select>
                            @error('jenis_kelamin')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-600 mb-1 text-sm font-medium">Status Menikah</label>
                            <select name="status_menikah"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                <option value="">-- Pilih --</option>
                                <option value="Belum menikah" @selected(old('status_menikah', $casis->status_menikah) === 'Belum menikah')>Belum menikah</option>
                                <option value="Menikah" @selected(old('status_menikah', $casis->status_menikah) === 'Menikah')>Menikah</option>
                                <option value="Lain-lain" @selected(old('status_menikah', $casis->status_menikah) === 'Lain-lain')>Lain-lain</option>
                            </select>
                            @error('status_menikah')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-600 mb-1 text-sm font-medium">Agama</label>
                            <select name="religion_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                <option value="">-- Pilih --</option>
                                @foreach ($religions as $religion)
                                    <option value="{{ $religion->id }}" @selected(old('religion_id', $casis->religion_id) == $religion->id)>
                                        {{ $religion->name }}</option>
                                @endforeach
                            </select>
                            @error('religion_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-600 mb-1 text-sm font-medium">Kewarganegaraan</label>
                            <select name="kewarganegaraan" id="kewarganegaraan"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                <option value="">-- Pilih --</option>
                                <option value="WNI Asli" @selected(old('kewarganegaraan', $casis->kewarganegaraan) === 'WNI Asli')>WNI Asli</option>
                                <option value="WNI Keturunan" @selected(old('kewarganegaraan', $casis->kewarganegaraan) === 'WNI Keturunan')>WNI Keturunan</option>
                                <option value="WNA" @selected(old('kewarganegaraan', $casis->kewarganegaraan) === 'WNA')>WNA</option>
                            </select>
                            @error('kewarganegaraan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div id="negara-wna-wrap" class="md:col-span-2 {{ old('kewarganegaraan', $casis->kewarganegaraan) === 'WNA' ? '' : 'hidden' }}">
                            <label class="block text-gray-600 mb-1 text-sm font-medium">Negara WNA</label>
                            <input type="text" name="negara_wna" value="{{ old('negara_wna', $casis->negara_wna) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                            @error('negara_wna')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- SECTION 2: ALAMAT -->
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                    <h3 class="text-base font-semibold text-gray-800 mb-4">2. Alamat</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-gray-600 mb-1 text-sm font-medium">Alamat KTP</label>
                            <textarea name="alamat_ktp" rows="2"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">{{ old('alamat_ktp', $casis->alamat_ktp) }}</textarea>
                            @error('alamat_ktp')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-gray-600 mb-1 text-sm font-medium">Alamat Saat Ini</label>
                            <textarea name="alamat_saat_ini" rows="2"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">{{ old('alamat_saat_ini', $casis->alamat_saat_ini) }}</textarea>
                            @error('alamat_saat_ini')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-600 mb-1 text-sm font-medium">Kecamatan</label>
                            <input type="text" name="kecamatan" value="{{ old('kecamatan', $casis->kecamatan) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                            @error('kecamatan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-600 mb-1 text-sm font-medium">Provinsi</label>
                            <select name="provinsi_id" id="provinsi_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                <option value="">-- Pilih --</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}" @selected(old('provinsi_id', $casis->provinsi_id) == $province->id)>
                                        {{ $province->name }}</option>
                                @endforeach
                            </select>
                            @error('provinsi_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-gray-600 mb-1 text-sm font-medium">Kabupaten/Kota</label>
                            <select name="kabupaten_id" id="kabupaten_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                <option value="">-- Pilih --</option>
                                @foreach ($regencies as $regency)
                                    <option value="{{ $regency->id }}" @selected(old('kabupaten_id', $casis->kabupaten_id) == $regency->id)>
                                        {{ $regency->name }}</option>
                                @endforeach
                            </select>
                            @error('kabupaten_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- SECTION 3: TANGGAL LAHIR -->
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                    <h3 class="text-base font-semibold text-gray-800 mb-4">3. Tanggal Lahir</h3>
                    <div>
                        <label class="block text-gray-600 mb-1 text-sm font-medium">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $casis->tanggal_lahir) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                        @error('tanggal_lahir')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- SECTION 4: TEMPAT LAHIR -->
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                    <h3 class="text-base font-semibold text-gray-800 mb-4">4. Tempat Lahir</h3>
                    
                    <div class="mb-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" id="lahir_luar_negeri_admin" class="w-4 h-4 rounded border-gray-300">
                            <span class="text-sm font-medium text-gray-700">Lahir di luar negeri</span>
                        </label>
                    </div>

                    <div id="tempat_lahir_dalam_negeri_admin" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-gray-600 mb-1 text-sm font-medium">Provinsi</label>
                            <select name="tempat_lahir_provinsi_id" id="tempat_lahir_provinsi_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                <option value="">-- Pilih --</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}" @selected(old('tempat_lahir_provinsi_id', $casis->tempat_lahir_provinsi_id) == $province->id)>
                                        {{ $province->name }}</option>
                                @endforeach
                            </select>
                            @error('tempat_lahir_provinsi_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-600 mb-1 text-sm font-medium">Kabupaten/Kota</label>
                            <select name="tempat_lahir_kabupaten_id" id="tempat_lahir_kabupaten_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                <option value="">-- Pilih --</option>
                                @if (isset($tempatLahirRegencies))
                                    @foreach ($tempatLahirRegencies as $regency)
                                        <option value="{{ $regency->id }}" @selected(old('tempat_lahir_kabupaten_id', $casis->tempat_lahir_kabupaten_id) == $regency->id)>
                                            {{ $regency->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('tempat_lahir_kabupaten_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div></div>
                    </div>

                    <div id="tempat_lahir_luar_negeri_admin" class="hidden">
                        <label class="block text-gray-600 mb-1 text-sm font-medium">Negara Tempat Lahir</label>
                        <input type="text" name="tempat_lahir_negara" placeholder="Contoh: Inggris, Amerika Serikat, Jepang"
                            value="{{ old('tempat_lahir_negara', $casis->tempat_lahir_negara) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                        @error('tempat_lahir_negara')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- SECTION 5: PASSWORD (OPTIONAL) -->
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                    <h3 class="text-base font-semibold text-gray-800 mb-4">5. Ubah Password (Opsional)</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-600 mb-1 text-sm font-medium">Password Baru</label>
                            <input type="password" name="password"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                                placeholder="Kosongkan jika tidak diubah">
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-600 mb-1 text-sm font-medium">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                                placeholder="Ulangi password baru">
                        </div>
                    </div>
                </div>

                <!-- BUTTONS -->
                <div class="pt-4 flex items-center gap-3">
                    <button type="submit"
                        class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                        <i class="fas fa-save mr-2"></i>Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.pendaftaran.calon-siswa.show', $casis->id) }}"
                        class="px-6 py-3 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors font-semibold">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            const kewarganegaraanSelect = document.getElementById('kewarganegaraan');
            const negaraWnaWrap = document.getElementById('negara-wna-wrap');
            const provinsiSelect = document.getElementById('provinsi_id');
            const kabupatenSelect = document.getElementById('kabupaten_id');
            const tempatLahirProvinsiSelect = document.getElementById('tempat_lahir_provinsi_id');
            const tempatLahirKabupatenSelect = document.getElementById('tempat_lahir_kabupaten_id');
            const lahirLuarNegeriCheckbox = document.getElementById('lahir_luar_negeri_admin');
            const tempatLahirDalamNegeriAdmin = document.getElementById('tempat_lahir_dalam_negeri_admin');
            const tempatLahirLuarNegeriAdmin = document.getElementById('tempat_lahir_luar_negeri_admin');

            // Initialize checkbox state
            const initLahirLuarNegeriState = () => {
                const hasProvinsiKabupaten = tempatLahirProvinsiSelect?.value || tempatLahirKabupatenSelect?.value;
                const tempatLahirNegaraInput = document.querySelector('input[name="tempat_lahir_negara"]');
                const hasNegara = tempatLahirNegaraInput?.value;
                
                if (hasNegara && !hasProvinsiKabupaten) {
                    lahirLuarNegeriCheckbox.checked = true;
                    tempatLahirDalamNegeriAdmin.classList.add('hidden');
                    tempatLahirLuarNegeriAdmin.classList.remove('hidden');
                }
            };

            initLahirLuarNegeriState();

            lahirLuarNegeriCheckbox?.addEventListener('change', function() {
                if (this.checked) {
                    tempatLahirDalamNegeriAdmin.classList.add('hidden');
                    tempatLahirLuarNegeriAdmin.classList.remove('hidden');
                    tempatLahirProvinsiSelect.value = '';
                    tempatLahirKabupatenSelect.value = '';
                    tempatLahirKabupatenSelect.innerHTML = '<option value="">-- Pilih --</option>';
                } else {
                    tempatLahirDalamNegeriAdmin.classList.remove('hidden');
                    tempatLahirLuarNegeriAdmin.classList.add('hidden');
                    document.querySelector('input[name="tempat_lahir_negara"]').value = '';
                }
            });

            kewarganegaraanSelect?.addEventListener('change', function() {
                if (this.value === 'WNA') {
                    negaraWnaWrap?.classList.remove('hidden');
                } else {
                    negaraWnaWrap?.classList.add('hidden');
                }
            });

            const loadRegencies = async (provinceId, targetSelect) => {
                targetSelect.innerHTML = '<option value="">-- Pilih --</option>';
                if (!provinceId) return;

                try {
                    const response = await fetch(`/admin/pendaftaran/provinces/${provinceId}/regencies`);
                    if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                    const regencies = await response.json();

                    regencies.forEach((regency) => {
                        const option = document.createElement('option');
                        option.value = regency.id;
                        option.textContent = regency.name;
                        targetSelect.appendChild(option);
                    });
                } catch (e) {
                    console.error('Gagal memload regencies:', e);
                }
            };

            provinsiSelect?.addEventListener('change', async function() {
                await loadRegencies(this.value, kabupatenSelect);
            });

            tempatLahirProvinsiSelect?.addEventListener('change', async function() {
                await loadRegencies(this.value, tempatLahirKabupatenSelect);
            });

            if (provinsiSelect?.value) {
                loadRegencies(provinsiSelect.value, kabupatenSelect);
            }

            if (tempatLahirProvinsiSelect?.value) {
                loadRegencies(tempatLahirProvinsiSelect.value, tempatLahirKabupatenSelect);
            }
        </script>
    @endpush
@endsection
