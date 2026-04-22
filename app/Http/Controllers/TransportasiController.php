<?php

namespace App\Http\Controllers;

use App\Models\Transportasi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransportasiController extends Controller
{
    public function index()
    {
        $transportasi = Transportasi::all();
        return view('transportasi.index', compact('transportasi'));
    }

    public function create()
    {
        return view('transportasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis' => 'required|string|max:255',
            'nama_provider' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'kontak' => 'nullable|string|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $baseSlug = Str::slug($validated['nama_provider']);
        $slug = $baseSlug;
        $i = 1;
        while (Transportasi::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }
        $validated['slug'] = $slug;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('transportasi'), $filename);
            $validated['gambar'] = 'transportasi/' . $filename;
        }

        Transportasi::create($validated);
        return redirect()->route('admin.transportasi.index')->with('success', 'Transportasi berhasil ditambahkan.');
    }

    public function show(Transportasi $transportasi)
    {
        return view('transportasi.show', compact('transportasi'));
    }

    public function edit(Transportasi $transportasi)
    {
        return view('transportasi.edit', compact('transportasi'));
    }

    public function update(Request $request, Transportasi $transportasi)
    {
        $validated = $request->validate([
            'jenis' => 'required|string|max:255',
            'nama_provider' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'kontak' => 'nullable|string|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $baseSlug = Str::slug($validated['nama_provider']);
        $slug = $baseSlug;
        $i = 1;
        while (Transportasi::where('slug', $slug)->where('id', '!=', $transportasi->id)->exists()) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }
        $validated['slug'] = $slug;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('transportasi'), $filename);
            $validated['gambar'] = 'transportasi/' . $filename;
        }

        $transportasi->update($validated);
        return redirect()->route('admin.transportasi.index')->with('success', 'Transportasi berhasil diupdate.');
    }

    public function destroy(Transportasi $transportasi)
    {
        $transportasi->delete();
        return redirect()->route('admin.transportasi.index')->with('success', 'Transportasi berhasil dihapus.');
    }
}
