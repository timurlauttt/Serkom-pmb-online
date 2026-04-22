<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumumans = Pengumuman::orderBy('posted_at', 'desc')->get();
        return view('pengumumans.index', compact('pengumumans'));
    }

    public function create()
    {
        return view('pengumumans.create');
    }

    public function show(Pengumuman $pengumuman)
    {
        return view('pengumumans.show', compact('pengumuman'));
    }

    public function edit(Pengumuman $pengumuman)
    {
        return view('pengumumans.edit', compact('pengumuman'));
    }

    public function store(Request $request)
    {
        $data = $request->only(['title', 'content', 'posted_at', 'expires_at']);

        // Generate slug from title
        $data['slug'] = $this->generateSlug($request->input('title'), 'pengumumans');

        $pengumuman = Pengumuman::create($data);
        return redirect()->route('admin.pengumumans.index')->with('success', 'Pengumuman berhasil ditambahkan');
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $data = $request->only(['title', 'content', 'posted_at', 'expires_at']);

        // Generate new slug if title changed
        if ($request->input('title') !== $pengumuman->title) {
            $data['slug'] = $this->generateSlug($request->input('title'), 'pengumumans', $pengumuman->id);
        }

        $pengumuman->update($data);
        return redirect()->route('admin.pengumumans.index')->with('success', 'Pengumuman berhasil diperbarui');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();
        return redirect()->route('admin.pengumumans.index')->with('success', 'Pengumuman berhasil dihapus');
    }

    // Web view endpoints for public
    public function webIndex(Request $request)
    {
        $query = Pengumuman::query();

        // Filter berdasarkan pencarian
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;

            if ($searchTerm === 'terbaru') {
                $query->where('posted_at', '>=', now()->subWeek());
            } elseif ($searchTerm === 'bulan') {
                $query->where('posted_at', '>=', now()->subMonth());
            } else {
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('title', 'like', '%' . $searchTerm . '%')
                        ->orWhere('content', 'like', '%' . $searchTerm . '%');
                });
            }
        }

        // Filter berdasarkan status
        if ($request->has('status') && !empty($request->status)) {
            if ($request->status === 'active') {
                $query->where(function ($q) {
                    $q->whereNull('expires_at')
                        ->orWhere('expires_at', '>=', now());
                });
            } elseif ($request->status === 'expired') {
                $query->whereNotNull('expires_at')
                    ->where('expires_at', '<', now());
            }
        }

        $pengumumans = $query->latest('created_at')
            ->paginate(3);

        // Get recent announcements for sidebar (last 30 days)
        $importantAnnouncements = Pengumuman::where('created_at', '>=', now()->subDays(30))
            ->where(function ($q) {
                $q->whereNull('expires_at')
                    ->orWhere('expires_at', '>=', now());
            })
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('utama.content.pengumuman', compact('pengumumans', 'importantAnnouncements'));
    }

    public function webShow(Pengumuman $pengumuman)
    {
        $relatedAnnouncements = Pengumuman::where('id', '!=', $pengumuman->id)
            ->where(function ($q) {
                $q->whereNull('expires_at')
                    ->orWhere('expires_at', '>=', now());
            })
            ->orderBy('posted_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        // Recent announcements for sidebar (same as webIndex)
        $importantAnnouncements = Pengumuman::where('created_at', '>=', now()->subDays(30))
            ->where(function ($q) {
                $q->whereNull('expires_at')
                    ->orWhere('expires_at', '>=', now());
            })
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Provide categories (from Berita) for sidebar filters if desired
        $categories = Berita::select('category')
            ->distinct()
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->pluck('category');

        return view('utama.content.pengumuman-detail', compact('pengumuman', 'relatedAnnouncements', 'importantAnnouncements', 'categories'));
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
