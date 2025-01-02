<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected static function booted()
    {
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
}
