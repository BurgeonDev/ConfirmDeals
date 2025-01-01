<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

        // Optionally, if you want to set the user_id when updating as well
        // static::updating(function ($ad) {
        //     if (Auth::check()) {
        //         $ad->user_id = Auth::id(); // Update the user_id if necessary
        //     }
        // });
    }
    protected $fillable = [
        'title',
        'description',
        'type',
        'is_verified',
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
        'is_verified' => 'boolean',
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
