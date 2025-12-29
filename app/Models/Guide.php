<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Guide extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($guide) {
            if (empty($guide->slug)) {
                $guide->slug = Str::slug($guide->name);
            }
        });

        static::updating(function ($guide) {
            if ($guide->isDirty('name') && empty($guide->slug)) {
                $guide->slug = Str::slug($guide->name);
            }
        });
    }

    protected $fillable = [
        'name',
        'name_en',
        'slug',
        'email',
        'phone',
        'bio',
        'bio_en',
        'specialties',
        'specialties_en',
        'experience_years',
        'languages',
        'certifications',
        'profile_image',
        'is_active',
        'rating',
        'total_trips'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'experience_years' => 'integer',
        'total_trips' => 'integer',
        'rating' => 'decimal:1',
        'specialties' => 'array',
        'specialties_en' => 'array',
        'languages' => 'array',
        'certifications' => 'array'
    ];

    /**
     * Get the trips for the guide
     */
    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    /**
     * Scope a query to only include active guides
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get the guide's average rating
     */
    public function getAverageRating()
    {
        return $this->trips()->with('reviews')->get()
            ->pluck('reviews')->flatten()
            ->avg('rating') ?? 0;
    }

    /**
     * Get localized attributes
     */
    public function getLocalizedNameAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'en' && $this->name_en ? $this->name_en : $this->name;
    }

    public function getLocalizedBioAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'en' && $this->bio_en ? $this->bio_en : $this->bio;
    }

    public function getLocalizedSpecialtiesAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'en' && $this->specialties_en ? $this->specialties_en : $this->specialties;
    }
}
