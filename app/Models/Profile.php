<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $fillable = [
        'dni','description','valoration','message'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function location()
    {
        return $this->hasOne(Location::class);
    }

    public function status()
    {
        return $this->hasOne(ProfileStatus::class);
    }

    public function studies()
    {
        return $this->hasMany(Study::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function files()
    {
        return $this->morphToMany(File::class, 'fileable');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

}
