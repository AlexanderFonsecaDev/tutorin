<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    public function profiles()
    {
        return $this->belongsToMany(Profile::class)->withTimestamps();
    }
}
