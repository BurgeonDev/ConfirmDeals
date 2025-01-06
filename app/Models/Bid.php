<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ad_id',
        'offer',
        'status',
        'user_paid',
        'seller_paid',
        'notes',
        'time_slots',
        // 'created_by',
        // 'updated_by'
    ];

    /**
     * Relationships
     */

    // Bid belongs to a user (bidder)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Bid belongs to an ad
    public function ad()
    {
        return $this->belongsTo(Ad::class, 'ad_id');
    }

    // Optionally, if ads are categorized by country
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    // Optionally, if ads are categorized by city
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // Optionally, if ads are categorized by locality
    public function locality()
    {
        return $this->belongsTo(Locality::class);
    }

    /**
     * Accessors and Mutators
     */

    // Decode `time_slots` JSON into an array when accessing
    public function getTimeSlotsAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    // Encode `time_slots` array into JSON when saving
    public function setTimeSlotsAttribute($value)
    {
        $this->attributes['time_slots'] = $value ? json_encode($value) : null;
    }

    /**
     * Scopes
     */

    // Scope for filtering by status
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Scope for filtering by ad
    public function scopeByAd($query, $adId)
    {
        return $query->where('ad_id', $adId);
    }

    // Scope for filtering by user
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
