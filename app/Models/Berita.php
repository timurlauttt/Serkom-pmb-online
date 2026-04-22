<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Berita extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'image_path',
        'author',
        'category',
        'jurusan_id',
        'posted_at',
        'hashtags',
        'is_featured',
        'status',
    ];
    // Relasi ke Jurusan (opsional)
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    protected $casts = [
        'posted_at' => 'datetime',
        'hashtags' => 'array',
        'is_featured' => 'boolean',
        'status' => 'string',
    ];

    // Accessor untuk mendapatkan excerpt
    public function getExcerptAttribute()
    {
        return \Illuminate\Support\Str::limit(strip_tags($this->content ?? ''), 100);
    }

    /**
     * Accessor untuk mendapatkan short title
     */
    public function getShortTitleAttribute()
    {
        return \Illuminate\Support\Str::limit($this->title ?? '', 60);
    }

    /**
     * Accessor untuk formatted date
     */
    public function getFormattedDateAttribute()
    {
        return optional($this->posted_at)->format('d M Y') ?? optional($this->created_at)->format('d M Y');
    }

    /**
     * Accessor to return a usable image URL for the berita.
     * Checks `image_path` first, then `image`, checks public and storage paths,
     * and falls back to a default asset.
     */
    public function getImageUrlAttribute()
    {
        $default = asset('images/front-end-img/courses/4.jpg');

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

    // Scope untuk berita terbaru
    public function scopeLatest($query)
    {
        return $query->orderBy('posted_at', 'desc')->orderBy('created_at', 'desc');
    }

    // Scope untuk filter berdasarkan kategori
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Scope untuk berita featured (hero slider)
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Gunakan kolom slug untuk route model binding (hanya untuk route publik)
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
