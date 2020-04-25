<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Pqr extends Model
{
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
