<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'image_path',
        'start_date',
        'end_date',
        'location',
        'organizer',
        'category',
        'jurusan_id',
        'is_featured',
        'status',
    ];
    // Relasi ke Jurusan (opsional)
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_featured' => 'boolean',
        'status' => 'string',
    ];

    // Scope untuk event yang aktif
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Scope untuk event mendatang
    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>=', now());
    }

    // Scope untuk event featured
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Accessor untuk mendapatkan excerpt description
    public function getExcerptAttribute()
    {
        return \Illuminate\Support\Str::limit(strip_tags($this->description ?? ''), 100);
    }

    /**
     * Accessor untuk image dengan fallback
     */
    public function getImageAttribute($value)
    {
        return $value ?? asset('images/front-end-img/courses/1.jpg');
    }

    /**
     * Accessor to return a usable image URL for the event.
     * Checks `image_path` first, then `image`, checks public and storage paths,
     * and falls back to a default asset.
     */
    public function getImageUrlAttribute()
    {
        $default = asset('images/front-end-img/courses/1.jpg');

        $candidates = [];
        if (!empty($this->image_path)) {
            $candidates[] = ltrim($this->image_path, '/');
        }
        if (!empty($this->image)) {
            $candidates[] = ltrim($this->image, '/');
        }

        foreach ($candidates as $path) {
            if (file_exists(public_path($path))) {
                return asset($path);
            }
            if (file_exists(public_path('storage/' . $path))) {
                return asset('storage/' . $path);
            }
        }

        return $default;
    }

    /**
     * Gunakan kolom slug untuk route model binding (public facing routes)
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
