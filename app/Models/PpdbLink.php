<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbLink extends Model
{
    protected $fillable = [
        'nama_link',
        'url',
        'jenis',
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

    public function scopeByJenis($query, $jenis)
    {
        return $query->where('jenis', $jenis);
    }
}
