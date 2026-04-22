<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PrestasiController extends Controller
{
    // Admin CRUD
    public function index()
    {
        $prestasis = Prestasi::with('jurusan')->orderBy('tahun', 'desc')->orderBy('judul')->get();
        return view('admin.prestasis.index', compact('prestasis'));
    }

    public function create()
    {
        $jurusans = Jurusan::orderBy('name')->get();
        $tingkatOptions = ['sekolah', 'kota', 'provinsi', 'nasional', 'internasional'];
        return view('admin.prestasis.create', compact('jurusans', 'tingkatOptions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tingkat' => 'required|in:sekolah,kota,provinsi,nasional,internasional',
            'peringkat' => 'nullable|string|max:100',
            'penyelenggara' => 'nullable|string|max:255',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'jurusan_id' => 'nullable|exists:jurusans,id',
            'nama_siswa' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
        ]);

        $data = $request->only([
            'judul', 'deskripsi', 'tingkat', 'peringkat', 
            'penyelenggara', 'tahun', 'jurusan_id', 'nama_siswa', 'is_featured'
        ]);

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = Str::slug($request->input('judul', 'prestasi')) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $destination = public_path('images/prestasi');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $data['thumbnail'] = 'images/prestasi/' . $filename;
        }

        Prestasi::create($data);
        return redirect()->route('admin.prestasis.index')->with('success', 'Prestasi berhasil ditambahkan');
    }

    public function edit(Prestasi $prestasi)
    {
        $jurusans = Jurusan::orderBy('name')->get();
        $tingkatOptions = ['sekolah', 'kota', 'provinsi', 'nasional', 'internasional'];
        return view('admin.prestasis.edit', compact('prestasi', 'jurusans', 'tingkatOptions'));
    }

    public function update(Request $request, Prestasi $prestasi)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tingkat' => 'required|in:sekolah,kota,provinsi,nasional,internasional',
            'peringkat' => 'nullable|string|max:100',
            'penyelenggara' => 'nullable|string|max:255',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'jurusan_id' => 'nullable|exists:jurusans,id',
            'nama_siswa' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
        ]);

        $data = $request->only([
            'judul', 'deskripsi', 'tingkat', 'peringkat',
            'penyelenggara', 'tahun', 'jurusan_id', 'nama_siswa', 'is_featured'
        ]);

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($prestasi->thumbnail && file_exists(public_path($prestasi->thumbnail))) {
                unlink(public_path($prestasi->thumbnail));
            }

            $file = $request->file('thumbnail');
            $filename = Str::slug($request->input('judul', 'prestasi')) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $destination = public_path('images/prestasi');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $data['thumbnail'] = 'images/prestasi/' . $filename;
        }

        // Regenerate slug if judul changed
        if ($request->input('judul') !== $prestasi->judul) {
            $data['slug'] = Str::slug($request->input('judul'));
        }

        $prestasi->update($data);
        return redirect()->route('admin.prestasis.index')->with('success', 'Prestasi berhasil diupdate');
    }

    public function destroy(Prestasi $prestasi)
    {
        // Delete thumbnail if exists
        if ($prestasi->thumbnail && file_exists(public_path($prestasi->thumbnail))) {
            unlink(public_path($prestasi->thumbnail));
        }

        $prestasi->delete();
        return redirect()->route('admin.prestasis.index')->with('success', 'Prestasi berhasil dihapus');
    }

    // Frontend
    public function publicIndex(Request $request)
    {
        $query = Prestasi::with('jurusan');

        // Filter by tingkat
        if ($request->filled('tingkat')) {
            $query->byTingkat($request->get('tingkat'));
        }

        // Filter by jurusan
        if ($request->filled('jurusan_id')) {
            $query->where('jurusan_id', $request->get('jurusan_id'));
        }

        // Filter by tahun
        if ($request->filled('tahun')) {
            $query->where('tahun', $request->get('tahun'));
        }

        // Order: featured first, then by year desc
        $prestasis = $query->orderBy('is_featured', 'desc')
                           ->orderBy('tahun', 'desc')
                           ->orderBy('judul')
                           ->paginate(12);

        // Get filter options
        $jurusans = Jurusan::orderBy('name')->get();
        $tingkatOptions = ['sekolah', 'kota', 'provinsi', 'nasional', 'internasional'];
        $tahunOptions = Prestasi::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');

        return view('utama.content.prestasi', compact('prestasis', 'jurusans', 'tingkatOptions', 'tahunOptions'));
    }
}
