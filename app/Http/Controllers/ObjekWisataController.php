<?php

namespace App\Http\Controllers;

use App\Models\ObjekWisata;
use Illuminate\Http\Request;

class ObjekWisataController extends Controller
{
    public function index()
    {
        $objekWisata = ObjekWisata::all();
        return view('objek-wisata.index', compact('objekWisata'));
    }

    public function create()
    {
        return view('objek-wisata.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kota' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'harga_tiket' => 'nullable|numeric|min:0',
            'jam_operasional' => 'nullable|string|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $baseSlug = \Str::slug($validated['nama']);
        $slug = $baseSlug;
        $i = 1;
        while (ObjekWisata::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }
        $validated['slug'] = $slug;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('objek-wisata'), $filename);
            $validated['gambar'] = 'objek-wisata/' . $filename;
        }

        ObjekWisata::create($validated);
        return redirect()->route('admin.objek-wisata.index')->with('success', 'Objek wisata berhasil ditambahkan.');
    }

    public function show(ObjekWisata $objek_wisatum)
    {
        return view('objek-wisata.show', ['objekWisata' => $objek_wisatum]);
    }

    public function edit(ObjekWisata $objek_wisatum)
    {
        return view('objek-wisata.edit', ['objekWisata' => $objek_wisatum]);
    }

    public function update(Request $request, ObjekWisata $objek_wisatum)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kota' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'harga_tiket' => 'nullable|numeric|min:0',
            'jam_operasional' => 'nullable|string|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $baseSlug = \Str::slug($validated['nama']);
        $slug = $baseSlug;
        $i = 1;
        while (ObjekWisata::where('slug', $slug)->where('id', '!=', $objek_wisatum->id)->exists()) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }
        $validated['slug'] = $slug;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('objek-wisata'), $filename);
            $validated['gambar'] = 'objek-wisata/' . $filename;
        }

        $objek_wisatum->update($validated);
        return redirect()->route('admin.objek-wisata.index')->with('success', 'Objek wisata berhasil diupdate.');
    }

    public function destroy(ObjekWisata $objek_wisatum)
    {
        $objek_wisatum->delete();
        return redirect()->route('admin.objek-wisata.index')->with('success', 'Objek wisata berhasil dihapus.');
    }
}
