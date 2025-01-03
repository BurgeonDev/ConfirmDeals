<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends BaseModel
{
    use HasFactory;

    protected $fillable = ['name'];

    // If needed, define relationships
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
