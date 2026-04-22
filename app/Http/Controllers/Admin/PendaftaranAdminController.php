<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Casisbas;
use App\Models\Provinces;
use App\Models\Regency;
use App\Models\Religion;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PendaftaranAdminController extends Controller
{
    public function calonSiswa(Request $request)
    {
        $query = Casisbas::with(['provinsi', 'kabupaten', 'agama'])
            ->orderByDesc('created_at');

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('no_hp', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kelengkapan')) {
            if ($request->kelengkapan === 'lengkap') {
                $query->whereNotNull('jenis_kelamin')
                    ->whereNotNull('status_menikah')
                    ->whereNotNull('religion_id')
                    ->whereNotNull('alamat_saat_ini')
                    ->whereNotNull('kecamatan')
                    ->whereNotNull('kabupaten_id')
                    ->whereNotNull('provinsi_id')
                    ->whereNotNull('tanggal_lahir')
                    ->whereNotNull('tempat_lahir')
                    ->whereNotNull('kewarganegaraan');
            }

            if ($request->kelengkapan === 'belum_lengkap') {
                $query->where(function ($q) {
                    $q->whereNull('jenis_kelamin')
                        ->orWhereNull('status_menikah')
                        ->orWhereNull('religion_id')
                        ->orWhereNull('alamat_saat_ini')
                        ->orWhereNull('kecamatan')
                        ->orWhereNull('kabupaten_id')
                        ->orWhereNull('provinsi_id')
                        ->orWhereNull('tanggal_lahir')
                        ->orWhereNull('tempat_lahir')
                        ->orWhereNull('kewarganegaraan');
                });
            }
        }

        $calonSiswas = $query->paginate(20)->withQueryString();

        return view('admin.pendaftaran.calon-siswa', compact('calonSiswas'));
    }

    public function showCalonSiswa($id)
    {
        $casis = Casisbas::with(['provinsi', 'kabupaten', 'tempatLahirProvinsi', 'tempatLahirKabupaten', 'agama'])->findOrFail($id);
        $provinces = Provinces::orderBy('name')->get();
        $religions = Religion::orderBy('name')->get();
        $regencies = Regency::query()
            ->when($casis->provinsi_id, fn ($q) => $q->where('province_id', $casis->provinsi_id))
            ->orderBy('name')
            ->get();
        $tempatLahirRegencies = Regency::query()
            ->when($casis->tempat_lahir_provinsi_id, fn ($q) => $q->where('province_id', $casis->tempat_lahir_provinsi_id))
            ->orderBy('name')
            ->get();

        $kelengkapan = [
            'Nama Lengkap' => !empty($casis->nama_lengkap),
            'Email' => !empty($casis->email),
            'No HP' => !empty($casis->no_hp),
            'Jenis Kelamin' => !empty($casis->jenis_kelamin),
            'Status Menikah' => !empty($casis->status_menikah),
            'Agama' => !empty($casis->religion_id),
            'Alamat KTP' => !empty($casis->alamat_ktp),
            'Alamat Saat Ini' => !empty($casis->alamat_saat_ini),
            'Kecamatan' => !empty($casis->kecamatan),
            'Kabupaten' => !empty($casis->kabupaten_id),
            'Provinsi' => !empty($casis->provinsi_id),
            'Kewarganegaraan' => !empty($casis->kewarganegaraan),
            'Tanggal Lahir' => !empty($casis->tanggal_lahir),
            'Tempat Lahir Provinsi' => !empty($casis->tempat_lahir_provinsi_id),
            'Tempat Lahir Kabupaten' => !empty($casis->tempat_lahir_kabupaten_id),
        ];

        $totalField = count($kelengkapan);
        $terisiField = collect($kelengkapan)->filter()->count();
        $persentase = $totalField > 0 ? (int) round(($terisiField / $totalField) * 100) : 0;

        return view('admin.pendaftaran.show-calon-siswa', compact(
            'casis',
            'kelengkapan',
            'persentase',
            'terisiField',
            'totalField',
            'provinces',
            'regencies',
            'tempatLahirRegencies',
            'religions'
        ));
    }

    /**
     * Show edit form for calon siswa
     */
    public function editDataCalonSiswaForm($id)
    {
        $casis = Casisbas::with([
            'provinsi',
            'kabupaten',
            'tempatLahirProvinsi',
            'tempatLahirKabupaten',
            'agama'
        ])->findOrFail($id);

        $provinces = Provinces::all();
        
        // Load regencies based on provinsi_id
        $regencies = [];
        if ($casis->provinsi_id) {
            $regencies = Regency::where('province_id', $casis->provinsi_id)->get();
        }

        // Load tempat_lahir_regencies based on tempat_lahir_provinsi_id
        $tempatLahirRegencies = [];
        if ($casis->tempat_lahir_provinsi_id) {
            $tempatLahirRegencies = Regency::where('province_id', $casis->tempat_lahir_provinsi_id)->get();
        }

        $religions = Religion::all();

        return view('admin.pendaftaran.edit-calon-siswa', compact(
            'casis',
            'provinces',
            'regencies',
            'tempatLahirRegencies',
            'religions'
        ));
    }

    // Method CRUD calon siswa (sesuai permintaan: nama method ...CalonSiswa)
    public function editDataCalonSiswa(Request $request, $id)
    {
        $casis = Casisbas::findOrFail($id);

        $validated = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('casisbas', 'email')->ignore($casis->id)],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'nomor_telepon' => ['nullable', 'string', 'max:20'],
            'jenis_kelamin' => ['nullable', Rule::in(['Pria', 'Wanita'])],
            'status_menikah' => ['nullable', Rule::in(['Belum menikah', 'Menikah', 'Lain-lain'])],
            'religion_id' => ['nullable', 'exists:religions,id'],
            'alamat_ktp' => ['nullable', 'string'],
            'alamat_saat_ini' => ['nullable', 'string'],
            'kecamatan' => ['nullable', 'string', 'max:255'],
            'provinsi_id' => ['nullable', 'exists:provinces,id'],
            'kabupaten_id' => [
                'nullable',
                Rule::exists('regencies', 'id')->where(function ($query) use ($request) {
                    if ($request->filled('provinsi_id')) {
                        $query->where('province_id', $request->provinsi_id);
                    }
                }),
            ],
            'kewarganegaraan' => ['nullable', Rule::in(['WNI Asli', 'WNI Keturunan', 'WNA'])],
            'negara_wna' => ['nullable', 'string', 'max:255'],
            'tanggal_lahir' => ['nullable', 'date'],
            'tempat_lahir_provinsi_id' => ['nullable', 'exists:provinces,id'],
            'tempat_lahir_kabupaten_id' => [
                'nullable',
                Rule::exists('regencies', 'id')->where(function ($query) use ($request) {
                    if ($request->filled('tempat_lahir_provinsi_id')) {
                        $query->where('province_id', $request->tempat_lahir_provinsi_id);
                    }
                }),
            ],
            'tempat_lahir_negara' => ['nullable', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ]);

        if (($validated['kewarganegaraan'] ?? null) !== 'WNA') {
            $validated['negara_wna'] = null;
        }

        if (!$request->filled('provinsi_id')) {
            $validated['kabupaten_id'] = null;
        }

        if (!$request->filled('tempat_lahir_provinsi_id')) {
            $validated['tempat_lahir_kabupaten_id'] = null;
        }

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $casis->update($validated);

        return redirect()
            ->route('admin.pendaftaran.calon-siswa.show', $casis->id)
            ->with('success', 'Data calon siswa berhasil diperbarui.');
    }

    public function hapusDataCalonSiswa($id)
    {
        $casis = Casisbas::findOrFail($id);
        $casis->delete();

        return redirect()
            ->route('admin.pendaftaran.calon-siswa')
            ->with('success', 'Data calon siswa berhasil dihapus.');
    }
    /**
     * Tampilkan daftar pendaftaran
     */
    public function index(Request $request)
    {
        $query = Pendaftaran::with('jurusan')->orderBy('created_at', 'desc');

        // Filter berdasarkan status
        if ($request->filled('status_pembayaran')) {
            $query->where('status_pembayaran', $request->status_pembayaran);
        }

        if ($request->filled('status_pendaftaran')) {
            $query->where('status_pendaftaran', $request->status_pendaftaran);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nisn', 'like', "%{$search}%")
                  ->orWhere('kode_pendaftaran', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $pendaftarans = $query->paginate(20);

        return view('admin.pendaftaran.index', compact('pendaftarans'));
    }

    /**
     * Tampilkan detail pendaftaran
     */
    public function show($id)
    {
        $pendaftaran = Pendaftaran::with('jurusan')->findOrFail($id);
        return view('admin.pendaftaran.show', compact('pendaftaran'));
    }

    /**
     * Update status pendaftaran
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_pendaftaran' => 'required|in:draft,menunggu_pembayaran,verifikasi_dokumen,diterima,ditolak',
            'status_pembayaran' => 'required|in:pending,paid,failed,expired',
            'catatan_admin' => 'nullable|string',
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);
        
        $updateData = [
            'status_pendaftaran' => $request->status_pendaftaran,
            'status_pembayaran' => $request->status_pembayaran,
            'catatan_admin' => $request->catatan_admin,
        ];

        // If status changed to paid, set paid_at if not set
        if ($request->status_pembayaran == 'paid' && !$pendaftaran->paid_at) {
            $updateData['paid_at'] = now();
        } 
        // If status changed from paid to something else, clear paid_at (optional, depends on logic)
        // Let's keep paid_at as history even if status changes back for now, or clear it? 
        // Usually if failed/expired we might want to keep history or clear. 
        // For simplicity let's only set it when paid.

        $pendaftaran->update($updateData);

        return back()->with('success', 'Status pendaftaran berhasil diupdate.');
    }

    /**
     * Download dokumen
     */
    public function downloadDocument($id, $type)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        $filePath = match($type) {
            'ijazah' => $pendaftaran->ijazah_path,
            'akta' => $pendaftaran->akta_kelahiran_path,
            'kk' => $pendaftaran->kartu_keluarga_path,
            'foto' => $pendaftaran->pas_foto_path,
            'kip' => $pendaftaran->kip_path,
            'ktp' => $pendaftaran->ktp_ortu_path,
            'bukti_pembayaran' => $pendaftaran->bukti_pembayaran_path,
            default => null,
        };

        if (!$filePath || !Storage::disk('public')->exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->download(Storage::disk('public')->path($filePath));
    }

    /**
     * Delete pendaftaran
     */
    public function destroy($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        // Delete files
        $files = [
            $pendaftaran->ijazah_path,
            $pendaftaran->akta_kelahiran_path,
            $pendaftaran->kartu_keluarga_path,
            $pendaftaran->pas_foto_path,
            $pendaftaran->ktp_ortu_path,
        ];

        if ($pendaftaran->kip_path) {
            $files[] = $pendaftaran->kip_path;
        }

        if ($pendaftaran->bukti_pembayaran_path) {
            $files[] = $pendaftaran->bukti_pembayaran_path;
        }

        foreach ($files as $file) {
            if (Storage::disk('public')->exists($file)) {
                Storage::disk('public')->delete($file);
            }
        }

        $pendaftaran->delete();

        return redirect()->route('admin.pendaftaran.index')
            ->with('success', 'Pendaftaran berhasil dihapus.');
    }

    /**
     * Export data pendaftaran
     */
    public function export(Request $request)
    {
        $query = Pendaftaran::with('jurusan')->orderBy('created_at', 'desc');

        if ($request->filled('status_pembayaran')) {
            $query->where('status_pembayaran', $request->status_pembayaran);
        }

        if ($request->filled('status_pendaftaran')) {
            $query->where('status_pendaftaran', $request->status_pendaftaran);
        }

        $pendaftarans = $query->get();

        // Generate CSV
        $filename = 'pendaftaran_' . date('Y-m-d_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($pendaftarans) {
            $file = fopen('php://output', 'w');
            
            // Header
            fputcsv($file, [
                'Kode Pendaftaran', 'NISN', 'Nama Lengkap', 'Email', 'No HP',
                'Tempat Lahir', 'Tanggal Lahir', 'Jenis Kelamin', 'Alamat',
                'Nama Ayah', 'Pekerjaan Ayah', 'Nama Ibu', 'Pekerjaan Ibu',
                'Nama Wali', 'No HP Ortu', 'Alamat Ortu',
                'Sekolah Asal', 'Alamat Sekolah', 'Tahun Lulus', 'Rata-rata Nilai',
                'Jurusan', 'Prestasi', 'Alasan Memilih',
                'Status Pembayaran', 'Status Pendaftaran', 'Tanggal Daftar'
            ]);

            // Data
            foreach ($pendaftarans as $p) {
                fputcsv($file, [
                    $p->kode_pendaftaran,
                    $p->nisn,
                    $p->nama_lengkap,
                    $p->email,
                    $p->no_hp_siswa,
                    $p->tempat_lahir,
                    $p->tanggal_lahir->format('d-m-Y'),
                    $p->jenis_kelamin,
                    $p->alamat,
                    $p->nama_ayah,
                    $p->pekerjaan_ayah,
                    $p->nama_ibu,
                    $p->pekerjaan_ibu,
                    $p->nama_wali,
                    $p->no_hp_ortu,
                    $p->alamat_ortu,
                    $p->sekolah_asal,
                    $p->alamat_sekolah_asal,
                    $p->tahun_lulus,
                    $p->rata_rata_nilai,
                    $p->jurusan->name ?? '-',
                    $p->prestasi_ekstrakurikuler ?? '-',
                    $p->alasan_memilih,
                    $p->status_pembayaran,
                    $p->status_pendaftaran,
                    $p->created_at->format('d-m-Y H:i'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function getRegenciesByProvince($provinceId)
    {
        $regencies = Regency::where('province_id', $provinceId)
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json($regencies);
    }

    /**
     * Show status form untuk calon siswa
     */
    public function statusCalonSiswaForm($id)
    {
        $casis = Casisbas::findOrFail($id);
        return view('admin.pendaftaran.status-calon-siswa', compact('casis'));
    }

    /**
     * Update status penerimaan calon siswa
     */
    public function updateStatusCalonSiswa(Request $request, $id)
    {
        $request->validate([
            'status_penerimaan' => 'required|in:menunggu,diterima,ditolak',
            'catatan_penerimaan' => 'nullable|string|max:1000',
        ]);

        $casis = Casisbas::findOrFail($id);
        
        $casis->update([
            'status_penerimaan' => $request->status_penerimaan,
            'catatan_penerimaan' => $request->catatan_penerimaan,
        ]);

        return redirect()
            ->route('admin.pendaftaran.calon-siswa.show', $casis->id)
            ->with('success', 'Status penerimaan calon siswa berhasil diperbarui.');
    }
}
