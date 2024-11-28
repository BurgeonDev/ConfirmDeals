<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedbacks'; // Explicitly define the table name

    use HasFactory;

    protected $fillable = [
        'ad_id',
        'name',
        'email',
        'comments',
    ];

    public function ad()
    {
        return $this->belongsTo(Ad::class);
    }
}
