<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Post(){
        return $this->hasMany(Post::class,'id_user');
    }

    public function Review(){
        return $this->hasMany(Review::class,'id_user');
    }

    public function LikeReview(){
        return $this->belongsToMany(Review::class,'like_review','id_user','id_review');
    }

    public function Travel(){
        return $this->hasMany(Travel::class,'id_user');
    }

    public function PostPhoto(){
        return $this->hasMany(PostPhoto::class, 'id_user');
    }

    public function LikePostPhoto(){
        return $this->belongsToMany(PostPhoto::class,'like_postphoto','id_user','id_postphoto');
    }

    public function fullName()
    {
        return $this->first_name . " " . $this->last_name;
    }
}
