<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $guarded = [];

    public function Photo(){
        return $this->belongsTo(Post::class,'id_post');
    }
}
