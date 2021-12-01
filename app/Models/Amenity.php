<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    protected $guarded = [];

    public function Post(){
        return $this->belongsToMany(Post::class,'amenity_post','id_amenity','id_post');
    }
}
