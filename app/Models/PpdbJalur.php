<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PpdbJalur extends Model
{
    protected $fillable = [
        'nama_jalur',
        'deskripsi',
        'kuota',
        'tanggal_mulai',
        'tanggal_selesai',
        'is_active',
        'order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'kuota' => 'integer',
        'order' => 'integer',
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    public function scopeOpen($query)
    {
        $today = Carbon::today();
        return $query->where('is_active', true)
                     ->where('tanggal_mulai', '<=', $today)
                     ->where('tanggal_selesai', '>=', $today);
    }

    public function isOpen()
    {
        $today = Carbon::today();
        return $this->is_active && 
               $this->tanggal_mulai <= $today && 
               $this->tanggal_selesai >= $today;
    }
}
