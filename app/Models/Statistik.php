<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistik extends Model
{
    protected $fillable = [
        'key',
        'label',
        'value',
        'description',
        'icon',
        'color',
        'is_active',
    ];

    protected $casts = [
        'value' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Get statistik by key
     */
    public static function getByKey($key)
    {
        return static::where('key', $key)->where('is_active', true)->first();
    }

    /**
     * Get all active statistik
     */
    public static function getActive()
    {
        return static::where('is_active', true)->orderBy('id')->get();
    }

    /**
     * Update or create statistik
     */
    public static function updateOrCreateStat($key, $data)
    {
        return static::updateOrCreate(
            ['key' => $key],
            $data
        );
    }
}
