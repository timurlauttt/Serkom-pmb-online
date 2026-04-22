<?php

namespace App\Http\Controllers;

use App\Models\Desawisata;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DesaWisataController extends Controller
{
    public function index()
    {
        $desawisata = Desawisata::all();
        return view('desa-wisata.index', compact('desawisata'));
    }

    public function create()
    {
        return view('desa-wisata.create');
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

        $baseSlug = Str::slug($validated['nama']);
        $slug = $baseSlug;
        $i = 1;
        while (Desawisata::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }
        $validated['slug'] = $slug;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('desa-wisata'), $filename);
            $validated['gambar'] = 'desa-wisata/' . $filename;
        }

        Desawisata::create($validated);
        return redirect()->route('admin.desa-wisata.index')->with('success', 'Desa wisata berhasil ditambahkan.');
    }

    public function show(Desawisata $desa_wisatum)
    {
        return view('desa-wisata.show', ['desawisata' => $desa_wisatum]);
    }

    public function edit(Desawisata $desa_wisatum)
    {
        return view('desa-wisata.edit', ['desawisata' => $desa_wisatum]);
    }

    public function update(Request $request, Desawisata $desa_wisatum)
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

        $baseSlug = Str::slug($validated['nama']);
        $slug = $baseSlug;
        $i = 1;
        while (Desawisata::where('slug', $slug)->where('id', '!=', $desa_wisatum->id)->exists()) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }
        $validated['slug'] = $slug;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('desa-wisata'), $filename);
            $validated['gambar'] = 'desa-wisata/' . $filename;
        }

        $desa_wisatum->update($validated);
        return redirect()->route('admin.desa-wisata.index')->with('success', 'Desa wisata berhasil diupdate.');
    }

    public function destroy(Desawisata $desa_wisatum)
    {
        $desa_wisatum->delete();
        return redirect()->route('admin.desa-wisata.index')->with('success', 'Desa wisata berhasil dihapus.');
    }
}
