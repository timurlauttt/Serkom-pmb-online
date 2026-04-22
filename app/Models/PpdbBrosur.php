<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbBrosur extends Model
{
    protected $fillable = [
        'judul',
        'file_path',
        'path_gambar_brosur',
        'tahun_ajaran',
        'deskripsi',
        'is_active',
        'order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }
}
