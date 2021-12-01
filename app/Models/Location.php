<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $guarded = [];

    public function Post()
    {
        return $this->hasMany(Post::class,'id_location');
    }
}
