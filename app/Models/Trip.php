<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Trip extends Model
{
    use HasFactory, SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($trip) {
            if (empty($trip->slug)) {
                $trip->slug = Str::slug($trip->title);
            }
        });

        static::updating(function ($trip) {
            if ($trip->isDirty('title') && empty($trip->slug)) {
                $trip->slug = Str::slug($trip->title);
            }
        });
    }

    protected $fillable = [
        'title',
        'title_en',
        'slug',
        'description',
        'description_en',
        'short_description',
        'short_description_en',
        'price',
        'duration',
        'difficulty_level',
        'max_participants',
        'min_participants',
        'start_date',
        'end_date',
        'location',
        'location_en',
        'meeting_point',
        'meeting_point_en',
        'category_id',
        'guide_id',
        'is_featured',
        'is_active',
        'has_story',
        'type',
        'images',
        'included_items',
        'included_items_en',
        'excluded_items',
        'excluded_items_en',
        'requirements',
        'requirements_en',
        'cancellation_policy',
        'cancellation_policy_en',
        'rating',
        'total_bookings',
        'meta_title',
        'meta_title_en',
        'meta_description',
        'meta_description_en',
        'meta_keywords',
        'meta_keywords_en'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'has_story' => 'boolean',
        'images' => 'array',
        'included_items' => 'array',
        'included_items_en' => 'array',
        'excluded_items' => 'array',
        'excluded_items_en' => 'array',
        'requirements' => 'array',
        'requirements_en' => 'array',
        'price' => 'decimal:2',
        'rating' => 'decimal:1',
        'total_bookings' => 'integer',
        'max_participants' => 'integer',
        'min_participants' => 'integer'
    ];

    protected $dates = [
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Get the category that owns the trip
     */
    public function category()
    {
        return $this->belongsTo(TripCategory::class);
    }

    /**
     * Get the guide that owns the trip
     */
    public function guide()
    {
        return $this->belongsTo(Guide::class);
    }

    /**
     * Get the bookings for the trip
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get the reviews for the trip
     */
    public function reviews()
    {
        return $this->hasMany(TripReview::class);
    }

    /**
     * Scope a query to only include featured trips
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to only include active trips
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include upcoming trips
     */
    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>=', now());
    }

    /**
     * Scope a query to filter by category
     */
    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    /**
     * Scope a query to filter by price range
     */
    public function scopeByPriceRange($query, $min, $max)
    {
        return $query->whereBetween('price', [$min, $max]);
    }

    /**
     * Scope a query to filter by difficulty level
     */
    public function scopeByDifficulty($query, $difficulty)
    {
        return $query->where('difficulty_level', $difficulty);
    }

    /**
     * Scope a query to filter by location
     */
    public function scopeByLocation($query, $location)
    {
        return $query->where('location', 'like', "%{$location}%");
    }

    /**
     * Scope a query to search trips
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhere('location', 'like', "%{$search}%");
        });
    }

    /**
     * Get the trip's main image
     */
    public function getMainImageAttribute()
    {
        $images = $this->images;
        return $images && count($images) > 0 ? $images[0] : 'images/default-trip.jpg';
    }

    /**
     * Get the trip's formatted price
     */
    public function getFormattedPriceAttribute()
    {
        $currency = app()->getLocale() === 'en' ? ' SAR' : ' ريال';
        return number_format($this->price, 0) . $currency;
    }

    /**
     * Get the trip's duration in a readable format
     */
    public function getFormattedDurationAttribute()
    {
        $locale = app()->getLocale();
        if ($locale === 'en') {
            return $this->duration <= 1 ? $this->duration . ' day' : $this->duration . ' days';
        } else {
            return $this->duration <= 1 ? $this->duration . ' يوم' : $this->duration . ' أيام';
        }
    }

    /**
     * Get the trip's availability status
     */
    public function getAvailabilityStatusAttribute()
    {
        $locale = app()->getLocale();
        if ($this->start_date < now()) {
            return $locale === 'en' ? 'Completed' : 'مكتمل';
        } elseif ($this->total_bookings >= $this->max_participants) {
            return $locale === 'en' ? 'Completed' : 'مكتمل';
        } else {
            return $locale === 'en' ? 'Available' : 'متاح';
        }
    }

    /**
     * Get the trip's remaining spots
     */
    public function getRemainingSpotsAttribute()
    {
        return max(0, $this->max_participants - $this->total_bookings);
    }

    /**
     * Check if the trip is available for booking
     */
    public function isAvailableForBooking()
    {
        return $this->is_active && 
               $this->start_date > now();
    }

    /**
     * Get the trip's average rating
     */
    public function getAverageRating()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    /**
     * Get the trip's total reviews count
     */
    public function getTotalReviewsCount()
    {
        return $this->reviews()->count();
    }

    /**
     * Increment the total bookings count
     */
    public function incrementBookings()
    {
        $this->increment('total_bookings');
    }

    /**
     * Decrement the total bookings count
     */
    public function decrementBookings()
    {
        $this->decrement('total_bookings');
    }

    /**
     * Get trips with stories
     */
    public function scopeWithStories($query)
    {
        return $query->where('has_story', true);
    }

    /**
     * Get trips by type
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Get localized attributes
     */
    public function getLocalizedTitleAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'en' && $this->title_en ? $this->title_en : $this->title;
    }

    public function getLocalizedDescriptionAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'en' && $this->description_en ? $this->description_en : $this->description;
    }

    public function getLocalizedShortDescriptionAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'en' && $this->short_description_en ? $this->short_description_en : $this->short_description;
    }

    public function getLocalizedLocationAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'en' && $this->location_en ? $this->location_en : $this->location;
    }

    public function getLocalizedMeetingPointAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'en' && $this->meeting_point_en ? $this->meeting_point_en : $this->meeting_point;
    }

    public function getLocalizedCancellationPolicyAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'en' && $this->cancellation_policy_en ? $this->cancellation_policy_en : $this->cancellation_policy;
    }

    public function getLocalizedIncludedItemsAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'en' && $this->included_items_en ? $this->included_items_en : $this->included_items;
    }

    public function getLocalizedExcludedItemsAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'en' && $this->excluded_items_en ? $this->excluded_items_en : $this->excluded_items;
    }

    public function getLocalizedRequirementsAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'en' && $this->requirements_en ? $this->requirements_en : $this->requirements;
    }
}
