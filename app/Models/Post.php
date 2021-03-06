<?php

namespace App\Models;

use DateTime;
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
                        'likereview' => function ($query) {$query->select('id_user');} ))->orderBy('id','DESC')->paginate(3, ['*'], 'review');
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
            $count_review = 0;
            foreach($post->review as $review){
                if($review->status == 0){
                    $rate += $review->rate;
                    $rate_service += $review->rate_service;
                    $rate_value += $review->rate_value;
                    $rate_sleep += $review->rate_sleep;
                    $count_review++;
                }
            }
            $count = $count_review;
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

            $p = Post::where('id',$post->id)->first();
            $post_travel = $p->travel;
            if(count($post_travel) != 0 and Auth::check()){
                foreach($post_travel as $pt){
                    if($pt->id_user == Auth::id()){
                        $post->setAttribute('heart', 1);
                        break 1;
                    }else{
                        $post->setAttribute('heart', 0);
                    }
                }
            }else{
                $post->setAttribute('heart', 0);
            }
        
        }

        return $posts;
        
    }

    public function getSinglePost(){

        $rate = 0;
        $rate_service = 0;
        $rate_value = 0;
        $rate_sleep = 0;
        if (count($this->travel) != 0 and Auth::check()) {
            foreach ($this->travel as $pt) {
                if ($pt->id_user == Auth::id()) {
                    $this->setAttribute('heart', 1);
                    break 1;
                } else {
                    $this->setAttribute('heart', 0);
                }
            }
        } else {
            $this->setAttribute('heart', 0);
        }
        $reviews = $this->review()->where('status',0)->get();

        foreach ($reviews as $review) {
            $rate += $review->rate;
            $rate_service += $review->rate_service;
            $rate_value += $review->rate_value;
            $rate_sleep += $review->rate_sleep;
        }
        $count = count($reviews);
        if ($count > 0) {
            $avg_rate = round($rate / $count, 1);
            $avg_rate_service = round($rate_service / $count, 1);
            $avg_rate_value = round($rate_value / $count, 1);
            $avg_rate_sleep = round($rate_sleep / $count, 1);
            $this->setAttribute('avg_rate', $avg_rate);
            $this->setAttribute('avg_rate_service', $avg_rate_service);
            $this->setAttribute('avg_rate_value', $avg_rate_value);
            $this->setAttribute('avg_rate_sleep', $avg_rate_sleep);
            $this->setAttribute('count_review', $count);
        } else {
            $this->setAttribute('avg_rate', 0);
            $this->setAttribute('avg_rate_service', 0);
            $this->setAttribute('avg_rate_value', 0);
            $this->setAttribute('avg_rate_sleep', 0);
            $this->setAttribute('count_review', 0);
        }


        return $this;
    }

    public function deletePhoto($arrDelete){
        $photos=array();
        $arrPath=array();
        foreach($arrDelete as $path){
            $photos[] = Photo::where('path',$path)->delete();
            preg_match('/id=(.+)&/', $path, $arr);
            $delete_avatar =  collect(Storage::disk('photo')->listContents('/', false))->where('path', '=', $arr[1])->first();
            Storage::disk('photo')->delete($delete_avatar);
        }

        return true;
    }

    public function changeAvatar($avatar){

        if($this->img_avatar != null){
            preg_match('/id=(.+)&/', $this->img_avatar, $arr);
            $delete_avatar =  collect(Storage::disk('avatar')->listContents('/', false))->where('path', '=', $arr[1])->first();
            Storage::disk('avatar')->delete($delete_avatar);
        }

        $name_avatar = time() . '-' . $this->name . '-avatar';
        $data_avatar = File::get($avatar);
        $a = Storage::disk('avatar')->put($name_avatar, $data_avatar);
        $url_avatar = Storage::disk('avatar')->url($name_avatar);
        $this->img_avatar = $url_avatar;

        return true;
    }

    public function changeWall($wall){

        if($this->img_wall != null){
            preg_match('/id=(.+)&/', $this->img_wall, $arr);
            $delete_wall =  collect(Storage::disk('wall')->listContents('/', false))->where('path', '=', $arr[1])->first();
            Storage::disk('wall')->delete($delete_wall);
        }

        $name_wall = time() . '-' . $this->name . '-wall';
        $data_wall = File::get($wall);
        $b = Storage::disk('wall')->put($name_wall, $data_wall);
        $url_wall = Storage::disk('wall')->url($name_wall);
        $this->img_wall = $url_wall;

        return true;
    }
    public function deleteDrafts(){
        preg_match('/id=(.+)&/', $this->img_avatar, $arr_avatar);
        $delete_avatar =  collect(Storage::disk('avatar')->listContents('/', false))->where('path', '=', $arr_avatar[1])->first();
        Storage::disk('avatar')->delete($delete_avatar);

        preg_match('/id=(.+)&/', $this->img_wall, $arr_wall);
        $delete_wall =  collect(Storage::disk('wall')->listContents('/', false))->where('path', '=', $arr_wall[1])->first();
        Storage::disk('wall')->delete($delete_wall);

        $arrPath = $this->photo()->get('path');
        foreach ($arrPath as $item) {
            $photos[] = Photo::where('path', $item->path)->delete();
            preg_match('/id=(.+)&/', $item->path, $arr);
            $delete_avatar =  collect(Storage::disk('photo')->listContents('/', false))->where('path', '=', $arr[1])->first();
            Storage::disk('photo')->delete($delete_avatar);
        }

        $this->Amenity()->detach();
        $this->Roomtype()->detach();

        return true;
        
    }
    public static function reportPostMonthYear($type,$from,$to,$filter){
        $dt = new DateTime($from);
        $dt2 = new DateTime($to);
        
        $data = array();
        if ($filter == 0) {
            if($dt->format('Y-m') == $dt2->format('Y-m') ){
                $moi = Post::where('status', 0)->where('type', $type)->whereBetween('created_at', [$from, $to])->selectRaw('year(created_at) year, month(created_at) month, count(*) data')
                ->groupBy('year', 'month')
                ->orderBy('year', 'asc')->orderBy('month', 'desc')
                ->first();
                if ($moi != null) {
                    $obj['categories'] = $moi->month . '-' . $moi->year;
                    $obj['data'] = $moi->data;
                    $data[] = $obj;
                } else {
                    $obj['categories'] = $dt2->format('m') . '-' . $dt2->format('Y');
                    $obj['data'] = 0;
                    $data[] = $obj;
                }
            }else{
                $end = $dt->modify('last day of this month');
                $moi = Post::where('status', 0)->where('type', $type)->whereBetween('created_at', [$from, $end->format('Y-m-d')])->selectRaw('year(created_at) year, month(created_at) month, count(*) data')
                    ->groupBy('year', 'month')
                    ->orderBy('year', 'asc')->orderBy('month', 'desc')
                    ->first();
                if ($moi != null) {
                    $obj['categories'] = $moi->month . '-' . $moi->year;
                    $obj['data'] = $moi->data;
                    $data[] = $obj;
                } else {
                    $obj['categories'] = $end->format('m') . '-' . $end->format('Y');
                    $obj['data'] = 0;
                    $data[] = $obj;
                }
    
                while (true) {
                    $day = $dt->format('j');
                    $dt->modify('first day of +1 month');
                    $dt->modify('+' . (min($day, $dt->format('t')) - 1) . ' days');
                    if ($end < $dt2) {
    
                        $start = $dt->format('Y-m-01');
                        $end = $dt->modify('last day of this month');
    
                        $moi = Post::where('status', 0)->where('type', $type)->whereBetween('created_at', [$start, $end->format('Y-m-d')])->selectRaw('year(created_at) year, month(created_at) month, count(*) data')
                            ->groupBy('year', 'month')
                            ->orderBy('year', 'asc')->orderBy('month', 'desc')
                            ->first();
                        $obj = array();
                        if ($moi != null) {
                            $obj['categories'] = $moi->month . '-' . $moi->year;
                            $obj['data'] = $moi->data;
                            $data[] = $obj;
                        } else {
                            $obj['categories'] = $end->format('m') . '-' . $end->format('Y');
                            $obj['data'] = 0;
                            $data[] = $obj;
                        }
                    } else {
                        break;
                    }
                }
                $start2 = $dt2->modify('first day of this month');
                $moi = Post::where('status', 0)->where('type', $type)->whereBetween('created_at', [$start2->format('Y-m-d'), $to])->selectRaw('year(created_at) year, month(created_at) month, count(*) data')
                    ->groupBy('year', 'month')
                    ->orderBy('year', 'asc')->orderBy('month', 'desc')
                    ->first();
                if ($moi != null) {
                    $obj['categories'] = $moi->month . '-' . $moi->year;
                    $obj['data'] = $moi->data;
                    $data[] = $obj;
                } else {
                    $obj['categories'] = $dt2->format('m') . '-' . $dt2->format('Y');
                    $obj['data'] = 0;
                    $data[] = $obj;
                }
            }
        }else{
            if($dt->format('Y') == $dt2->format('Y')){
                $moi = Post::where('status', 0)->where('type', $type)->whereBetween('created_at', [$from, $to])->selectRaw('year(created_at) year, count(*) data')
                    ->groupBy('year')
                    ->orderBy('year', 'asc')
                    ->first();
                if ($moi != null) {
                    $obj['categories'] =  $moi->year;
                    $obj['data'] = $moi->data;
                    $data[] = $obj;
                } else {
                    $obj['categories'] = $dt2->format('Y');
                    $obj['data'] = 0;
                    $data[] = $obj;
                }
            }else{
                $end = $dt->modify('last day of december');
                $moi = Post::where('status', 0)->where('type', $type)->whereBetween('created_at', [$from, $end->format('Y-m-d')])->selectRaw('year(created_at) year,count(*) data')
                ->groupBy('year')
                    ->orderBy('year', 'asc')
                    ->first();
                if ($moi != null) {
                    $obj['categories'] = $moi->year;
                    $obj['data'] = $moi->data;
                    $data[] = $obj;
                } else {
                    $obj['categories'] = $dt->format('Y');
                    $obj['data'] = 0;
                    $data[] = $obj;
                }

                while (true) {
                    $day = $dt->format('j');
                    $dt->modify('first day of +1 year');
                    $dt->modify('+' . (min($day, $dt->format('t')) - 1) . ' days');
                    if ($end < $dt2) {

                        $start = $dt->format('Y-01-01');
                        $end = $dt->modify('last day of december');

                        $moi = Post::where('status', 0)->where('type', $type)->whereBetween('created_at', [$start, $end->format('Y-m-d')])->selectRaw('year(created_at) year,count(*) data')
                        ->groupBy('year')
                            ->orderBy('year', 'asc')
                            ->first();
                        $obj = array();
                        if ($moi != null) {
                            $obj['categories'] = $moi->year;
                            $obj['data'] = $moi->data;
                            $data[] = $obj;
                        } else {
                            $obj['categories'] = $end->format('Y');
                            $obj['data'] = 0;
                            $data[] = $obj;
                        }
                    } else {
                        break;
                    }
                }
                $start2 = $dt2->modify('first day of january');
                $moi = Post::where('status', 0)->where('type', $type)->whereBetween('created_at', [$start2->format('Y-m-d'), $to])->selectRaw('year(created_at) year, count(*) data')
                ->groupBy('year')
                    ->orderBy('year', 'asc')
                    ->first();
                if ($moi != null) {
                    $obj['categories'] = $moi->month . '-' . $moi->year;
                    $obj['data'] = $moi->data;
                    $data[] = $obj;
                } else {
                    $obj['categories'] = $dt2->format('Y');
                    $obj['data'] = 0;
                    $data[] = $obj;
                }
            }
        }
        return $data;
    }
    public static function reportUserMonth($from, $to){
        $dt = new DateTime($from);
        $dt2 = new DateTime($to);

        $data = array();
        
        if ($dt->format('Y-m') == $dt2->format('Y-m')) {
            $moi = User::whereBetween('created_at', [$from, $to])->selectRaw('year(created_at) year, month(created_at) month, count(*) data')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')->orderBy('month', 'desc')
            ->first();
            if ($moi != null) {
                $obj['categories'] = $moi->month . '-' . $moi->year;
                $obj['data'] = $moi->data;
                $data[] = $obj;
            } else {
                $obj['categories'] = $dt2->format('m') . '-' . $dt2->format('Y');
                $obj['data'] = 0;
                $data[] = $obj;
            }
        } else {
            $end = $dt->modify('last day of this month');
            $moi = User::whereBetween('created_at', [$from, $end->format('Y-m-d')])->selectRaw('year(created_at) year, month(created_at) month, count(*) data')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')->orderBy('month', 'desc')
            ->first();
            if ($moi != null) {
                $obj['categories'] = $moi->month . '-' . $moi->year;
                $obj['data'] = $moi->data;
                $data[] = $obj;
            } else {
                $obj['categories'] = $end->format('m') . '-' . $end->format('Y');
                $obj['data'] = 0;
                $data[] = $obj;
            }

            while (true) {
                $day = $dt->format('j');
                $dt->modify('first day of +1 month');
                $dt->modify('+' . (min($day, $dt->format('t')) - 1) . ' days');
                if ($end < $dt2) {

                    $start = $dt->format('Y-m-01');
                    $end = $dt->modify('last day of this month');

                    $moi = User::whereBetween('created_at', [$start, $end->format('Y-m-d')])->selectRaw('year(created_at) year, month(created_at) month, count(*) data')
                    ->groupBy('year', 'month')
                    ->orderBy('year', 'asc')->orderBy('month', 'desc')
                    ->first();
                    $obj = array();
                    if ($moi != null) {
                        $obj['categories'] = $moi->month . '-' . $moi->year;
                        $obj['data'] = $moi->data;
                        $data[] = $obj;
                    } else {
                        $obj['categories'] = $end->format('m') . '-' . $end->format('Y');
                        $obj['data'] = 0;
                        $data[] = $obj;
                    }
                } else {
                    break;
                }
            }
            $start2 = $dt2->modify('first day of this month');
            $moi = User::whereBetween('created_at', [$start2->format('Y-m-d'), $to])->selectRaw('year(created_at) year, month(created_at) month, count(*) data')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')->orderBy('month', 'desc')
            ->first();
            if ($moi != null) {
                $obj['categories'] = $moi->month . '-' . $moi->year;
                $obj['data'] = $moi->data;
                $data[] = $obj;
            } else {
                $obj['categories'] = $dt2->format('m') . '-' . $dt2->format('Y');
                $obj['data'] = 0;
                $data[] = $obj;
            }
        }
    
   

        return $data;
    
    }
}
