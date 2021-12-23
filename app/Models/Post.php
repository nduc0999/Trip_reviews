<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
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

    public function uploadPhoto($photo,$notes){


        foreach ($photo as $i) {
            $name = time().'-'.$this->name;
            $data = File::get($i);
            $a = Storage::disk('photo')->put($name, $data);
            $url = Storage::disk('photo')->url($name);

            $photoName = $i->getClientOriginalName();
            $note = '\'' . $photoName . '\'';
            
            $pt = Photo::create(['id_post' => $this->id,'note' => $notes[$note] ,'path' => $url]);
        }
        return true;
    }

    public function getReview(){
       $arr = array();
        $reviews = Review::where('id_post',$this->id)->where('status',0)
            ->with(array('user' => function ($query) {$query->select('id', 'first_name','last_name','img_avatar');},
                        'likereview' => function ($query) {$query->select('id_user');} ))->orderBy('id','DESC')->paginate(1, ['*'], 'review');
        foreach($reviews as $review){
                foreach($review->likereview as $like){
                    if($like->id_user == Auth::id()){
                        $review->setAttribute('like', true);
                        break 1;
                    }else{
                        $review->setAttribute('like', false);
                    };
                   
                }

        }

        return $reviews;
    }

    public static function setInfoPost($posts){
      
        foreach($posts as $post){
            $rate = 0;
            $rate_service = 0;
            $rate_value = 0;
            $rate_sleep = 0;
            foreach($post->review as $review){
                $rate += $review->rate;
                $rate_service += $review->rate_service;
                $rate_value += $review->rate_value;
                $rate_sleep += $review->rate_sleep;
            }
            $count = count($post->review);
            if($count > 0){
                $avg_rate = round($rate/$count,1);
                $avg_rate_service = round($rate_service/$count,1);
                $avg_rate_value = round($rate_value/$count,1);
                $avg_rate_sleep = round($rate_sleep / $count, 1);
                $post->setAttribute('avg_rate', $avg_rate);
                $post->setAttribute('avg_rate_service', $avg_rate_service);
                $post->setAttribute('avg_rate_value', $avg_rate_value);
                $post->setAttribute('avg_rate_sleep', $avg_rate_sleep);
                $post->setAttribute('count_review',$count);

            }else{
                $post->setAttribute('avg_rate', 0);
                $post->setAttribute('avg_rate_service', 0);
                $post->setAttribute('avg_rate_value',0);
                $post->setAttribute('avg_rate_sleep', 0);
                $post->setAttribute('count_review', 0);
            }
        }

        return $posts;
        
    }
}
