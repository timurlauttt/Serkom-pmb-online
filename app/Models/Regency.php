<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Regency extends Model
{
    protected $fillable = ['name', 'code', 'province_id'];

    public function province(): BelongsTo
    {
        return $this->belongsTo(Provinces::class);
    }

    public function casisbas(): HasMany
    {
        return $this->hasMany(Casisbas::class, 'tempat_lahir_negara');
    }
}
