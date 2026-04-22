<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjekWisata extends Model
{
    use HasFactory;

    protected $table = 'objek_wisata';

    protected $fillable = [
        'nama',
        'slug',
        'alamat',
        'kota',
        'deskripsi',
        'harga_tiket',
        'jam_operasional',
        'gambar',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function paketWisata()
    {
        return $this->belongsToMany(PaketWisata::class, 'paket_wisata_objek', 'id_objek_wisata', 'id_paket');
    }
}
