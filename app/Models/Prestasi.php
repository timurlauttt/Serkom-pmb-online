<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Prestasi extends Model
{
    protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
        'tingkat',
        'peringkat',
        'penyelenggara',
        'tahun',
        'thumbnail',
        'jurusan_id',
        'nama_siswa',
        'is_featured'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'tahun' => 'integer'
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($prestasi) {
            if (empty($prestasi->slug)) {
                $prestasi->slug = Str::slug($prestasi->judul);
            }
        });
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByTingkat($query, $tingkat)
    {
        return $query->where('tingkat', $tingkat);
    }
}
