<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $guarded = [];

    public function User(){
        return $this->belongsTo(User::class,'id_user');
    }

    public function Roomtype()
    {
        return $this->belongsToMany(Roomtype::class,'roomtype_post','id_post','id_roomtype');
    }

    public function Amenity()
    {
        return $this->belongsToMany(Amenity::class,'amenity_post','id_post','id_amenity');
    }

    public function Location(){
        return $this->belongsTo(Location::class,'id_location');
    }

    public function Photo(){
        return $this->hasMany(Photo::class,'id_post');
    }


    public function Review(){
        return $this->hasMany(Review::class,'id_post');
    }

    public function Travel(){
        return $this->belongsToMany(Travel::class,'post_travel','id_post','id_travel');
    }

    public function PhotoUser(){
        return $this->hasMany(PhotoUser::class,'id_post');
    }
}
