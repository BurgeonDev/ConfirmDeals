<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class Ad extends Model
{
    use HasFactory;
    protected static function boot()
    {
        parent::boot();

        // Automatically set user_id when creating an ad
        static::creating(function ($ad) {
            if (Auth::check()) {
                $ad->user_id = Auth::id(); // Assign the currently authenticated user's ID
            }
        });

        static::updating(function ($ad) {
            // Check if the featured ad's `featured_until` time has expired
            if ($ad->is_featured && Carbon::now()->greaterThan($ad->featured_until)) {
                // Set `is_featured` to 0 (unfeatured) if the `featured_until` date has passed
                $ad->is_featured = 0;
            }
            // Automatically set the status to 'expired' if the ad is more than 3 months old
            if (Carbon::now()->diffInMonths($ad->updated_at) >= 3 && $ad->status !== 'expired') {
                $ad->status = 'expired';
            }
        });

        // Alternatively, you can run this check when fetching ads in a query:
        static::addGlobalScope('featuredAdsScope', function ($query) {
            $query->where(function ($q) {
                $q->whereNull('featured_until')
                    ->orWhere('featured_until', '>', Carbon::now());
            });
        });
    }
    protected $fillable = [
        'title',
        'description',
        'type',
        'status',
        'pictures',
        'price',
        'country_id',
        'city_id',
        'locality_id',
        'coins_needed',
        'user_id',
        'is_featured',
        'days_featured',
        'category_id',
    ];

    protected $casts = [
        // 'is_verified' => 'boolean',
        'is_featured' => 'boolean',
        'pictures' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function locality()
    {
        return $this->belongsTo(Locality::class);
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'ad_id');
    }
    public function isFavoritedBy($user)
    {
        return $user && $user->favorites()->where('ad_id', $this->id)->exists();
    }
    public function bids()
    {
        return $this->hasMany(Bid::class);
    }
}
