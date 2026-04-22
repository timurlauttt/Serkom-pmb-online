<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumumans'; // Explicitly set table name
    
    protected $fillable = [
        'title',
        'slug',
        'content',
        'posted_at',
        'expires_at',
    ];

    protected $casts = [
        'posted_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    /**
     * Accessor untuk mendapatkan excerpt dari content
     */
    public function getExcerptAttribute()
    {
        return \Illuminate\Support\Str::limit(strip_tags($this->content ?? ''), 140);
    }

    /**
     * Gunakan kolom slug untuk route model binding di rute publik.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
