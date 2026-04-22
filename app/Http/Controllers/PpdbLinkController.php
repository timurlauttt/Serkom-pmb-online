<?php

namespace App\Http\Controllers;

use App\Models\PpdbLink;
use Illuminate\Http\Request;

class PpdbLinkController extends Controller
{
    public function index()
    {
        $links = PpdbLink::ordered()->get();
        return view('admin.ppdb.links.index', compact('links'));
    }

    public function create()
    {
        $jenisOptions = ['pendaftaran', 'info', 'hasil', 'lainnya'];
        return view('admin.ppdb.links.create', compact('jenisOptions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_link' => 'required|string|max:255',
            'url' => 'required|url|max:500',
            'jenis' => 'required|in:pendaftaran,info,hasil,lainnya',
            'deskripsi' => 'nullable|string',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $data = $request->only(['nama_link', 'url', 'jenis', 'deskripsi', 'is_active', 'order']);
        PpdbLink::create($data);
        
        return redirect()->route('admin.ppdb_links.index')->with('success', 'Link PPDB berhasil ditambahkan');
    }

    public function edit(PpdbLink $ppdbLink)
    {
        $jenisOptions = ['pendaftaran', 'info', 'hasil', 'lainnya'];
        return view('admin.ppdb.links.edit', compact('ppdbLink', 'jenisOptions'));
    }

    public function update(Request $request, PpdbLink $ppdbLink)
    {
        $validated = $request->validate([
            'nama_link' => 'required|string|max:255',
            'url' => 'required|url|max:500',
            'jenis' => 'required|in:pendaftaran,info,hasil,lainnya',
            'deskripsi' => 'nullable|string',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $data = $request->only(['nama_link', 'url', 'jenis', 'deskripsi', 'is_active', 'order']);
        $ppdbLink->update($data);
        
        return redirect()->route('admin.ppdb_links.index')->with('success', 'Link PPDB berhasil diupdate');
    }

    public function destroy(PpdbLink $ppdbLink)
    {
        $ppdbLink->delete();
        return redirect()->route('admin.ppdb_links.index')->with('success', 'Link PPDB berhasil dihapus');
    }
}
