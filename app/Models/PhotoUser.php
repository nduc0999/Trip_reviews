<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PhotoUser extends Model
{
    protected $guarded = [];

    public function Post(){
        return $this->belongsTo(Post::class,'id_post');
    }

    public function PostPhoto(){
        return $this->belongsTo(PostPhoto::class,'id_postphoto');
    }

    public static function deletePhotoUser($postPhoto){

        foreach($postPhoto as $photo){
            preg_match('/id=(.+)&/', $photo->path, $arr);
            $delete_photo =  collect(Storage::disk('photo_user')->listContents('/', false))->where('path', '=', $arr[1])->first();
            Storage::disk('photo_user')->delete($delete_photo);
        
            PhotoUser::find($photo->id)->delete();
        }
        return true;   
    }
}
