<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $table = 'fasilitas';

    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'gambar',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
