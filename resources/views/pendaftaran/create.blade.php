@extends('utama.layouts.app')
@section('title', 'Form Pendaftaran Siswa Baru')

@push('styles')
    <style>
        .pendaftaran-header {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            color: white;
            padding: 3rem 0;
            margin-top: 80px;
            text-align: center;
        }

        .pendaftaran-header h1 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        .form-container {
            max-width: 1200px;
            margin: 3rem auto;
            background: white;
            padding: 2.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .form-section {
            margin-bottom: 2.5rem;
            padding-bottom: 2rem;
            border-bottom: 2px solid #f3f4f6;
        }

        .form-section:last-child {
            border-bottom: none;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1e3a8a;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 3px solid #3b82f6;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #374151;
        }

        .form-group label .required {
            color: #dc2626;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            font-size: 1rem;
        }

        .form-control:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .file-upload-area {
            border: 2px dashed #d1d5db;
            border-radius: 4px;
            padding: 1rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .file-upload-area:hover {
            border-color: #3b82f6;
            background-color: #f9fafb;
        }

        .file-upload-area input[type="file"] {
            display: none;
        }

        .file-info {
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: 0.5rem;
        }

        .btn-primary {
            background: #3b82f6;
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 4px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: background 0.3s;
        }

        .btn-primary:hover {
            background: #2563eb;
        }

        .alert {
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1.5rem;
        }

        .alert-danger {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .alert-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
        }

        /* Responsive Mobile */
        @media (max-width: 768px) {
            .pendaftaran-header {
                padding: 2rem 1rem;
                margin-top: 60px;
            }

            .pendaftaran-header h1 {
                font-size: 1.5rem;
            }

            .pendaftaran-header p {
                font-size: 0.875rem;
            }

            .form-container {
                /* make the form container wider on mobile by reducing side margins further */
                margin: 0.75rem 0.2rem;
                padding: 1rem;
                max-width: none;
                width: calc(100% - 0.4rem);
            }

            .section-title {
                font-size: 1.25rem;
            }

            /* Force single-column layout for all form rows on mobile */
            .form-row {
                grid-template-columns: 1fr;
                gap: 1rem;
                display: block;
            }

            .form-control {
                font-size: 0.875rem;
                padding: 0.625rem;
            }

            /* Ensure each form-group occupies full width and stacks nicely */
            .form-row .form-group {
                width: 100%;
                display: block;
                margin-bottom: 1rem;
            }

            .form-row .form-group .form-control,
            .form-row .form-group select,
            .form-row .form-group textarea {
                width: 100%;
                box-sizing: border-box;
            }

            .form-group label {
                font-size: 0.875rem;
            }

            .btn-primary {
                padding: 0.875rem 1.5rem;
                font-size: 1rem;
            }

            .file-upload-area {
                padding: 0.75rem;
                font-size: 0.875rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="pendaftaran-header">
        <div class="container">
            <h1 class="mobile:text-lg" >Form Pendaftaran Siswa Baru</h1>
            <p class="mobile:text-sm">SMK Tamansiswa Purwokerto - Tahun Ajaran {{ date('Y') }}/{{ date('Y') + 1 }}</p>
        </div>
    </div>

    <div class="container">
        <div class="form-container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi kesalahan:</strong>
                    <ul style="margin: 0.5rem 0 0 1.5rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Data Pribadi Siswa -->
                <div class="form-section">
                    <h2 class="mobile:text-lg font-bold section-title">Data Pribadi Siswa</h2>

                    <div class="form-group mobile:text-sm">
                        <label>Email <span class="required">*</span></label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>

                    <div class="form-group mobile:text-sm">
                        <label>Nama Lengkap <span class="required">*</span></label>
                        <input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap') }}"
                            required>
                    </div>

                    <div class="form-row mobile:text-sm">
                        <div class="form-group mobile:text-sm">
                            <label>Tempat Lahir <span class="required">*</span></label>
                            <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir') }}"
                                required>
                        </div>
                        <div class="form-group mobile:text-sm">
                            <label>Tanggal Lahir <span class="required">*</span></label>
                            <input type="date" name="tanggal_lahir" class="form-control"
                                value="{{ old('tanggal_lahir') }}" required>
                        </div>
                    </div>

                    <div class="form-row mobile:text-sm">
                        <div class="form-group mobile:text-sm">
                            <label>Jenis Kelamin <span class="required">*</span></label>
                            <select name="jenis_kelamin" class="form-control" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group mobile:text-sm">
                            <label>No. HP Siswa <span class="required">*</span></label>
                            <input type="tel" name="no_hp_siswa" class="form-control" value="{{ old('no_hp_siswa') }}"
                                required>
                        </div>
                    </div>

                    <div class="form-group mobile:text-sm">
                        <label>Alamat Tempat Tinggal <span class="required">*</span></label>
                        <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat') }}</textarea>
                    </div>
                </div>

                <!-- Data Orang Tua / Wali -->
                <div class="form-section">
                    <h2 class="mobile:text-lg font-bold section-title">Data Orang Tua / Wali</h2>

                    <div class="form-row mobile:text-sm">
                        <div class="form-group mobile:text-sm">
                            <label>Nama Ayah <span class="required">*</span></label>
                            <input type="text" name="nama_ayah" class="form-control" value="{{ old('nama_ayah') }}"
                                required>
                        </div>
                        <div class="form-group mobile:text-sm">
                            <label>Pekerjaan Ayah <span class="required">*</span></label>
                            <input type="text" name="pekerjaan_ayah" class="form-control"
                                value="{{ old('pekerjaan_ayah') }}" required>
                        </div>
                    </div>

                    <div class="form-row mobile:text-sm">
                        <div class="form-group mobile:text-sm">
                            <label>Nama Ibu <span class="required">*</span></label>
                            <input type="text" name="nama_ibu" class="form-control" value="{{ old('nama_ibu') }}"
                                required>
                        </div>
                        <div class="form-group mobile:text-sm">
                            <label>Pekerjaan Ibu <span class="required">*</span></label>
                            <input type="text" name="pekerjaan_ibu" class="form-control"
                                value="{{ old('pekerjaan_ibu') }}" required>
                        </div>
                    </div>

                    <div class="form-group mobile:text-sm">
                        <label>Nama Wali (Jika Ada)</label>
                        <input type="text" name="nama_wali" class="form-control" value="{{ old('nama_wali') }}">
                    </div>

                    <div class="form-group mobile:text-sm">
                        <label>No. HP Orangtua/Wali <span class="required">*</span></label>
                        <input type="tel" name="no_hp_ortu" class="form-control" value="{{ old('no_hp_ortu') }}"
                            required>
                    </div>

                    <div class="form-group mobile:text-sm">
                        <label>Alamat Orangtua/Wali <span class="required">*</span></label>
                        <textarea name="alamat_ortu" class="form-control" rows="3" required>{{ old('alamat_ortu') }}</textarea>
                    </div>
                </div>

                <!-- Data Sekolah Asal -->
                <div class="form-section">
                    <h2 class="mobile:text-lg font-bold section-title">Data Sekolah Asal</h2>

                    <div class="form-group mobile:text-sm">
                        <label>Sekolah Asal <span class="required">*</span></label>
                        <input type="text" name="sekolah_asal" class="form-control"
                            value="{{ old('sekolah_asal') }}" required>
                    </div>

                    <div class="form-group mobile:text-sm">
                        <label>Alamat Sekolah Asal <span class="required">*</span></label>
                        <textarea name="alamat_sekolah_asal" class="form-control" rows="2" required>{{ old('alamat_sekolah_asal') }}</textarea>
                    </div>

                    <div class="form-row mobile:text-sm">
                        <div class="form-group mobile:text-sm">
                            <label>NISN <span class="required">*</span></label>
                            <input type="text" name="nisn" class="form-control" value="{{ old('nisn') }}"
                                required>
                            <small class="file-info">Nomor Induk Siswa Nasional</small>
                        </div>
                        <div class="form-group mobile:text-sm">
                            <label>Tahun Lulus <span class="required">*</span></label>
                            <input type="number" name="tahun_lulus" class="form-control" min="2000"
                                max="{{ date('Y') + 1 }}" value="{{ old('tahun_lulus', date('Y')) }}" required>
                        </div>
                    </div>

                    <div class="form-group mobile:text-sm">
                        <label>Rata-Rata Nilai (1-100) <span class="required">*</span></label>
                        <input type="number" name="rata_rata_nilai" class="form-control" min="1" max="100"
                            step="0.01" value="{{ old('rata_rata_nilai') }}" required>
                    </div>

                    <div class="form-group mobile:text-sm">
                        <label>Jurusan Yang Diminati <span class="required">*</span></label>
                        <select name="jurusan_id" class="form-control" required>
                            <option value="">Pilih Jurusan</option>
                            @foreach ($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}"
                                    {{ old('jurusan_id') == $jurusan->id ? 'selected' : '' }}>
                                    {{ $jurusan->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Upload Dokumen -->
                <div class="form-section">
                    <h2 class="mobile:text-lg font-bold section-title">Upload Dokumen</h2>
                    <p style="color: #6b7280; margin-bottom: 1.5rem;">
                        <strong>Catatan:</strong> Ukuran maksimal file 5MB. Format yang diterima: PDF, JPG, JPEG, PNG
                    </p>

                    <div class="form-group mobile:text-sm">
                        <label>Ijazah/Surat Keterangan Lulus SMP/MTs <span class="required">*</span></label>
                        <input type="file" name="ijazah" class="form-control" accept=".pdf,.jpg,.jpeg,.png"
                            required>
                    </div>

                    <div class="form-group mobile:text-sm">
                        <label>Akta Kelahiran Siswa <span class="required">*</span></label>
                        <input type="file" name="akta_kelahiran" class="form-control" accept=".pdf,.jpg,.jpeg,.png"
                            required>
                    </div>

                    <div class="form-group mobile:text-sm">
                        <label>Kartu Keluarga <span class="required">*</span></label>
                        <input type="file" name="kartu_keluarga" class="form-control" accept=".pdf,.jpg,.jpeg,.png"
                            required>
                    </div>

                    <div class="form-group mobile:text-sm">
                        <label>Pas Foto Terbaru <span class="required">*</span></label>
                        <input type="file" name="pas_foto" class="form-control" accept=".jpg,.jpeg,.png" required>
                    </div>

                    <div class="form-group mobile:text-sm">
                        <label>KIP (Kartu Indonesia Pintar) - Jika Ada</label>
                        <input type="file" name="kip" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                    </div>

                    <div class="form-group mobile:text-sm">
                        <label>KTP Orangtua/Wali <span class="required">*</span></label>
                        <input type="file" name="ktp_ortu" class="form-control" accept=".pdf,.jpg,.jpeg,.png"
                            required>
                    </div>
                </div>

                <!-- Data Tambahan -->
                <div class="form-section">
                    <h2 class="mobile:text-lg font-bold section-title">Data Tambahan</h2>

                    <div class="form-group mobile:text-sm">
                        <label>Prestasi/Pengalaman Ekstrakurikuler (Jika Ada)</label>
                        <textarea name="prestasi_ekstrakurikuler" class="form-control" rows="4"
                            placeholder="Tuliskan prestasi atau pengalaman ekstrakurikuler yang pernah diikuti">{{ old('prestasi_ekstrakurikuler') }}</textarea>
                    </div>

                    <div class="form-group mobile:text-sm">
                        <label>Alasan Memilih SMK Tamansiswa Purwokerto <span class="required">*</span></label>
                        <textarea name="alasan_memilih" class="form-control" rows="4" required>{{ old('alasan_memilih') }}</textarea>
                    </div>
                </div>

                <div
                    style="margin-top: 2rem; padding: 1.5rem; background: #f9fafb; border-radius: 8px; text-align: center;">
                    <p class="mobile:text-xs" style="margin-bottom: 1rem; color: #374151;">
                        <strong>Biaya Pendaftaran: Rp 50.000</strong><br>
                        <small>Anda akan diarahkan ke halaman pembayaran setelah mengisi form</small>
                    </p>
                    <button type="submit" class="mobile:text-sm btn-primary">Daftar Sekarang</button>
                </div>
            </form>
        </div>
    </div>
@endsection
