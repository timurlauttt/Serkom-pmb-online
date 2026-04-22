<?php

namespace App\Http\Controllers;

use App\Models\PpdbJalur;
use Illuminate\Http\Request;

class PpdbJalurController extends Controller
{
    public function index()
    {
        $jalurs = PpdbJalur::ordered()->get();
        return view('admin.ppdb.jalurs.index', compact('jalurs'));
    }

    public function create()
    {
        return view('admin.ppdb.jalurs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jalur' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kuota' => 'nullable|integer|min:0',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $data = $request->only(['nama_jalur', 'deskripsi', 'kuota', 'tanggal_mulai', 'tanggal_selesai', 'is_active', 'order']);
        PpdbJalur::create($data);
        
        return redirect()->route('admin.ppdb_jalurs.index')->with('success', 'Jalur PPDB berhasil ditambahkan');
    }

    public function edit(PpdbJalur $ppdbJalur)
    {
        return view('admin.ppdb.jalurs.edit', compact('ppdbJalur'));
    }

    public function update(Request $request, PpdbJalur $ppdbJalur)
    {
        $validated = $request->validate([
            'nama_jalur' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kuota' => 'nullable|integer|min:0',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $data = $request->only(['nama_jalur', 'deskripsi', 'kuota', 'tanggal_mulai', 'tanggal_selesai', 'is_active', 'order']);
        $ppdbJalur->update($data);
        
        return redirect()->route('admin.ppdb_jalurs.index')->with('success', 'Jalur PPDB berhasil diupdate');
    }

    public function destroy(PpdbJalur $ppdbJalur)
    {
        $ppdbJalur->delete();
        return redirect()->route('admin.ppdb_jalurs.index')->with('success', 'Jalur PPDB berhasil dihapus');
    }
}
