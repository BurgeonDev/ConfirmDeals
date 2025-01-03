<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coin extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'price_in_pkr',
        'equivalence',
        'free_coins',
        'featured_ad_rate',
        'created_by',
        'updated_by',
    ];

    /**
     * Relationships
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
