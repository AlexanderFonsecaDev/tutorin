<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Pqr extends Model
{

    protected $fillable = [
        'user_id','title','description','status'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
