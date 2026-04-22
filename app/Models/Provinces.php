<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Provinces extends Model
{
    protected $fillable = ['name', 'code'];

    public function regencies(): HasMany
    {
        return $this->hasMany(Regency::class);
    }

    public function casisbas(): HasMany
    {
        return $this->hasMany(Casisbas::class, 'provinsi');
    }
    
}
