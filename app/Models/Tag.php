<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name'
    ];

    public function taks()
    {
        return $this->morphedByMany(Task::class, 'taggable');
    }

}
