<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\Roomtype;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function adminPost(){

        return view('admin.post.post');
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

    public function store(Request $request){
        dd($request->all());
    }
}
