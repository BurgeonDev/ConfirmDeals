<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $fillable = [
        'user_id',
        'ad_id',
        'offer',
        'status',
        'user_paid',
        'seller_paid'
    ];

    public function ads()
    {
        return $this->belongsTo(Ad::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id',);
    }
    public function ad()
    {
        return $this->belongsTo(Ad::class);
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
}
