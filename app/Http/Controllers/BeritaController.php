<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BeritaController extends Controller
{
    public function publish(Berita $berita)
    {
        $berita->status = 'published';
        $berita->posted_at = now()->setTimezone('Asia/Jakarta');
        $berita->save();
        return redirect()->route('admin.beritas.index')->with('success', 'Berita berhasil dipublish!');
    }
    // API endpoints
    public function index()
    {
        $beritas = Berita::orderBy('posted_at','desc')->get();
        return view('beritas.index', compact('beritas'));
    }

    public function create()
    {
        $jurusans = \App\Models\Jurusan::orderBy('name')->get();
        return view('beritas.create', compact('jurusans'));
    }

    public function show(Berita $berita)
    {
        return view('beritas.show', compact('berita'));
    }

    public function edit(Berita $berita)
    {
        $jurusans = \App\Models\Jurusan::orderBy('name')->get();
        return view('beritas.edit', compact('berita', 'jurusans'));
    }

    // Web view endpoints
    public function webIndex(Request $request)
    {
        $query = Berita::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category', $request->get('category'));
        }

        // Jurusan filter
        if ($request->filled('jurusan')) {
            $query->where('jurusan_id', $request->get('jurusan'));
        }

        // Get paginated results
        $beritas = $query->latest('created_at')->paginate(3);

        // Get popular news for sidebar (last 30 days, ordered by created_at desc as a proxy for popularity)
        $popularNews = Berita::where('created_at', '>=', now()->subDays(30))
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();

        // Get unique categories for filter dropdown
        $categories = Berita::select('category')
                           ->distinct()
                           ->whereNotNull('category')
                           ->where('category', '!=', '')
                           ->pluck('category');

        // Get all jurusans for filter dropdown
        $jurusans = \App\Models\Jurusan::orderBy('name')->get();

        return view('utama.content.berita', compact('beritas', 'popularNews', 'categories', 'jurusans'));
    }

    public function webShow(Berita $berita)
    {
        
        $berita= Berita::where('id', $berita->id)->firstOrFail();
        return view('utama.content.berita-detail', compact('berita'));
    }

    public function store(Request $request)
    {
        // Validate input (ensure category is one of allowed enum values)


        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'author' => 'nullable|string|max:255',
            'category' => 'nullable|in:Event,Kegiatan,Kesiswaan,Kurikulum,Prestasi,Humas,Iptek',
            'jurusan_id' => 'nullable|exists:jurusans,id',
            'posted_at' => 'nullable|date',
            'hashtags' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        $data = $request->only(['title','content','author','category','jurusan_id','posted_at']);
        // Handle hashtags as array (no json_encode, let Eloquent cast handle it)
        if ($request->has('hashtags')) {
            $hashtags = $request->input('hashtags');
            if (is_array($hashtags)) {
                $data['hashtags'] = array_values(array_filter($hashtags));
            } else {
                $data['hashtags'] = $hashtags;
            }
        }

        // Generate slug from title
        $data['slug'] = $this->generateSlug($request->input('title'), 'beritas');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = Str::slug($request->input('title','berita')) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $destination = public_path('images/berita');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $data['image_path'] = 'images/berita/' . $filename;
        }

        $berita = Berita::create($data);
        return redirect()->route('admin.beritas.index')->with('success', 'Berita berhasil ditambahkan');
    }

    public function update(Request $request, Berita $berita)
    {
        // Validate input (ensure category is one of allowed enum values)
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'author' => 'nullable|string|max:255',
            'category' => 'nullable|in:Event,Kegiatan,Kesiswaan,Kurikulum,Prestasi,Humas,Iptek',
            'jurusan_id' => 'nullable|exists:jurusans,id',
            'posted_at' => 'nullable|date',
            'hashtags' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        $data = $request->only(['title','content','author','category','jurusan_id','posted_at']);
        // Handle hashtags as array (no json_encode, let Eloquent cast handle it)
        if ($request->has('hashtags')) {
            $hashtags = $request->input('hashtags');
            if (is_array($hashtags)) {
                $data['hashtags'] = array_values(array_filter($hashtags));
            } else {
                $data['hashtags'] = $hashtags;
            }
        }

        // Generate new slug if title changed
        if ($request->input('title') !== $berita->title) {
            $data['slug'] = $this->generateSlug($request->input('title'), 'beritas', $berita->id);
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = Str::slug($request->input('title', $berita->title)) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $destination = public_path('images/berita');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $data['image_path'] = 'images/berita/' . $filename;
        }

        $berita->update($data);
        return redirect()->route('admin.beritas.index')->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy(Berita $berita)
    {
        $berita->delete();
        return redirect()->route('admin.beritas.index')->with('success', 'Berita berhasil dihapus');
    }

    /**
     * Generate unique slug from title
     */
    private function generateSlug($title, $table, $ignoreId = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (true) {
            $query = DB::table($table)->where('slug', $slug);
            
            if ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            }
            
            if (!$query->exists()) {
                break;
            }
            
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
