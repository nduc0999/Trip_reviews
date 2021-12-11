<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestPost;
use App\Models\Amenity;
use App\Models\Location;
use App\Models\Photo;
use App\Models\Post;
use App\Models\Roomtype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    public function adminPost(){

        $location = Location::where('status',0)->orderBy('province', 'ASC')->get();
        return view('admin.post.post',['locations' => $location]);
    }

    public function listAmenity(Request $request){
        if($request->ajax()){
            $amenities = Amenity::all();
            return view('admin.post.list-amenity',['arrayData' => $amenities]);
        }
        return response()->json(['status' => false]);
    }

    public function listRoomtype(Request $request)
    {
        if ($request->ajax()) {
            $roomtype = Roomtype::all();
            return view('admin.post.list-roomtype', ['arrayData' => $roomtype]);
        }
        return response()->json(['status' => false]);
    }

    public function store(RequestPost $request){
      

        $post = new Post();
        $post->name = $request->name;
        $post->introduce = $request->introduce;
        $post->address = $request->address;
        $post->streets = $request->streets;
        $post->district = $request->district;
        $post->id_location = $request->id_location;
        $post->link = $request->link != null ? $request->link : null;
        $post->open = str_replace(":", "h", $request->open);
        $post->closes = str_replace(":", "h", $request->closes);
        $post->min_guest = $request->min_guest;
        $post->max_guest = $request->max_guest;
        $post->phone = $request->phone;
        $post->latitude = $request->latitude;
        $post->longtitude = $request->longtitude;
        $post->email = $request->email != null ? $request->email : null;
        $post->id_user = Auth::user()->id;
        $post->owner= 0;
        $post->type= $request->type;
        
        $post->upAvatarWall($request->file('img_avatar'),$request->file('img_wall'));

        $post->save();

        $post->Amenity()->attach($request->amenity);
        $post->Roomtype()->attach($request->roomtype);

        $post->uploadPhoto($request->file('photo'));


        return response()->json(['error' => $request->all()]);
    
    }
}
