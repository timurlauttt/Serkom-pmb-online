<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $fillable = [
        'title',
        'album',
        'jurusan_id',
        'path',
        'is_favorite',
        'order',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    /**
     * Accessor untuk mendapatkan URL gambar galeri
     */
    public function getImageUrlAttribute()
    {
        $default = asset('images/gallery/thumb/1.jpg');

        if (empty($this->path)) {
            return $default;
        }

        $path = ltrim($this->path, '/');

        // Check in public directory
        if (file_exists(public_path($path))) {
            return asset($path);
        }

        // Check in storage directory
        if (file_exists(public_path('storage/' . $path))) {
            return asset('storage/' . $path);
        }

        return $default;
    }
}
