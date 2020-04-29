<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = [
        'name'
    ];

    public function taks()
    {
        return $this->hasMany(Task::class);
    }

    public function profiles()
    {
        return $this->belongsToMany(Profile::class)->withTimestamps();
    }
}
