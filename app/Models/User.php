<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected static function booted()
    {
        parent::boot();
        static::saving(function ($user) {
            if (!is_null($user->email_verified_at)) {
                $user->is_email_verified = 1;
            }
        });
        static::created(function ($user) {
            $user->assignRole('user');
        });
    }
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'password',
        'is_active',
        'is_email_verified',
        'coins',
        'rating',
        'profession_id',
        'provider_name',
        'provider_id',
        'country_id',
        'city_id',
        'locality_id',

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_email_verified' => 'boolean',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }

    public function ads()
    {
        return $this->hasMany(Ad::class);
    }
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    public function bid()
    {
        return $this->hasMany(Bid::class)->where('status', 'pending');
    }
    // User Model
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
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'user_id');
    }
}
