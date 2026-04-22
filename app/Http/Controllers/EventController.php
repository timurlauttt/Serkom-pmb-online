<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function toggleStatus(Event $event)
    {
        $event->status = $event->status === 'published' ? 'draft' : 'published';
        $event->save();
        return redirect()->route('admin.events.index')->with('success', 'Status event berhasil diubah!');
    }
    // API endpoints for admin
    public function index()
    {
        $events = Event::with('jurusan')->orderBy('start_date', 'desc')->get();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        $jurusans = \App\Models\Jurusan::orderBy('name')->get();
        return view('events.create', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'location' => 'nullable|string|max:255',
            'organizer' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'start_date' => 'required|date',
                'end_date' => 'nullable|date',
                'location' => 'nullable|string|max:255',
                'organizer' => 'nullable|string|max:255',
                'category' => 'nullable|string|max:255',
                'jurusan_id' => 'nullable|exists:jurusans,id',
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
                'status' => 'nullable|string',
            ]);

        $data = $request->all();
        $data['slug'] = $this->generateUniqueSlug($request->title, 'events');

        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $filename = time() . '-' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $destination = public_path('images/events');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $data['image_path'] = 'images/events/' . $filename;
        }

        Event::create($data);
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil ditambahkan');
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        $jurusans = \App\Models\Jurusan::orderBy('name')->get();
        return view('events.edit', compact('event', 'jurusans'));
    }

    public function update(Request $request, Event $event)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'location' => 'nullable|string|max:255',
            'organizer' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);
            $data = $request->only(['title','description','start_date','end_date','location','organizer','category','jurusan_id','status']);

        $data = $request->all();

        if ($request->hasFile('image_path')) {
            // delete old image if exists
            if ($event->image_path && file_exists(public_path($event->image_path))) {
                @unlink(public_path($event->image_path));
            }
            $file = $request->file('image_path');
            $filename = time() . '-' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $destination = public_path('images/events');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $data['image_path'] = 'images/events/' . $filename;
        } else {
            unset($data['image_path']);
        }

        $event->update($data);
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil diperbarui');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dihapus');
    }

    // Web view endpoints for public
    public function webIndex(Request $request)
    {
        $query = Event::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category', $request->get('category'));
        }

        // Date filter
        if ($request->filled('date_filter')) {
            $dateFilter = $request->get('date_filter');
            switch ($dateFilter) {
                case 'upcoming':
                    $query->where('start_date', '>=', now());
                    break;
                case 'past':
                    $query->where('start_date', '<', now());
                    break;
                case 'this_month':
                    $query->whereMonth('start_date', now()->month)
                        ->whereYear('start_date', now()->year);
                    break;
            }
        }

        // Default: latest created events
        $events = $query->latest('created_at')->paginate(3);

        // Get upcoming events for sidebar
        $upcomingEvents = Event::where('start_date', '>=', now())
            ->orderBy('start_date', 'asc')
            ->take(5)
            ->get();

        // Get unique categories for filter dropdown
        $categories = Event::select('category')
            ->distinct()
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->pluck('category');

        return view('utama.content.event', compact('events', 'upcomingEvents', 'categories'));
    }

    public function webShow(Event $event)
    {
        $relatedEvents = Event::where('category', $event->category)
            ->where('id', '!=', $event->id)
            ->where('start_date', '>=', now())
            ->orderBy('start_date', 'asc')
            ->take(4)
            ->get();
        $upcomingEvents = Event::where('start_date', '>=', now())
            ->orderBy('start_date', 'asc')
            ->take(5)
            ->get();

        // Get unique categories for filter dropdown
        $categories = Event::select('category')
            ->distinct()
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->pluck('category');

        return view('utama.content.event-detail', compact('event', 'relatedEvents', 'upcomingEvents', 'categories'));
    }

    // Helper method to generate unique slug
    private function generateUniqueSlug($title, $table, $ignoreId = null)
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
