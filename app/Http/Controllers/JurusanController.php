<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::all();
        return view('jurusans.index', compact('jurusans'));
    }

    public function create()
    {
        return view('jurusans.create');
    }

    public function show($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        return view('jurusans.show', compact('jurusan'));
    }

    public function edit($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        return view('jurusans.edit', compact('jurusan'));
    }

    public function store(Request $request)
    {
        $data = $request->only([
            'name', 'description', 'prospects', 'photo_title', 'spp_fee',
        ]);
        $data['slug'] = $this->generateSlug($request->name);

        // Mata pelajaran unggulan
        $data['subjects'] = $request->input('subjects', []);
        // Prospek lulusan (array)
        $data['prospects'] = $request->input('prospects', []);
        // Sertifikasi (array)
        $data['certifications'] = $request->input('certifications', []);

        // Mitra jurusan (array: name+logo)
        $partners = $request->input('partners', []);
        // Handle logo upload for each partner
        if ($request->hasFile('partner_logos')) {
            foreach ($request->file('partner_logos') as $idx => $file) {
                if ($file) {
                    $filename = 'mitra-' . Str::slug($request->input('name', 'jurusan')) . '-' . $idx . '-' . time() . '.' . $file->getClientOriginalExtension();
                    $destination = public_path('images/mitra');
                    if (!file_exists($destination)) {
                        mkdir($destination, 0755, true);
                    }
                    $file->move($destination, $filename);
                    $partners[$idx]['logo'] = 'images/mitra/' . $filename;
                }
            }
        }
        $data['partners'] = $partners;

        // Handle 3 foto representatif
        foreach ([1 => 'photo', 2 => 'photo_2', 3 => 'photo_3'] as $i => $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = Str::slug($request->input('name', 'jurusan')) . '-' . $field . '-' . time() . '.' . $file->getClientOriginalExtension();
                $destination = public_path('images/jurusan');
                if (!file_exists($destination)) {
                    mkdir($destination, 0755, true);
                }
                $file->move($destination, $filename);
                $col = $i === 1 ? 'photo_path' : 'photo_path_' . $i;
                $data[$col] = 'images/jurusan/' . $filename;
            }
        }

        $jurusan = Jurusan::create($data);
        return redirect()->route('admin.jurusans.index')->with('success', 'Jurusan berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $jurusan = Jurusan::findOrFail($id);
        $data = $request->only([
            'name', 'description', 'prospects', 'photo_title', 'spp_fee',
        ]);
        $data['slug'] = $this->generateSlug($request->name, $id);

        $data['subjects'] = $request->input('subjects', []);
        $data['prospects'] = $request->input('prospects', []);
        $data['certifications'] = $request->input('certifications', []);

        // Mitra jurusan (array: name+logo)
        $partners = $request->input('partners', []);
        $oldPartners = is_array($jurusan->partners) ? $jurusan->partners : [];
        if ($request->hasFile('partner_logos')) {
            foreach ($request->file('partner_logos') as $idx => $file) {
                if ($file) {
                    $filename = 'mitra-' . Str::slug($request->input('name', $jurusan->name)) . '-' . $idx . '-' . time() . '.' . $file->getClientOriginalExtension();
                    $destination = public_path('images/mitra');
                    if (!file_exists($destination)) {
                        mkdir($destination, 0755, true);
                    }
                    $file->move($destination, $filename);
                    $partners[$idx]['logo'] = 'images/mitra/' . $filename;
                } elseif (!empty($oldPartners[$idx]['logo'])) {
                    $partners[$idx]['logo'] = $oldPartners[$idx]['logo'];
                }
            }
        } else {
            // Tidak ada upload baru, gunakan logo lama jika ada
            foreach ($partners as $idx => $mitra) {
                if (!empty($oldPartners[$idx]['logo'])) {
                    $partners[$idx]['logo'] = $oldPartners[$idx]['logo'];
                }
            }
        }
        $data['partners'] = $partners;

        // Handle 3 foto representatif
        foreach ([1 => 'photo', 2 => 'photo_2', 3 => 'photo_3'] as $i => $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = Str::slug($request->input('name', $jurusan->name)) . '-' . $field . '-' . time() . '.' . $file->getClientOriginalExtension();
                $destination = public_path('images/jurusan');
                if (!file_exists($destination)) {
                    mkdir($destination, 0755, true);
                }
                $file->move($destination, $filename);
                $col = $i === 1 ? 'photo_path' : 'photo_path_' . $i;
                $data[$col] = 'images/jurusan/' . $filename;
            }
        }

        $jurusan->update($data);
        return redirect()->route('admin.jurusans.index')->with('success', 'Jurusan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->delete();
        return redirect()->route('admin.jurusans.index')->with('success', 'Jurusan berhasil dihapus');
    }

    // Web (public) listing
    public function webIndex(Request $request)
    {
        $query = Jurusan::query();

        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('prospects', 'like', "%{$search}%");
            });
        }

        $jurusans = $query->orderBy('name')->paginate(12);

        // For sidebar or related section (popular / randomized subset)
        $otherJurusans = Jurusan::inRandomOrder()->take(5)->get();

        return view('utama.content.jurusan', compact('jurusans', 'otherJurusans'));
    }

    // Web (public) detail
    public function webShow(Jurusan $jurusan)
    {
        // Related (exclude current)
        $related = Jurusan::where('id', '!=', $jurusan->id)
                           ->inRandomOrder()
                           ->take(4)
                           ->get();

        // Normalise subjects array
        $subjects = is_array($jurusan->subjects) ? $jurusan->subjects : [];

        // Fetch related Berita (3 latest)
        $beritas = \App\Models\Berita::where('jurusan_id', $jurusan->id)
                                     ->orderBy('created_at', 'desc')
                                     ->take(3)
                                     ->get();

        // Fetch related Events (3 latest)
        $events = \App\Models\Event::where('jurusan_id', $jurusan->id)
                                    ->orderBy('start_date', 'desc')
                                    ->take(3)
                                    ->get();

        // Fetch related Gallery (6 latest)
        $galleries = \App\Models\Galeri::where('jurusan_id', $jurusan->id)
                                       ->orderBy('created_at', 'desc')
                                       ->take(6)
                                       ->get();

        return view('utama.content.jurusan-detail', compact('jurusan', 'related', 'subjects', 'beritas', 'events', 'galleries'));
    }

    private function generateSlug($title, $excludeId = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        while (Jurusan::where('slug', $slug)->when($excludeId, function ($query) use ($excludeId) {
            return $query->where('id', '!=', $excludeId);
        })->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
