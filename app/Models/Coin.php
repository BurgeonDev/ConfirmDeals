<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    use HasFactory;

    protected $fillable = ['count', 'from_price', 'to_price'];

    // Example: A method to get the coin price based on the range
    public function getPriceRangeAttribute()
    {
        return "{$this->from_price} - {$this->to_price}";
    }
}
