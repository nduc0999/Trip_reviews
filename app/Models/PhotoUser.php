<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhotoUser extends Model
{
    protected $guarded = [];

    public function Post(){
        return $this->belongsTo(Post::class,'id_post');
    }

    public function PostPhoto(){
        return $this->belongsTo(PostPhoto::class,'id_postphoto');
    }
}
