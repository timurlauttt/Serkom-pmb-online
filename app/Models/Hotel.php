<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'slug',
        'alamat',
        'kota',
        'deskripsi',
        'harga_mulai',
        'kontak',
        'gambar',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
