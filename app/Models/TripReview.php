<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'trip_id',
        'user_id',
        'rating',
        'title',
        'comment',
        'is_verified',
        'is_approved'
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_verified' => 'boolean',
        'is_approved' => 'boolean'
    ];

    /**
     * Get the trip that owns the review
     */
    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    /**
     * Get the user that owns the review
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include approved reviews
     */
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    /**
     * Scope a query to only include verified reviews
     */
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }
}
