<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{

    protected $guarded = [];

    public function User(){
        return $this->belongsTo(User::class,'id_user');
    }

    public function Post(){
        return $this->belongsToMany(Post::class,'post_travel','id_travel','id_post');
    }
}
