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
        return $this->belongsToMany(Post::class,'post_travel','id_travel','id_post')->withTimestamps()->orderBy('pivot_updated_at', 'desc');;
    }

    public static function checkHeart($travels,$id){

        foreach($travels as $travel){
            if(count($travel->post) != 0){
                foreach($travel->post as $post){
                    if($post->id == $id){
                        $travel->setAttribute('heart',true);
                        break 1;
                    }else{
                        $travel->setAttribute('heart', false);
                    }
                }
            }else{
                $travel->setAttribute('heart', false);
            }
        }

        return $travels;

    }
}
