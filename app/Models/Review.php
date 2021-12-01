<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded = [];

    public function User(){
        return $this->belongsTo(User::class,'id_user');
    }

    public function LikeReview(){
        return $this->belongsToMany(User::class,'like_review','id_review','id_user');
    }

    public function Post(){
        return $this->belongsTo(Post::class,'id_post');
    }

    public function Answer(){
        return $this->hasMany(Answer::class,'id_review');
    }
}
