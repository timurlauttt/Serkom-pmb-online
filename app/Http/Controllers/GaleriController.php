<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::orderBy('order')->get();
        return view('galeris.index', compact('galeris'));
    }
    
    // Redirect for resource create (we use modal in index view)
    public function create()
    {
        return redirect()->route('admin.galeris.index');
    }

    // Redirect for resource edit (we use modal in index view)
    public function edit($id)
    {
        return redirect()->route('admin.galeris.index');
    }
    
    // Store a single uploaded image (create via modal)
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:191',
            'album' => 'required|string|in:Kegiatan Sekolah,Ekstrakurikuler,Fasilitas,Prestasi,Guru & Staff,Kelas,Kegiatan Akademik,Event Besar,Alumni',
            'jurusan_id' => 'nullable|exists:jurusans,id',
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'is_favorite' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        $destination = public_path('images/galeri');
        if (!File::exists($destination)) {
            File::makeDirectory($destination, 0755, true);
        }

        $uploadedCount = 0;
        $files = $request->file('images');
        $baseTitle = $request->input('title');
        $album = $request->input('album');
        $jurusan_id = $request->input('jurusan_id');
        foreach ($files as $index => $file) {
            $filename = Str::random(8) . '-' . time() . '-' . $index . '.' . $file->getClientOriginalExtension();
            $file->move($destination, $filename);

            // If multiple files, append number to title
            $title = count($files) > 1 ? $baseTitle . ' ' . ($index + 1) : $baseTitle;

            Galeri::create([
                'title' => $title,
                'album' => $album,
                'jurusan_id' => $jurusan_id,
                'path' => 'images/galeri/' . $filename,
                'is_favorite' => $request->boolean('is_favorite', false),
                'order' => $request->input('order', 0) + $index,
            ]);
            $uploadedCount++;
        }

        $message = $uploadedCount > 1 
            ? "{$uploadedCount} foto berhasil ditambahkan" 
            : "1 foto berhasil ditambahkan";

        return redirect()->route('admin.galeris.index')->with('success', $message);
    }

    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:191',
            'album' => 'required|string|in:Kegiatan Sekolah,Ekstrakurikuler,Fasilitas,Prestasi,Guru & Staff,Kelas,Kegiatan Akademik,Event Besar,Alumni',
            'jurusan_id' => 'nullable|exists:jurusans,id',
            'path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'is_favorite' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        $data = $request->only(['title','album','jurusan_id','is_favorite','order']);

        if ($request->hasFile('path')) {
            $file = $request->file('path');
            $filename = Str::random(8) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $destination = public_path('images/galeri');
            if (!File::exists($destination)) {
                File::makeDirectory($destination, 0755, true);
            }
            $file->move($destination, $filename);

            // delete old file if exists
            if ($galeri->path && File::exists(public_path($galeri->path))) {
                try { File::delete(public_path($galeri->path)); } catch (\Exception $e) { /* ignore */ }
            }

            $data['path'] = 'images/galeri/' . $filename;
        }

        $galeri->update($data);
        return redirect()->route('admin.galeris.index')->with('success', 'Galeri berhasil diperbarui');
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);
        // delete file if exists
        if ($galeri->path && File::exists(public_path($galeri->path))) {
            try { File::delete(public_path($galeri->path)); } catch (\Exception $e) { /* ignore */ }
        }

        $galeri->delete();
        return redirect()->route('admin.galeris.index')->with('success', 'Galeri berhasil dihapus');
    }

    // Web view methods for public gallery
    public function webIndex(Request $request)
    {
        $query = Galeri::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where('title', 'like', "%{$search}%");
        }

        // Filter favorites
        if ($request->filled('favorite') && $request->get('favorite') == '1') {
            $query->where('is_favorite', true);
        }

        // Order by latest created
        $galeris = $query->latest('created_at')
                        ->paginate(3);

        // Get favorite photos for sidebar
        $favoritePhotos = Galeri::where('is_favorite', true)
                               ->orderBy('order', 'asc')
                               ->take(6)
                               ->get();

        // Get stats
        $totalPhotos = Galeri::count();
        $favoriteCount = Galeri::where('is_favorite', true)->count();

        return view('utama.content.galeri', compact('galeris', 'favoritePhotos', 'totalPhotos', 'favoriteCount'));
    }
}
