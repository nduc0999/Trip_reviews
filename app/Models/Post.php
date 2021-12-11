<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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

    public function upAvatarWall($avatar, $wall){
        $name_avatar = time() . '-' . $this->name.'-avatar';
        $data_avatar = File::get($avatar);
        $a = Storage::disk('avatar')->put($name_avatar, $data_avatar);
        $url_avatar = Storage::disk('avatar')->url($name_avatar);
        $this->img_avatar = $url_avatar;

        $name_wall = time() . '-' . $this->name .'-wall';
        $data_wall = File::get($wall);
        $b = Storage::disk('wall')->put($name_wall, $data_wall);
        $url_wall = Storage::disk('wall')->url($name_wall);
        $this->img_wall = $url_wall;

        return true;
    }

    public function uploadPhoto($photo){

        foreach ($photo as $i) {
            $name = time().'-'.$this->name;
            $data = File::get($i);
            $a = Storage::disk('photo')->put($name, $data);
            $url = Storage::disk('photo')->url($name);
            $pt = Photo::create(['id_post' => $this->id, 'path' => $url]);
        }
        return true;
    }
}
