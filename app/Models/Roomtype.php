<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roomtype extends Model
{

    protected $guarded = [];

    public function Post()
    {
        return $this->belongsToMany(Post::class,'roomtype_post','id_roomtype','id_post');
    }
}
