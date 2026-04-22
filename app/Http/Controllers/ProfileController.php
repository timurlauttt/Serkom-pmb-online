<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::all();
        return view('profiles.index', compact('profiles'));
    }

    public function create()
    {
        // Redirect to edit if profile exists, otherwise show create form
        $profile = Profile::first();
        if ($profile) {
            return redirect()->route('admin.profiles.edit', $profile->id);
        }

        return view('profiles.create');
    }

    public function show($id = null)
    {
        // Always show the school profile
        $profile = Profile::getSchoolProfile();
        if ($profile->id) {
            return view('profiles.show', compact('profile'));
        }
        
        return redirect()->route('admin.profiles.create')
                         ->with('info', 'Silakan buat profil sekolah terlebih dahulu.');
    }

    public function edit($id = null)
    {
        $profile = Profile::getSchoolProfile();
        return view('profiles.edit', compact('profile'));
    }

    public function store(Request $request)
    {
        $data = $request->only(['history', 'vision', 'mission', 'accreditation']);

        // Filter empty mission points
        if (isset($data['mission']) && is_array($data['mission'])) {
            $data['mission'] = array_filter($data['mission'], function($item) {
                return !empty(trim($item));
            });
            $data['mission'] = array_values($data['mission']); // Reindex array
        }

        // handle org chart upload
        if ($request->hasFile('org_chart')) {
            $file = $request->file('org_chart');
            $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $destination = public_path('images/profile');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $data['org_chart_path'] = 'images/profile/' . $filename;
        }

        // facilities expected as JSON array of {name, image_file(optional)}
        $facilities = $request->input('facilities', []);
        $savedFacilities = [];
        if (is_array($facilities)) {
            foreach ($facilities as $i => $facility) {
                $entry = [
                    'name' => $facility['name'] ?? null,
                    'image' => $facility['image'] ?? null,
                ];
                // if a file was uploaded for this facility it should be named facilities[{i}][image_file]
                $fileKey = "facilities.{$i}.image_file";
                if ($request->hasFile("facilities.{$i}.image_file")) {
                    $file = $request->file("facilities.{$i}.image_file");
                    $filename = Str::slug(($entry['name'] ?? 'facility')) . '-' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('images/profile'), $filename);
                    $entry['image'] = 'images/profile/' . $filename;
                }
                $savedFacilities[] = $entry;
            }
        }
        if (!empty($savedFacilities)) {
            $data['facilities'] = $savedFacilities;
        }

        $profile = Profile::updateOrCreateProfile($data);
        return redirect()->route('admin.profiles.index')->with('success', 'Profil sekolah berhasil disimpan');
    }

    public function update(Request $request, $id = null)
    {
        $data = $request->only(['history', 'vision', 'mission', 'accreditation']);

        // Filter empty mission points
        if (isset($data['mission']) && is_array($data['mission'])) {
            $data['mission'] = array_filter($data['mission'], function($item) {
                return !empty(trim($item));
            });
            $data['mission'] = array_values($data['mission']); // Reindex array
        }

        if ($request->hasFile('org_chart')) {
            $file = $request->file('org_chart');
            $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $destination = public_path('images/profile');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $data['org_chart_path'] = 'images/profile/' . $filename;
        }

        // Handle facilities update
        $facilities = $request->input('facilities', []);
        $savedFacilities = [];
        if (is_array($facilities)) {
            foreach ($facilities as $i => $facility) {
                $entry = [
                    'name' => $facility['name'] ?? null,
                    'image' => $facility['image'] ?? null,
                ];
                
                if ($request->hasFile("facilities.{$i}.image_file")) {
                    $file = $request->file("facilities.{$i}.image_file");
                    $filename = Str::slug(($entry['name'] ?? 'facility')) . '-' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('images/profile'), $filename);
                    $entry['image'] = 'images/profile/' . $filename;
                }
                $savedFacilities[] = $entry;
            }
            $data['facilities'] = $savedFacilities;
        }

        $profile = Profile::updateOrCreateProfile($data);
        return redirect()->route('admin.profiles.index')->with('success', 'Profil sekolah berhasil diperbarui');
    }
}
