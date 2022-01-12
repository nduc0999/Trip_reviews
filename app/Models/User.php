<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
        return $this->belongsToMany(Review::class,'like_review','id_user','id_review')->withTimestamps();
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

    public function isAdmin(){
        if($this->role == 1){
            return true;
        }
        return false;
    }

    public function changeAvatar($avatar){
        if($this->img_avatar != null){
            preg_match('/id=(.+)&/', $this->img_avatar, $arr);
            $delete_avatar =  collect(Storage::disk('avatar_user')->listContents('/', false))->where('path', '=', $arr[1])->first();
            Storage::disk('avatar_user')->delete($delete_avatar);
        }

        $name_avatar = time() . '-' . $this->fullName() . '-avatar';
        $data_avatar = File::get($avatar);
        $a = Storage::disk('avatar_user')->put($name_avatar, $data_avatar);
        $url_avatar = Storage::disk('avatar_user')->url($name_avatar);
        $this->img_avatar = $url_avatar;

        return $url_avatar;
    }
    
    public function changeWall($wall){
        if($this->img_wall != null){
            preg_match('/id=(.+)&/', $this->img_wall, $arr);
            $delete_wall =  collect(Storage::disk('wall_user')->listContents('/', false))->where('path', '=', $arr[1])->first();
            Storage::disk('wall_user')->delete($delete_wall);
        }

        $name_wall = time() . '-' . $this->fullName() . '-wall';
        $data_wall = File::get($wall);
        $b = Storage::disk('wall_user')->put($name_wall, $data_wall);
        $url_wall = Storage::disk('wall_user')->url($name_wall);
        $this->img_wall = $url_wall;

        return true;
    }
}
