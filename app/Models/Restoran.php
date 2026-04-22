<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restoran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'slug',
        'alamat',
        'kota',
        'deskripsi',
        'jam_operasional',
        'kontak',
        'gambar',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
