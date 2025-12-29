<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'trip_id',
        'user_id',
        'phone_number',
        'participants_count',
        'total_amount',
        'booking_date',
        'status',
        'payment_status',
        'payment_method',
        'notes',
        'emergency_contact',
        'special_requirements'
    ];

    protected $casts = [
        'participants_count' => 'integer',
        'total_amount' => 'decimal:2',
        'booking_date' => 'datetime',
        'emergency_contact' => 'array',
        'special_requirements' => 'array'
    ];

    /**
     * Get the trip that owns the booking
     */
    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    /**
     * Get the user that owns the booking
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to filter by status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to filter by payment status
     */
    public function scopeByPaymentStatus($query, $status)
    {
        return $query->where('payment_status', $status);
    }
}
