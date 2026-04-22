<?php

namespace App\Http\Controllers;

use App\Models\PpdbBrosur;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PpdbBrosurController extends Controller
{
    public function index()
    {
        $brosurs = PpdbBrosur::ordered()->get();
        return view('admin.ppdb.brosurs.index', compact('brosurs'));
    }

    public function create()
    {
        return view('admin.ppdb.brosurs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'file_path' => 'required|file|mimes:pdf|max:10240',
            'path_gambar_brosur' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'tahun_ajaran' => 'required|string|max:20',
            'deskripsi' => 'nullable|string',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $data = $request->only(['judul', 'tahun_ajaran', 'deskripsi', 'is_active', 'order']);

        // Handle PDF upload
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $filename = Str::slug($request->input('judul', 'brosur')) . '-' . time() . '.pdf';
            $destination = public_path('documents/ppdb/brosur');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $data['file_path'] = 'documents/ppdb/brosur/' . $filename;
        }

        // Handle Image upload
        if ($request->hasFile('path_gambar_brosur')) {
            $image = $request->file('path_gambar_brosur'); // @phpstan-ignore-line
            $imageName = Str::slug($request->input('judul', 'brosur-image')) . '-' . time() . '.' . $image->getClientOriginalExtension();
            $imageDestination = public_path('images/ppdb/brosur');
            if (!file_exists($imageDestination)) {
                mkdir($imageDestination, 0755, true);
            }
            $image->move($imageDestination, $imageName);
            $data['path_gambar_brosur'] = 'images/ppdb/brosur/' . $imageName;
        }

        PpdbBrosur::create($data);
        return redirect()->route('admin.ppdb_brosurs.index')->with('success', 'Brosur PPDB berhasil ditambahkan');
    }

    public function edit(PpdbBrosur $ppdbBrosur)
    {
        return view('admin.ppdb.brosurs.edit', compact('ppdbBrosur'));
    }

    public function update(Request $request, PpdbBrosur $ppdbBrosur)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'file_path' => 'nullable|file|mimes:pdf|max:10240',
            'path_gambar_brosur' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'tahun_ajaran' => 'required|string|max:20',
            'deskripsi' => 'nullable|string',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $data = $request->only(['judul', 'tahun_ajaran', 'deskripsi', 'is_active', 'order']);

        // Handle PDF upload
        if ($request->hasFile('file_path')) {
            // Delete old file if exists
            if ($ppdbBrosur->file_path && file_exists(public_path($ppdbBrosur->file_path))) {
                unlink(public_path($ppdbBrosur->file_path));
            }

            $file = $request->file('file_path');
            $filename = Str::slug($request->input('judul', 'brosur')) . '-' . time() . '.pdf';
            $destination = public_path('documents/ppdb/brosur');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $data['file_path'] = 'documents/ppdb/brosur/' . $filename;
        }

        // Handle Image upload
        if ($request->hasFile('path_gambar_brosur')) {
            // Delete old image if exists
            if ($ppdbBrosur->path_gambar_brosur && file_exists(public_path($ppdbBrosur->path_gambar_brosur))) {
                unlink(public_path($ppdbBrosur->path_gambar_brosur));
            }

            $image = $request->file('path_gambar_brosur'); // @phpstan-ignore-line
            $imageName = Str::slug($request->input('judul', 'brosur-image')) . '-' . time() . '.' . $image->getClientOriginalExtension();
            $imageDestination = public_path('images/ppdb/brosur');
            if (!file_exists($imageDestination)) {
                mkdir($imageDestination, 0755, true);
            }
            $image->move($imageDestination, $imageName);
            $data['path_gambar_brosur'] = 'images/ppdb/brosur/' . $imageName;
        }

        $ppdbBrosur->update($data);
        return redirect()->route('admin.ppdb_brosurs.index')->with('success', 'Brosur PPDB berhasil diupdate');
    }

    public function destroy(PpdbBrosur $ppdbBrosur)
    {
        // Delete file if exists
        if ($ppdbBrosur->file_path && file_exists(public_path($ppdbBrosur->file_path))) {
            unlink(public_path($ppdbBrosur->file_path));
        }

        // Delete image if exists
        if ($ppdbBrosur->path_gambar_brosur && file_exists(public_path($ppdbBrosur->path_gambar_brosur))) {
            unlink(public_path($ppdbBrosur->path_gambar_brosur));
        }

        $ppdbBrosur->delete();
        return redirect()->route('admin.ppdb_brosurs.index')->with('success', 'Brosur PPDB berhasil dihapus');
    }
}
