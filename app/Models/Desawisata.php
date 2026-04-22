<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desawisata extends Model
{
    use HasFactory;

    protected $table = 'desawisata';

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
        return $this->belongsToMany(PaketWisata::class, 'paket_wisata_desa', 'id_desawisata', 'id_paket');
    }
}
