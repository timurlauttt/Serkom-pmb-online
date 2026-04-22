@extends('layouts.admin')

@section('title', 'Ubah Status Penerimaan')
@section('page-title', 'Ubah Status Penerimaan')
@section('page-description', 'Tentukan status penerimaan calon siswa ke SMK Taman Siswa')

@section('content')
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.pendaftaran.calon-siswa.show', $casis->id) }}"
                class="inline-flex items-center px-4 py-2 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 text-sm font-medium">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Detail
            </a>
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6">
            <div class="mb-6">
                <div class="flex items-center gap-4 pb-4 border-b border-gray-200">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center text-black text-2xl font-bold">
                        {{ strtoupper(substr($casis->nama_lengkap, 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $casis->nama_lengkap }}</h3>
                        <p class="text-sm text-gray-500">{{ $casis->email }}</p>
                        <p class="text-sm text-gray-600 mt-1">
                            <i class="fas fa-phone mr-1 text-blue-600"></i>{{ $casis->no_hp ?? '-' }}
                        </p>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.pendaftaran.calon-siswa.status.update', $casis->id) }}"
                class="space-y-6">
                @csrf
                @method('PUT')

                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <h4 class="text-sm font-semibold text-red-800 mb-2">Terdapat kesalahan:</h4>
                        <ul class="text-sm text-red-700 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Status Penerimaan -->
                <div class="space-y-4">
                    <h4 class="text-base font-semibold text-gray-800">Status Penerimaan</h4>
                    <p class="text-sm text-gray-600">Pilih status penerimaan calon siswa ini ke SMK Taman Siswa</p>

                    <div class="space-y-3">
                        <label class="flex items-start gap-3 p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition
                            @if ($casis->status_penerimaan === 'menunggu') border-yellow-400 bg-yellow-50 @endif"
                            onclick="document.getElementById('status_menunggu').checked = true">
                            <input type="radio" id="status_menunggu" name="status_penerimaan" value="menunggu"
                                @checked($casis->status_penerimaan === 'menunggu' || $casis->status_penerimaan === null)
                                class="w-5 h-5 text-yellow-500 mt-1">
                            <div class="flex-1">
                                <h5 class="font-semibold text-gray-800">Menunggu Verifikasi</h5>
                                <p class="text-sm text-gray-600 mt-1">Status sedang dalam proses verifikasi data dan dokumen calon siswa</p>
                            </div>
                            <div class="text-2xl mt-1">⏳</div>
                        </label>

                        <label class="flex items-start gap-3 p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition
                            @if ($casis->status_penerimaan === 'diterima') border-green-400 bg-green-50 @endif"
                            onclick="document.getElementById('status_diterima').checked = true">
                            <input type="radio" id="status_diterima" name="status_penerimaan" value="diterima"
                                @checked($casis->status_penerimaan === 'diterima')
                                class="w-5 h-5 text-green-500 mt-1">
                            <div class="flex-1">
                                <h5 class="font-semibold text-gray-800">Diterima</h5>
                                <p class="text-sm text-gray-600 mt-1">Calon siswa telah lolos seleksi dan diterima di SMK Taman Siswa</p>
                            </div>
                            <div class="text-2xl mt-1">✅</div>
                        </label>

                        <label class="flex items-start gap-3 p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition
                            @if ($casis->status_penerimaan === 'ditolak') border-red-400 bg-red-50 @endif"
                            onclick="document.getElementById('status_ditolak').checked = true">
                            <input type="radio" id="status_ditolak" name="status_penerimaan" value="ditolak"
                                @checked($casis->status_penerimaan === 'ditolak')
                                class="w-5 h-5 text-red-500 mt-1">
                            <div class="flex-1">
                                <h5 class="font-semibold text-gray-800">Ditolak</h5>
                                <p class="text-sm text-gray-600 mt-1">Calon siswa tidak memenuhi kriteria seleksi dan tidak diterima</p>
                            </div>
                            <div class="text-2xl mt-1">❌</div>
                        </label>
                    </div>
                </div>

                <!-- Catatan Penerimaan -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Catatan Penerimaan</label>
                    <p class="text-sm text-gray-600">Tambahkan catatan untuk calon siswa tentang keputusan penerimaan (opsional)</p>
                    <textarea name="catatan_penerimaan" rows="5"
                        placeholder="Contoh: Nilai rata-rata cukup baik, namun perlu perhatian khusus pada mata pelajaran Matematika..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('catatan_penerimaan') border-red-500 @enderror">{{ old('catatan_penerimaan', $casis->catatan_penerimaan) }}</textarea>
                    @error('catatan_penerimaan')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Info Box -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 space-y-2">
                    <h5 class="font-semibold text-blue-900 flex items-center gap-2">
                        <i class="fas fa-info-circle text-blue-600"></i>Informasi Penting
                    </h5>
                    <ul class="text-sm text-blue-800 space-y-1 ml-6 list-disc">
                        <li>Perubahan status akan langsung tersimpan di sistem</li>
                        <li>Calon siswa akan menerima notifikasi perubahan status melalui email</li>
                        <li>Catatan hanya untuk referensi admin dan tidak akan ditampilkan kepada calon siswa</li>
                    </ul>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex gap-3 pt-4">
                    <button type="submit"
                        class="inline-flex items-center px-6 py-2.5 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">
                        <i class="fas fa-save mr-2"></i>Simpan Status
                    </button>
                    <a href="{{ route('admin.pendaftaran.calon-siswa.show', $casis->id) }}"
                        class="inline-flex items-center px-6 py-2.5 rounded-lg bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300 transition">
                        <i class="fas fa-times mr-2"></i>Batal
                    </a>
                </div>
            </form>
        </div>

        <!-- Info Data Calon Siswa -->
        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6">
            <h4 class="text-base font-semibold text-gray-800 mb-4">Info Ringkas Calon Siswa</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 text-sm">
                <div>
                    <p class="text-gray-500">Email</p>
                    <p class="font-medium text-gray-800">{{ $casis->email }}</p>
                </div>
                <div>
                    <p class="text-gray-500">No HP</p>
                    <p class="font-medium text-gray-800">{{ $casis->no_hp ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Tanggal Lahir</p>
                    <p class="font-medium text-gray-800">{{ $casis->tanggal_lahir ? \Carbon\Carbon::parse($casis->tanggal_lahir)->format('d M Y') : '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Jenis Kelamin</p>
                    <p class="font-medium text-gray-800">{{ $casis->jenis_kelamin ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Agama</p>
                    <p class="font-medium text-gray-800">{{ $casis->agama?->name ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Kewarganegaraan</p>
                    <p class="font-medium text-gray-800">{{ $casis->kewarganegaraan ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Provinsi</p>
                    <p class="font-medium text-gray-800">{{ $casis->provinsi?->name ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Kabupaten</p>
                    <p class="font-medium text-gray-800">{{ $casis->kabupaten?->name ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Tanggal Daftar</p>
                    <p class="font-medium text-gray-800">{{ $casis->created_at->format('d M Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Prevent form double submission
            const form = document.querySelector('form');
            form?.addEventListener('submit', function() {
                const submitBtn = form.querySelector('button[type="submit"]');
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
            });
        </script>
    @endpush
@endsection
