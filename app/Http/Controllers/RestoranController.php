<?php

namespace App\Http\Controllers;

use App\Models\Restoran;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RestoranController extends Controller
{
    public function index()
    {
        $restoran = Restoran::all();
        return view('restoran.index', compact('restoran'));
    }

    public function create()
    {
        return view('restoran.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kota' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'jam_operasional' => 'nullable|string|max:100',
            'kontak' => 'nullable|string|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $baseSlug = Str::slug($validated['nama']);
        $slug = $baseSlug;
        $i = 1;
        while (Restoran::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }
        $validated['slug'] = $slug;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('restoran'), $filename);
            $validated['gambar'] = 'restoran/' . $filename;
        }

        Restoran::create($validated);
        return redirect()->route('admin.restoran.index')->with('success', 'Restoran berhasil ditambahkan.');
    }

    public function show(Restoran $restoran)
    {
        return view('restoran.show', compact('restoran'));
    }

    public function edit(Restoran $restoran)
    {
        return view('restoran.edit', compact('restoran'));
    }

    public function update(Request $request, Restoran $restoran)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kota' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'jam_operasional' => 'nullable|string|max:100',
            'kontak' => 'nullable|string|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $baseSlug = Str::slug($validated['nama']);
        $slug = $baseSlug;
        $i = 1;
        while (Restoran::where('slug', $slug)->where('id', '!=', $restoran->id)->exists()) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }
        $validated['slug'] = $slug;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('restoran'), $filename);
            $validated['gambar'] = 'restoran/' . $filename;
        }

        $restoran->update($validated);
        return redirect()->route('admin.restorans.index')->with('success', 'Restoran berhasil diupdate.');
    }

    public function destroy(Restoran $restoran)
    {
        $restoran->delete();
        return redirect()->route('admin.restorans.index')->with('success', 'Restoran berhasil dihapus.');
    }
}
