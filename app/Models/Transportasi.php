<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transportasi extends Model
{
    use HasFactory;

    protected $table = 'transportasi';

    protected $fillable = [
        'jenis',
        'nama_provider',
        'slug',
        'harga',
        'kontak',
        'gambar',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
