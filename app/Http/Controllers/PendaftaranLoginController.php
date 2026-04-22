<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Casisbas;
use App\Models\Provinces;
use App\Models\Regency;
use App\Models\Religion;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;

class PendaftaranLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showLoginForm()
    {
        return view('pmb.auth.login');
    }

    public function showRegisterForm()
    {
        return view('pmb.auth.regist');
    }

    public function index()
    {
        $casisId = Session::get('casisbas_id');
        $casis = null;

        if ($casisId) {
            $casis = Casisbas::with([
                'provinsi',
                'kabupaten',
                'tempatLahirProvinsi',
                'tempatLahirKabupaten',
                'agama'
            ])->find($casisId);
        }

        return view('pmb.dashboard.index', compact('casis'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:casisbas,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $casis = Casisbas::create([
            'nama_lengkap' => $request->username,
            'email' => $request->email,
            'no_hp' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // Login otomatis setelah register
        Session::put('casisbas_id', $casis->id);
        return redirect()->route('pmb.dashboard');
    }


    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|email',
            'password' => 'required|string',
        ]);

        $casis = Casisbas::where('email', $request->username)->first();
        if ($casis && Hash::check($request->password, $casis->password)) {
            Session::put('casisbas_id', $casis->id);
            return redirect()->route('pmb.dashboard');
        }
        return back()->withErrors(['username' => 'Email atau password salah']);
    }

    // Logout calon siswa baru
    public function logout(Request $request)
    {
        Session::forget('casisbas_id');
        return redirect()->route('pendaftaran.siswa.login');
    }

    // Halaman data diri lengkap
    public function dataDiri()
    {
        $casis = Casisbas::with(['provinsi', 'kabupaten', 'tempatLahirProvinsi', 'tempatLahirKabupaten', 'agama'])->findOrFail(Session::get('casisbas_id'));

        $provinces = Provinces::orderBy('name')->get();
        $religions = Religion::orderBy('name')->get();
        $regencies = collect();
        $tempatLahirRegencies = collect();

        // Load regencies untuk alamat
        if ($casis->provinsi_id) {
            $regencies = Regency::where('province_id', $casis->provinsi_id)
                ->orderBy('name')
                ->get();
        }

        // Load regencies untuk tempat lahir
        if ($casis->tempat_lahir_provinsi_id) {
            $tempatLahirRegencies = Regency::where('province_id', $casis->tempat_lahir_provinsi_id)
                ->orderBy('name')
                ->get();
        }

        return view('pmb.dashboard.data-diri', compact('casis', 'provinces', 'regencies', 'tempatLahirRegencies', 'religions'));
    }

    public function editDataDiri()
    {
        $casis = Casisbas::with(['provinsi', 'kabupaten', 'tempatLahirProvinsi', 'tempatLahirKabupaten', 'agama'])->findOrFail(Session::get('casisbas_id'));

        $provinces = Provinces::orderBy('name')->get();
        $religions = Religion::orderBy('name')->get();
        $regencies = collect();
        $tempatLahirRegencies = collect();

        // Load regencies untuk alamat
        if ($casis->provinsi_id) {
            $regencies = Regency::where('province_id', $casis->provinsi_id)
                ->orderBy('name')
                ->get();
        }

        // Load regencies untuk tempat lahir
        if ($casis->tempat_lahir_provinsi_id) {
            $tempatLahirRegencies = Regency::where('province_id', $casis->tempat_lahir_provinsi_id)
                ->orderBy('name')
                ->get();
        }

        return view('pmb.dashboard.edit-data-diri', compact('casis', 'provinces', 'regencies', 'tempatLahirRegencies', 'religions'));
    }

    public function updateDataDiri(Request $request)
    {
        try {
            $casis = Casisbas::findOrFail(Session::get('casisbas_id'));

            $validated = $request->validate([
                'alamat_ktp' => ['required', 'string', 'max:255'],
                'alamat_saat_ini' => ['required', 'string', 'max:255'],
                'kecamatan' => ['required', 'string', 'max:100'],
                'provinsi_id' => ['required', 'exists:provinces,id'],
                'kabupaten_id' => [
                    'required',
                    'exists:regencies,id',
                    Rule::exists('regencies', 'id')->where(function ($query) use ($request) {
                        $query->where('province_id', $request->provinsi_id);
                    }),
                ],
                'nomor_telepon' => ['nullable', 'regex:/^[0-9]+$/', 'max:20'],
                'no_hp' => ['required', 'regex:/^[0-9]+$/', 'max:20'],
                'kewarganegaraan' => ['required', Rule::in(['WNI Asli', 'WNI Keturunan', 'WNA'])],
                'negara_wna' => ['nullable', 'string', 'max:100', 'required_if:kewarganegaraan,WNA'],
                'tanggal_lahir' => ['required', 'date'],
                'tempat_lahir_provinsi_id' => ['nullable', 'exists:provinces,id'],
                'tempat_lahir_kabupaten_id' => ['nullable', 'exists:regencies,id'],
                'tempat_lahir_negara' => ['nullable', 'string', 'max:150'],
                'jenis_kelamin' => ['required', Rule::in(['Pria', 'Wanita'])],
                'status_menikah' => ['required', Rule::in(['Belum menikah', 'Menikah', 'Lain-lain'])],
                'religion_id' => ['required', 'exists:religions,id'],
            ], [
                'kabupaten_id.exists' => 'Kabupaten tidak sesuai dengan provinsi yang dipilih.',
                'no_hp.regex' => 'Nomor HP harus berupa angka.',
                'nomor_telepon.regex' => 'Nomor telepon harus berupa angka.',
                'negara_wna.required_if' => 'Negara wajib diisi jika kewarganegaraan WNA.',
                'tempat_lahir_kabupaten_id.exists' => 'Kabupaten tempat lahir tidak sesuai dengan provinsi yang dipilih.',
            ]);

            if (($validated['kewarganegaraan'] ?? null) !== 'WNA') {
                $validated['negara_wna'] = null;
            }

            // Custom validation untuk tempat lahir
            $hasTempLahirProvinsi = !empty($validated['tempat_lahir_provinsi_id']);
            $hasTempLahirNegara = !empty($validated['tempat_lahir_negara']);

            // Validasi: harus ada provinsi+kabupaten ATAU negara
            if (!$hasTempLahirProvinsi && !$hasTempLahirNegara) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'tempat_lahir_provinsi_id' => 'Provinsi tempat lahir atau negara harus diisi.',
                    'tempat_lahir_negara' => 'Negara tempat lahir atau provinsi harus diisi.',
                ]);
            }

            // Validasi: jika ada provinsi, harus ada kabupaten
            if ($hasTempLahirProvinsi && empty($validated['tempat_lahir_kabupaten_id'])) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'tempat_lahir_kabupaten_id' => 'Kabupaten harus diisi jika provinsi diisi.',
                ]);
            }

            // Validasi: jika ada kabupaten, harus ada provinsi
            if (!empty($validated['tempat_lahir_kabupaten_id']) && !$hasTempLahirProvinsi) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'tempat_lahir_provinsi_id' => 'Provinsi harus diisi jika kabupaten diisi.',
                ]);
            }

            // Validasi: jika ada negara, tidak boleh ada provinsi/kabupaten
            if ($hasTempLahirNegara && $hasTempLahirProvinsi) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'tempat_lahir_provinsi_id' => 'Tidak boleh isi provinsi jika memilih lahir di luar negeri.',
                ]);
            }

            // Clear tempat_lahir fields sesuai pilihan user
            if (!$hasTempLahirProvinsi) {
                $validated['tempat_lahir_kabupaten_id'] = null;
            } else {
                $validated['tempat_lahir_negara'] = null;
            }

            $casis->update($validated);

            return redirect()->route('pmb.dashboard.data-diri')
                ->with('success', 'Data diri berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function getRegenciesByProvince(Provinces $province)
    {
        $regencies = Regency::where('province_id', $province->id)
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json($regencies);
    }


    public function statusPendaftaran()
    {
        $casisId = Session::get('casisbas_id');
        $casis = null;

        if ($casisId) {
            $casis = Casisbas::with([
                'provinsi',
                'kabupaten',
                'tempatLahirProvinsi',
                'tempatLahirKabupaten',
                'agama'
            ])->find($casisId);
        }

        return view('pmb.dashboard.status-pendaftaran', compact('casis'));
    }

    public function cetakBukti()
    {
        $casisId = Session::get('casisbas_id');

        if (!$casisId) {
            return redirect()->route('pendaftaran.siswa.login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $casis = Casisbas::with([
            'provinsi',
            'kabupaten',
            'agama'
        ])->findOrFail($casisId);

        $pdf = Pdf::loadView('pmb.dashboard.cetak-bukti', compact('casis'));

        return $pdf->stream('bukti-pendaftaran.pdf');
    }
}
