<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'subjects',
        'prospects',
        'photo_title',
        'photo_path',
        'photo_path_2',
        'photo_path_3',
        'partners',
        'spp_fee',
        'certifications',
    ];

    protected $casts = [
        'subjects' => 'array',
        'prospects' => 'array',
        'partners' => 'array',
        'certifications' => 'array',
        'spp_fee' => 'decimal:2',
    ];

    /**
     * Accessor untuk mendapatkan URL gambar jurusan dengan fallback
     */
    public function getImageUrlAttribute()
    {
        // Default fallback image berdasarkan ID
        $defaultImage = asset('images/gallery/thumb/' . ($this->id ?? 1) . '.jpg');

        if (!$this->photo_path) {
            return $defaultImage;
        }

        // Cek apakah file exists di public path
        if (file_exists(public_path($this->photo_path))) {
            return asset($this->photo_path);
        }

        // Atau cek di storage path
        if (file_exists(public_path('storage/' . $this->photo_path))) {
            return asset('storage/' . $this->photo_path);
        }

        return $defaultImage;
    }

    /**
     * Get all image URLs (main + 2 additional)
     */
    public function getImageUrlsAttribute()
    {
        $urls = [];
        foreach (['photo_path', 'photo_path_2', 'photo_path_3'] as $col) {
            $path = $this->{$col};
            if ($path && (file_exists(public_path($path)) || file_exists(public_path('storage/' . $path)))) {
                $urls[] = asset(file_exists(public_path($path)) ? $path : 'storage/' . $path);
            } else {
                $urls[] = asset('images/gallery/thumb/' . ($this->id ?? 1) . '.jpg');
            }
        }
        return $urls;
    }

    /**
     * Accessor untuk mendapatkan excerpt description
     */
    public function getShortDescriptionAttribute()
    {
        return \Illuminate\Support\Str::limit($this->description ?? '', 100);
    }

    /**
     * Gunakan slug untuk route model binding di rute publik.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Relasi ke Berita
     */
    public function beritas()
    {
        return $this->hasMany(\App\Models\Berita::class, 'jurusan_id');
    }

    /**
     * Relasi ke Event
     */
    public function events()
    {
        return $this->hasMany(\App\Models\Event::class, 'jurusan_id');
    }

    /**
     * Relasi ke Galeri
     */
    public function galleries()
    {
        return $this->hasMany(\App\Models\Galeri::class, 'jurusan_id');
    }
}
