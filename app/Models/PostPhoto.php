<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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

    public function savePhoto($photos, $description, $post){
    
        foreach ($photos as $i) {
            $photoName = $i->getClientOriginalName();
            $fileName = '\'' . $photoName . '\'';

            $p = Post::find($post[$fileName]);
            $name = time() . '-' . $p->name;
            $data = File::get($i);
            $a = Storage::disk('photo_user')->put($name, $data);
            $url = Storage::disk('photo_user')->url($name);

         
            $pt = PhotoUser::create(['id_post' => $post[$fileName],'id_postphoto' => $this->id ,'description' => $description[$fileName], 'path' => $url]);
        }
        return true;
    }
}
