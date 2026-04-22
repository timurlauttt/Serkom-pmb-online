<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketWisata extends Model
{
    use HasFactory;

    protected $table = 'paket_wisata';

    protected $fillable = [
        'nama_paket',
        'slug',
        'kategori',
        'durasi_hari',
        'harga',
        'akomodasi',
        'objek_wisata',
        'keterangan',
        'gambar',
    ];

    protected $casts = [
        'akomodasi' => 'array',
        'objek_wisata' => 'array',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
