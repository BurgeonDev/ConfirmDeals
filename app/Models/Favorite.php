<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends BaseModel
{
    protected $fillable = ['user_id', 'ad_id'];
    public function ad()
    {
        return $this->belongsTo(Ad::class);
    }
}
