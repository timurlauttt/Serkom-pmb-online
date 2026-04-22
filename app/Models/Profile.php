<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'history',
        'vision',
        'mission',
        'org_chart_path',
        'facilities',
        'accreditation',
    ];

    protected $casts = [
        'facilities' => 'array',
        'mission' => 'array',
    ];

    /**
     * Get the singleton profile instance or create one if it doesn't exist
     */
    public static function getSchoolProfile()
    {
        return static::first() ?: new static();
    }

    /**
     * Update or create the school profile (ensure only one exists)
     */
    public static function updateOrCreateProfile($data)
    {
        $profile = static::first();
        
        if ($profile) {
            $profile->update($data);
            return $profile;
        }
        
        return static::create($data);
    }
}
