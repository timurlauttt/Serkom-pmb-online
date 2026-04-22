<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::all();
        return view('hotels.index', compact('hotels'));
    }

    public function create()
    {
        return view('hotels.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kota' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'harga_mulai' => 'nullable|numeric|min:0',
            'kontak' => 'nullable|string|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $baseSlug = \Str::slug($validated['nama']);
        $slug = $baseSlug;
        $i = 1;
        while (\App\Models\Hotel::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }
        $validated['slug'] = $slug;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('hotels'), $filename);
            $validated['gambar'] = 'hotels/' . $filename;
        }

        Hotel::create($validated);
        return redirect()->route('admin.hotels.index')->with('success', 'Hotel berhasil ditambahkan.');
    }

    public function show(Hotel $hotel)
    {
        return view('hotels.show', compact('hotel'));
    }

    public function edit(Hotel $hotel)
    {
        return view('hotels.edit', compact('hotel'));
    }

    public function update(Request $request, Hotel $hotel)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kota' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'harga_mulai' => 'nullable|numeric|min:0',
            'kontak' => 'nullable|string|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $baseSlug = \Str::slug($validated['nama']);
        $slug = $baseSlug;
        $i = 1;
        while (\App\Models\Hotel::where('slug', $slug)->where('id', '!=', $hotel->id)->exists()) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }
        $validated['slug'] = $slug;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('hotels'), $filename);
            $validated['gambar'] = 'hotels/' . $filename;
        }

        $hotel->update($validated);
        return redirect()->route('admin.hotels.index')->with('success', 'Hotel berhasil diupdate.');
    }

    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return redirect()->route('admin.hotels.index')->with('success', 'Hotel berhasil dihapus.');
    }
}
