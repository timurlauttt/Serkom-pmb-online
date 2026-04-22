@extends('pmb.layouts.app')

@section('title', 'Edit Data Diri')

@push('styles')
    <style>
        .group-card {
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 18px;
            background: #fff;
        }

        .section-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 12px;
        }

        .form-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            background: #fff;
            color: #111827;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .form-input,
        .form-select {
            height: 44px;
            padding: 0 12px;
        }

        .form-textarea {
            min-height: 92px;
            padding: 10px 12px;
            resize: vertical;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }

        .readonly-input {
            background: #f3f4f6;
            color: #4b5563;
        }
    </style>
@endpush

@section('content')

    <div class="max-w-6xl mx-auto">
        <!-- Error Messages -->
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
                <p class="text-red-700 font-semibold mb-2">Terjadi kesalahan validasi:</p>
                <ul class="list-disc list-inside text-red-600 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 md:p-8">
            <div class="mb-6 border-b border-gray-100 pb-4 flex items-start justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Edit Data Diri Calon Siswa</h1>
                    <p class="text-sm text-gray-500 mt-1">Ubah data sesuai format formulir BNSP.</p>
                </div>
            </div>

            <form method="POST" action="{{ route('pmb.dashboard.data-diri.update') }}" class="space-y-4">
                @csrf

                <!-- SECTION 1: DATA PRIBADI -->
                <div class="group-card">
                    <h2 class="group-title font-bold">1. DATA PRIBADI</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
                        <div>
                            <label class="form-label">Nama Lengkap (sesuai ijazah disertai gelar)</label>
                            <input type="text" value="{{ $casis->nama_lengkap }}" readonly
                                class="form-input readonly-input" />
                        </div>
                    </div>
                </div>

                <!-- SECTION 2: ALAMAT -->
                <div class="group-card">
                    <h2 class="group-title font-bold">2. ALAMAT</h2>
                    <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                        <div>
                            <label for="alamat_ktp" class="form-label">Alamat KTP</label>
                            <textarea id="alamat_ktp" name="alamat_ktp" class="form-textarea">{{ old('alamat_ktp', $casis->alamat_ktp) }}</textarea>
                            @error('alamat_ktp')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="alamat_saat_ini" class="form-label">Alamat Lengkap Saat Ini</label>
                            <textarea id="alamat_saat_ini" name="alamat_saat_ini" class="form-textarea">{{ old('alamat_saat_ini', $casis->alamat_saat_ini) }}</textarea>
                            @error('alamat_saat_ini')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-4">
                        <div>
                            <label for="kecamatan" class="form-label">Kecamatan</label>
                            <input id="kecamatan" name="kecamatan" type="text"
                                value="{{ old('kecamatan', $casis->kecamatan) }}" class="form-input" />
                            @error('kecamatan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="provinsi_id" class="form-label">Provinsi</label>
                            <select id="provinsi_id" name="provinsi_id" class="form-select">
                                <option value="">-- Pilih Provinsi --</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}" @selected(old('provinsi_id', $casis->provinsi_id) == $province->id)>{{ $province->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('provinsi_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="kabupaten_id" class="form-label">Kabupaten</label>
                            <select id="kabupaten_id" name="kabupaten_id" class="form-select">
                                <option value="">-- Pilih Kabupaten --</option>
                                @foreach ($regencies as $regency)
                                    <option value="{{ $regency->id }}" @selected(old('kabupaten_id', $casis->kabupaten_id) == $regency->id)>{{ $regency->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kabupaten_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                        <div>
                            <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                            <input id="nomor_telepon" name="nomor_telepon" type="text"
                                value="{{ old('nomor_telepon', $casis->nomor_telepon) }}" class="form-input" />
                            @error('nomor_telepon')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="no_hp" class="form-label">Nomor HP</label>
                            <input id="no_hp" name="no_hp" type="text" value="{{ old('no_hp', $casis->no_hp) }}"
                                class="form-input" />
                            @error('no_hp')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label">Email</label>
                            <input type="text" value="{{ $casis->email }}" readonly class="form-input readonly-input" />
                        </div>
                    </div>
                </div>

                <!-- SECTION 3: KEWARGANEGARAAN -->
                <div class="group-card">
                    <h2 class="group-title font-bold">3. KEWARGANEGARAAN</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="kewarganegaraan" class="form-label">Pilih Kewarganegaraan</label>
                            <select id="kewarganegaraan" name="kewarganegaraan" class="form-select">
                                <option value="">-- Pilih --</option>
                                <option value="WNI Asli" @selected(old('kewarganegaraan', $casis->kewarganegaraan) === 'WNI Asli')>WNI Asli</option>
                                <option value="WNI Keturunan" @selected(old('kewarganegaraan', $casis->kewarganegaraan) === 'WNI Keturunan')>WNI Keturunan</option>
                                <option value="WNA" @selected(old('kewarganegaraan', $casis->kewarganegaraan) === 'WNA')>WNA</option>
                            </select>
                            @error('kewarganegaraan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div id="wna-field"
                            class="{{ old('kewarganegaraan', $casis->kewarganegaraan) === 'WNA' ? '' : 'hidden' }}">
                            <label for="negara_wna" class="form-label">Jika WNA, Sebutkan Negara</label>
                            <input id="negara_wna" name="negara_wna" type="text"
                                value="{{ old('negara_wna', $casis->negara_wna) }}" class="form-input" />
                            @error('negara_wna')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- SECTION 4: TANGGAL LAHIR -->
                <div class="group-card">
                    <h2 class="group-title font-bold">4. TANGGAL LAHIR (sesuai ijazah)</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input id="tanggal_lahir" name="tanggal_lahir" type="date"
                                value="{{ old('tanggal_lahir', $casis->tanggal_lahir) }}" class="form-input" />
                            @error('tanggal_lahir')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- SECTION 5: TEMPAT LAHIR -->
                <div class="group-card">
                    <h2 class="group-title font-bold">5. TEMPAT LAHIR (sesuai ijazah)</h2>
                    
                    <!-- Checkbox untuk lahir di luar negeri -->
                    <div class="mb-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" id="lahir_luar_negeri" class="w-4 h-4 rounded border-gray-300">
                            <span class="text-sm font-medium text-gray-700">Lahir di luar negeri</span>
                        </label>
                    </div>
                    
                    <!-- Container untuk provinsi dan kabupaten (akan hidden jika lahir di luar negeri) -->
                    <div id="tempat_lahir_dalam_negeri" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="tempat_lahir_provinsi_id" class="form-label">Provinsi</label>
                            <select id="tempat_lahir_provinsi_id" name="tempat_lahir_provinsi_id" class="form-select">
                                <option value="">-- Pilih Provinsi --</option>
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
                            <label for="tempat_lahir_kabupaten_id" class="form-label">Kabupaten/Kota</label>
                            <select id="tempat_lahir_kabupaten_id" name="tempat_lahir_kabupaten_id" class="form-select">
                                <option value="">-- Pilih Kabupaten --</option>
                                @foreach ($tempatLahirRegencies as $regency)
                                    <option value="{{ $regency->id }}" @selected(old('tempat_lahir_kabupaten_id', $casis->tempat_lahir_kabupaten_id) == $regency->id)>{{ $regency->name }}</option>
                                @endforeach
                            </select>
                            @error('tempat_lahir_kabupaten_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div></div>
                    </div>

                    <!-- Container untuk negara (akan hidden jika lahir dalam negeri) -->
                    <div id="tempat_lahir_luar_negeri" class="hidden">
                        <div>
                            <label for="tempat_lahir_negara" class="form-label">Negara Tempat Lahir</label>
                            <input id="tempat_lahir_negara" name="tempat_lahir_negara" type="text"
                                placeholder="Contoh: Inggris, Amerika Serikat, Jepang"
                                value="{{ old('tempat_lahir_negara', $casis->tempat_lahir_negara) }}"
                                class="form-input" />
                            @error('tempat_lahir_negara')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- SECTION 6: JENIS KELAMIN -->
                <div class="group-card">
                    <h2 class="group-title font-bold">6. JENIS KELAMIN</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="jenis_kelamin" class="form-label">Pilih Jenis Kelamin</label>
                            <select id="jenis_kelamin" name="jenis_kelamin" class="form-select">
                                <option value="">-- Pilih --</option>
                                <option value="Pria" @selected(old('jenis_kelamin', $casis->jenis_kelamin) === 'Pria')>Pria</option>
                                <option value="Wanita" @selected(old('jenis_kelamin', $casis->jenis_kelamin) === 'Wanita')>Wanita</option>
                            </select>
                            @error('jenis_kelamin')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- SECTION 7: STATUS MENIKAH -->
                <div class="group-card">
                    <h2 class="group-title font-bold">7. STATUS MENIKAH</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="status_menikah" class="form-label">Pilih Status Menikah</label>
                            <select id="status_menikah" name="status_menikah" class="form-select">
                                <option value="">-- Pilih --</option>
                                <option value="Belum menikah" @selected(old('status_menikah', $casis->status_menikah) === 'Belum menikah')>Belum menikah</option>
                                <option value="Menikah" @selected(old('status_menikah', $casis->status_menikah) === 'Menikah')>Menikah</option>
                                <option value="Lain-lain" @selected(old('status_menikah', $casis->status_menikah) === 'Lain-lain')>Lain-lain (janda/duda)</option>
                            </select>
                            @error('status_menikah')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- SECTION 8: AGAMA -->
                <div class="group-card">
                    <h2 class="group-title font-bold">8. AGAMA</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="religion_id" class="form-label">Pilih Agama</label>
                            <select id="religion_id" name="religion_id" class="form-select">
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
                    </div>
                </div>

                <div class="pt-2 flex items-center gap-3">
                    <button type="submit"
                        class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('pmb.dashboard.data-diri') }}"
                        class="px-6 py-3 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors font-semibold">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        const provinsiSelect = document.getElementById('provinsi_id');
        const kabupatenSelect = document.getElementById('kabupaten_id');
        const tempatLahirProvinsiSelect = document.getElementById('tempat_lahir_provinsi_id');
        const tempatLahirKabupatenSelect = document.getElementById('tempat_lahir_kabupaten_id');
        const kewarganegaraanSelect = document.getElementById('kewarganegaraan');
        const wnaField = document.getElementById('wna-field');
        const lahirLuarNegeriCheckbox = document.getElementById('lahir_luar_negeri');
        const tempatLahirDalamNegeri = document.getElementById('tempat_lahir_dalam_negeri');
        const tempatLahirLuarNegeri = document.getElementById('tempat_lahir_luar_negeri');

        // Initialize checkbox state based on current data
        const initLahirLuarNegeriState = () => {
            const hasProvinsiKabupaten = tempatLahirProvinsiSelect?.value || tempatLahirKabupatenSelect?.value;
            const hasNegara = document.getElementById('tempat_lahir_negara')?.value;
            
            if (hasNegara && !hasProvinsiKabupaten) {
                lahirLuarNegeriCheckbox.checked = true;
                tempatLahirDalamNegeri.classList.add('hidden');
                tempatLahirLuarNegeri.classList.remove('hidden');
            }
        };

        // Call initialization on page load
        initLahirLuarNegeriState();

        // Handle checkbox change
        lahirLuarNegeriCheckbox?.addEventListener('change', function() {
            if (this.checked) {
                // Hide provinsi/kabupaten, show negara field
                tempatLahirDalamNegeri.classList.add('hidden');
                tempatLahirLuarNegeri.classList.remove('hidden');
                
                // Clear provinsi and kabupaten values
                tempatLahirProvinsiSelect.value = '';
                tempatLahirKabupatenSelect.value = '';
                tempatLahirKabupatenSelect.innerHTML = '<option value="">-- Pilih Kabupaten --</option>';
            } else {
                // Show provinsi/kabupaten, hide negara field
                tempatLahirDalamNegeri.classList.remove('hidden');
                tempatLahirLuarNegeri.classList.add('hidden');
                
                // Clear negara value
                document.getElementById('tempat_lahir_negara').value = '';
            }
        });

        kewarganegaraanSelect?.addEventListener('change', function() {
            if (this.value === 'WNA') {
                wnaField.classList.remove('hidden');
            } else {
                wnaField.classList.add('hidden');
            }
        });

        // Fungsi untuk load regencies dari provinsi
        const loadRegencies = async (provinceId, targetSelect) => {
            targetSelect.innerHTML = '<option value="">-- Pilih Kabupaten/Kota --</option>';

            if (!provinceId) return;

            try {
                const response = await fetch(`/pmb/dashboard/provinces/${provinceId}/regencies`);
                const regencies = await response.json();

                regencies.forEach((regency) => {
                    const option = document.createElement('option');
                    option.value = regency.id;
                    option.textContent = regency.name;
                    targetSelect.appendChild(option);
                });
            } catch (error) {
                console.error('Gagal memuat kabupaten:', error);
            }
        };

        // Event listener untuk Alamat - Provinsi
        provinsiSelect?.addEventListener('change', async function() {
            await loadRegencies(this.value, kabupatenSelect);
        });

        // Event listener untuk Tempat Lahir - Provinsi
        tempatLahirProvinsiSelect?.addEventListener('change', async function() {
            await loadRegencies(this.value, tempatLahirKabupatenSelect);
        });

        // Load initial data jika ada nilai yang tersimpan
        if (provinsiSelect?.value) {
            loadRegencies(provinsiSelect.value, kabupatenSelect);
        }

        if (tempatLahirProvinsiSelect?.value) {
            loadRegencies(tempatLahirProvinsiSelect.value, tempatLahirKabupatenSelect);
        }
    </script>
@endpush
