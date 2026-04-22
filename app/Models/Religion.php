<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Religion extends Model
{
    protected $fillable = ['name', 'code'];

    public function casisbas(): HasMany
    {
        return $this->hasMany(Casisbas::class);
    }
}
