<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Jurusan;
use App\Models\PpdbBrosur;
use App\Models\PpdbJalur;
use App\Models\PpdbLink;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PendaftaranController extends Controller
{
    /**
     * Tampilkan form pendaftaran
     */
    public function create()
    {
        $jurusans = Jurusan::all();
        return view('pendaftaran.create', compact('jurusans'));
    }

    /**
     * Proses pendaftaran baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'nama_lengkap' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'no_hp_siswa' => 'required|string|max:20',
            'nama_ayah' => 'required|string|max:255',
            'pekerjaan_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'pekerjaan_ibu' => 'required|string|max:255',
            'nama_wali' => 'nullable|string|max:255',
            'no_hp_ortu' => 'required|string|max:20',
            'alamat_ortu' => 'required|string',
            'sekolah_asal' => 'required|string|max:255',
            'alamat_sekolah_asal' => 'required|string',
            'nisn' => 'required|string|max:20|unique:pendaftarans,nisn',
            'tahun_lulus' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'rata_rata_nilai' => 'required|numeric|min:1|max:100',
            'jurusan_id' => 'required|exists:jurusans,id',
            'ijazah' => 'required|file|mimes:pdf,jpg,jpeg,png,webp|max:5120',
            'akta_kelahiran' => 'required|file|mimes:pdf,jpg,jpeg,png,webp|max:5120',
            'kartu_keluarga' => 'required|file|mimes:pdf,jpg,jpeg,png,webp|max:5120',
            'pas_foto' => 'required|file|mimes:jpg,jpeg,png,webp|max:5120',
            'kip' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:5120',
            'ktp_ortu' => 'required|file|mimes:pdf,jpg,jpeg,png,webp|max:5120',
            'prestasi_ekstrakurikuler' => 'nullable|string',
            'alasan_memilih' => 'required|string',
        ], [
            'nisn.unique' => 'NISN sudah terdaftar. Jika Anda sudah mendaftar sebelumnya, silakan cek status pendaftaran.',
            '*.required' => 'Field ini wajib diisi.',
            '*.mimes' => 'File harus berformat PDF, JPG, JPEG, atau PNG.',
            '*.max' => 'Ukuran file maksimal 5MB.',
        ]);

        try {
            DB::beginTransaction();

            // Upload files
            $ijazahPath = $request->file('ijazah')->store('pendaftaran/ijazah', 'public');
            $aktaPath = $request->file('akta_kelahiran')->store('pendaftaran/akta', 'public');
            $kkPath = $request->file('kartu_keluarga')->store('pendaftaran/kk', 'public');
            $fotoPath = $request->file('pas_foto')->store('pendaftaran/foto', 'public');
            $ktpPath = $request->file('ktp_ortu')->store('pendaftaran/ktp', 'public');
            $kipPath = $request->hasFile('kip') ? $request->file('kip')->store('pendaftaran/kip', 'public') : null;

            // Create pendaftaran
            $pendaftaran = Pendaftaran::create([
                'email' => $validated['email'],
                'nama_lengkap' => $validated['nama_lengkap'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'tempat_lahir' => $validated['tempat_lahir'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'alamat' => $validated['alamat'],
                'no_hp_siswa' => $validated['no_hp_siswa'],
                'nama_ayah' => $validated['nama_ayah'],
                'pekerjaan_ayah' => $validated['pekerjaan_ayah'],
                'nama_ibu' => $validated['nama_ibu'],
                'pekerjaan_ibu' => $validated['pekerjaan_ibu'],
                'nama_wali' => $validated['nama_wali'],
                'no_hp_ortu' => $validated['no_hp_ortu'],
                'alamat_ortu' => $validated['alamat_ortu'],
                'sekolah_asal' => $validated['sekolah_asal'],
                'alamat_sekolah_asal' => $validated['alamat_sekolah_asal'],
                'nisn' => $validated['nisn'],
                'tahun_lulus' => $validated['tahun_lulus'],
                'rata_rata_nilai' => $validated['rata_rata_nilai'],
                'jurusan_id' => $validated['jurusan_id'],
                'ijazah_path' => $ijazahPath,
                'akta_kelahiran_path' => $aktaPath,
                'kartu_keluarga_path' => $kkPath,
                'pas_foto_path' => $fotoPath,
                'kip_path' => $kipPath,
                'ktp_ortu_path' => $ktpPath,
                'prestasi_ekstrakurikuler' => $validated['prestasi_ekstrakurikuler'],
                'alasan_memilih' => $validated['alasan_memilih'],
                'biaya_pendaftaran' => 50000,
                'status_pendaftaran' => 'menunggu_pembayaran',
            ]);

            DB::commit();

            // Redirect ke halaman pembayaran
            return redirect()->route('pendaftaran.payment', $pendaftaran->kode_pendaftaran)
                ->with('success', 'Pendaftaran berhasil! Silakan lakukan pembayaran.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            // Delete uploaded files if error
            if (isset($ijazahPath)) Storage::disk('public')->delete($ijazahPath);
            if (isset($aktaPath)) Storage::disk('public')->delete($aktaPath);
            if (isset($kkPath)) Storage::disk('public')->delete($kkPath);
            if (isset($fotoPath)) Storage::disk('public')->delete($fotoPath);
            if (isset($ktpPath)) Storage::disk('public')->delete($ktpPath);
            if (isset($kipPath)) Storage::disk('public')->delete($kipPath);

            return back()->withInput()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Tampilkan halaman cek status
     */
    public function checkStatus()
    {
        return view('pendaftaran.check-status');
    }

    /**
     * Proses cek status pendaftaran
     */
    public function getStatus(Request $request)
    {
        $request->validate([
            'nisn' => 'required|string',
        ]);

        $pendaftaran = Pendaftaran::where('nisn', $request->nisn)->first();

        if (!$pendaftaran) {
            return back()->withErrors(['nisn' => 'NISN tidak ditemukan dalam sistem.']);
        }

        return view('pendaftaran.status', compact('pendaftaran'));
    }

    /**
     * Tampilkan halaman pembayaran
     */
    public function showPayment($kodePendaftaran)
    {
        $pendaftaran = Pendaftaran::where('kode_pendaftaran', $kodePendaftaran)->firstOrFail();
        
        if ($pendaftaran->isPaid()) {
            return redirect()->route('pendaftaran.status.show', $pendaftaran->nisn)
                ->with('info', 'Pembayaran sudah lunas.');
        }

        return view('pendaftaran.payment', compact('pendaftaran'));
    }

    /**
     * Proses upload bukti pembayaran
     */
    public function uploadPaymentProof(Request $request, $kodePendaftaran)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $pendaftaran = Pendaftaran::where('kode_pendaftaran', $kodePendaftaran)->firstOrFail();

        if ($request->hasFile('bukti_pembayaran')) {
            // Delete old file if exists
            if ($pendaftaran->bukti_pembayaran_path && Storage::disk('public')->exists($pendaftaran->bukti_pembayaran_path)) {
                Storage::disk('public')->delete($pendaftaran->bukti_pembayaran_path);
            }

            $path = $request->file('bukti_pembayaran')->store('pendaftaran/bukti_pembayaran', 'public');

            $pendaftaran->update([
                'bukti_pembayaran_path' => $path,
                'status_pembayaran' => 'pending', // Menunggu verifikasi admin
                // 'status_pendaftaran' => 'verifikasi_dokumen', // Optional: Change status if needed
            ]);

            return redirect()->route('payment.finish', $pendaftaran->kode_pendaftaran)
                ->with('success', 'Bukti pembayaran berhasil diupload. Silakan tunggu verifikasi admin.');
        }

        return back()->withErrors(['bukti_pembayaran' => 'Gagal mengupload file.']);
    }

    /**
     * Halaman untuk bayar nanti (input NISN + Kode Pendaftaran)
     */
    public function payLater()
    {
        return view('pendaftaran.pay-later');
    }

    /**
     * Proses bayar nanti
     */
    public function processPayLater(Request $request)
    {
        $request->validate([
            'nisn' => 'required|string',
            'kode_pendaftaran' => 'required|string',
        ]);

        $pendaftaran = Pendaftaran::where('nisn', $request->nisn)
            ->where('kode_pendaftaran', $request->kode_pendaftaran)
            ->first();

        if (!$pendaftaran) {
            return back()->withErrors(['error' => 'Data tidak ditemukan. Periksa kembali NISN dan Kode Pendaftaran.']);
        }

        if ($pendaftaran->isPaid()) {
            return redirect()->route('pendaftaran.status.show', $pendaftaran->nisn)
                ->with('info', 'Pembayaran sudah lunas.');
        }

        return redirect()->route('pendaftaran.payment', $pendaftaran->kode_pendaftaran);
    }

    /**
     * Halaman PPDB Detail untuk user (public)
     */
    public function ppdbUser()
    {
        $brosurs = PpdbBrosur::active()->ordered()->get();
        $jalurs = PpdbJalur::active()->ordered()->get();
        $links = PpdbLink::active()->ordered()->get();

        return view('utama.content.ppdb-detail', compact('brosurs', 'jalurs', 'links'));
    }


}

