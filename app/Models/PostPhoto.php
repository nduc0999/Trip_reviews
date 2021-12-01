<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostPhoto extends Model
{
    protected $guarded = [];

    public function User(){
        return $this->belongsTo(User::class,'id_user');
    }

    public function LikePostPhoto()
    {
        return $this->belongsToMany(User::class,'like_postphoto','id_postphoto','id_user');
    }

    public function PhotoUser(){
        return $this->hasMany(PhotoUser::class,'id_postphoto');
    }
}
