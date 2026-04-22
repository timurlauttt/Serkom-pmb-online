<?php

namespace App\Http\Controllers;

use App\Models\PaketWisata;
use App\Models\Hotel;
use App\Models\ObjekWisata;
use Illuminate\Http\Request;

class PaketWisataController extends Controller
{
    public function index()
    {
        $paketWisata = PaketWisata::all();
        return view('paket-wisata.index', compact('paketWisata'));
    }

    public function create()
    {
        return view('paket-wisata.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'durasi_hari' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'akomodasi' => 'nullable|array',
            'akomodasi.*' => 'nullable|string',
            'objek_wisata' => 'nullable|array',
            'objek_wisata.*' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $baseSlug = \Str::slug($validated['nama_paket']);
        $slug = $baseSlug;
        $i = 1;
        while (PaketWisata::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }
        $validated['slug'] = $slug;

        // Filter empty values from arrays
        if (isset($validated['akomodasi'])) {
            $validated['akomodasi'] = array_values(array_filter($validated['akomodasi'], fn($val) => !empty(trim($val))));
        }
        if (isset($validated['objek_wisata'])) {
            $validated['objek_wisata'] = array_values(array_filter($validated['objek_wisata'], fn($val) => !empty(trim($val))));
        }

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('paket-wisata'), $filename);
            $validated['gambar'] = 'paket-wisata/' . $filename;
        }

        PaketWisata::create($validated);

        return redirect()->route('admin.paket-wisata.index')->with('success', 'Paket wisata berhasil ditambahkan.');
    }

    public function show(PaketWisata $paket_wisatum)
    {
        return view('paket-wisata.show', ['paketWisata' => $paket_wisatum]);
    }

    public function edit(PaketWisata $paket_wisatum)
    {
        return view('paket-wisata.edit', ['paketWisata' => $paket_wisatum]);
    }

    public function update(Request $request, PaketWisata $paket_wisatum)
    {
        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'durasi_hari' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'akomodasi' => 'nullable|array',
            'akomodasi.*' => 'nullable|string',
            'objek_wisata' => 'nullable|array',
            'objek_wisata.*' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $baseSlug = \Str::slug($validated['nama_paket']);
        $slug = $baseSlug;
        $i = 1;
        while (PaketWisata::where('slug', $slug)->where('id', '!=', $paket_wisatum->id)->exists()) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }
        $validated['slug'] = $slug;

        // Filter empty values from arrays
        if (isset($validated['akomodasi'])) {
            $validated['akomodasi'] = array_values(array_filter($validated['akomodasi'], fn($val) => !empty(trim($val))));
        }
        if (isset($validated['objek_wisata'])) {
            $validated['objek_wisata'] = array_values(array_filter($validated['objek_wisata'], fn($val) => !empty(trim($val))));
        }

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('paket-wisata'), $filename);
            $validated['gambar'] = 'paket-wisata/' . $filename;
        }

        $paket_wisatum->update($validated);

        return redirect()->route('admin.paket-wisata.index')->with('success', 'Paket wisata berhasil diupdate.');
    }

    public function destroy(PaketWisata $paket_wisatum)
    {
        $paket_wisatum->delete();
        return redirect()->route('admin.paket-wisata.index')->with('success', 'Paket wisata berhasil dihapus.');
    }
}
