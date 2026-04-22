<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MitraController extends Controller
{
    public function index()
    {
        $mitras = Mitra::orderBy('created_at', 'desc')->get();
        return view('mitras.index', compact('mitras'));
    }

    /**
     * Return mitra list for frontend (logos).
     * This can be used by the homepage to render partner logos.
     */
    public function webList()
    {
        return Mitra::orderBy('nama')->get();
    }

    // Redirect since UI uses modal in index
    public function create()
    {
        return redirect()->route('admin.mitras.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:191',
            'url' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        $data = $request->only(['nama','url']);

        if ($request->hasFile('logo')) {
            $destination = public_path('images/mitras');
            if (!File::exists($destination)) {
                File::makeDirectory($destination, 0755, true);
            }
            $file = $request->file('logo');
            $filename = Str::random(8) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($destination, $filename);
            $data['logo'] = 'images/mitras/' . $filename;
        }

        Mitra::create($data);
        return redirect()->route('admin.mitras.index')->with('success', 'Mitra berhasil ditambahkan');
    }

    public function edit($id)
    {
        return redirect()->route('admin.mitras.index');
    }

    public function update(Request $request, $id)
    {
        $mitra = Mitra::findOrFail($id);
        $request->validate([
            'nama' => 'required|string|max:191',
            'url' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        $data = $request->only(['nama','url']);

        if ($request->hasFile('logo')) {
            $destination = public_path('images/mitras');
            if (!File::exists($destination)) {
                File::makeDirectory($destination, 0755, true);
            }
            $file = $request->file('logo');
            $filename = Str::random(8) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($destination, $filename);

            // delete old logo
            if ($mitra->logo && File::exists(public_path($mitra->logo))) {
                try { File::delete(public_path($mitra->logo)); } catch (\Exception $e) { /* ignore */ }
            }

            $data['logo'] = 'images/mitras/' . $filename;
        }

        $mitra->update($data);
        return redirect()->route('admin.mitras.index')->with('success', 'Mitra berhasil diperbarui');
    }

    public function destroy($id)
    {
        $mitra = Mitra::findOrFail($id);
        if ($mitra->logo && File::exists(public_path($mitra->logo))) {
            try { File::delete(public_path($mitra->logo)); } catch (\Exception $e) { /* ignore */ }
        }
        $mitra->delete();
        return redirect()->route('admin.mitras.index')->with('success', 'Mitra berhasil dihapus');
    }
}
