<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EkstrakurikulerController extends Controller
{
    // Admin CRUD
    public function index()
    {
        $ekstrakurikulers = Ekstrakurikuler::orderBy('nama')->get();
        return view('admin.ekstrakurikulers.index', compact('ekstrakurikulers'));
    }

    public function create()
    {
        return view('admin.ekstrakurikulers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'icon' => 'nullable|string|max:100',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'pembina' => 'nullable|string|max:255',
            'jadwal' => 'nullable|string',
            'tags' => 'nullable',
            'is_active' => 'boolean',
        ]);

        $data = $request->only(['nama', 'deskripsi', 'icon', 'pembina', 'jadwal', 'is_active']);
        
        // Handle tags array
        if ($request->has('tags')) {
            $tags = $request->input('tags');
            if (is_array($tags)) {
                $data['tags'] = array_values(array_filter($tags));
            } else {
                $data['tags'] = $tags;
            }
        }

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = Str::slug($request->input('nama', 'eskul')) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $destination = public_path('images/ekstrakurikuler');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $data['thumbnail'] = 'images/ekstrakurikuler/' . $filename;
        }

        Ekstrakurikuler::create($data);
        return redirect()->route('admin.ekstrakurikulers.index')->with('success', 'Ekstrakurikuler berhasil ditambahkan');
    }

    public function edit(Ekstrakurikuler $ekstrakurikuler)
    {
        return view('admin.ekstrakurikulers.edit', compact('ekstrakurikuler'));
    }

    public function update(Request $request, Ekstrakurikuler $ekstrakurikuler)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'icon' => 'nullable|string|max:100',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'pembina' => 'nullable|string|max:255',
            'jadwal' => 'nullable|string',
            'tags' => 'nullable',
            'is_active' => 'boolean',
        ]);

        $data = $request->only(['nama', 'deskripsi', 'icon', 'pembina', 'jadwal', 'is_active']);
        
        // Handle tags array
        if ($request->has('tags')) {
            $tags = $request->input('tags');
            if (is_array($tags)) {
                $data['tags'] = array_values(array_filter($tags));
            } else {
                $data['tags'] = $tags;
            }
        }

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($ekstrakurikuler->thumbnail && file_exists(public_path($ekstrakurikuler->thumbnail))) {
                unlink(public_path($ekstrakurikuler->thumbnail));
            }

            $file = $request->file('thumbnail');
            $filename = Str::slug($request->input('nama', 'eskul')) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $destination = public_path('images/ekstrakurikuler');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $data['thumbnail'] = 'images/ekstrakurikuler/' . $filename;
        }

        // Regenerate slug if nama changed
        if ($request->input('nama') !== $ekstrakurikuler->nama) {
            $data['slug'] = Str::slug($request->input('nama'));
        }

        $ekstrakurikuler->update($data);
        return redirect()->route('admin.ekstrakurikulers.index')->with('success', 'Ekstrakurikuler berhasil diupdate');
    }

    public function destroy(Ekstrakurikuler $ekstrakurikuler)
    {
        // Delete thumbnail if exists
        if ($ekstrakurikuler->thumbnail && file_exists(public_path($ekstrakurikuler->thumbnail))) {
            unlink(public_path($ekstrakurikuler->thumbnail));
        }

        $ekstrakurikuler->delete();
        return redirect()->route('admin.ekstrakurikulers.index')->with('success', 'Ekstrakurikuler berhasil dihapus');
    }

    // Frontend
    public function publicIndex()
    {
        $ekstrakurikulers = Ekstrakurikuler::active()->orderBy('nama')->get();
        return view('utama.content.ekstrakulikuler', compact('ekstrakurikulers'));
    }
}
