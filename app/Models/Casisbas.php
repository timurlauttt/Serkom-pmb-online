<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Provinces;
use App\Models\Regency;
use App\Models\Religion;

class Casisbas extends Authenticatable
{
    protected $fillable = [
        'nama_lengkap',
        'no_hp',
        'password',
        'alamat_ktp',
        'alamat_saat_ini',
        'kecamatan',
        'kabupaten_id',
        'provinsi_id',
        'nomor_telepon',
        'kewarganegaraan',
        'negara_wna',
        'tanggal_lahir',
        'tempat_lahir',
        'tempat_lahir_provinsi_id',
        'tempat_lahir_kabupaten_id',
        'tempat_lahir_negara',
        'jenis_kelamin',
        'status_menikah',
        'religion_id',
        'email',
        'status_penerimaan',
        'catatan_penerimaan',
    ];
    // Relasi ke tabel referensi

    public function provinsi()
    {
        return $this->belongsTo(Provinces::class, 'provinsi_id');
    }

    public function tempatLahirProvinsi()
    {
        return $this->belongsTo(Provinces::class, 'tempat_lahir_provinsi_id');
    }

    public function tempatLahirKabupaten()
    {
        return $this->belongsTo(Regency::class, 'tempat_lahir_kabupaten_id');
    }

    public function kabupaten()
    {
        return $this->belongsTo(Regency::class, 'kabupaten_id');
    }
    public function agama()
    {
        return $this->belongsTo(Religion::class, 'religion_id');
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
