<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Easypaisa extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_name',
        'payment',
        'transaction_reference',
        'status',
        'phone',
    ];
}
