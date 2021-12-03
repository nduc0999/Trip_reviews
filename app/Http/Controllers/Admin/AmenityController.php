<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use Illuminate\Http\Request;

class AmenityController extends Controller
{
    public function index(Request $request){

        $data = Amenity::where('status',0)->orderBy('id', 'DESC')->paginate(3);

        if($request->ajax()){
            return view('admin.amenity.table-data', ['arr_data' => $data]);
        }

        return view('admin.amenity.manager-amenities',['arr_data' => $data]);
    }


    public function update(Request $request){

        $checkName = Amenity::where('name', 'like', $request->name)->where('status', 0)->first();
        $checkDescription = Amenity::where('name', 'like', $request->name)->where('description','like',$request->description)->where('status', 0)->first();
        if($checkName){
            if($checkDescription){
                return response()->json(['status' => false,'mess' => 'Đã tồn tại tiện ích hoặc không có sự thay đổi tiện ích']);
            }
            $amenity = Amenity::find($request->id);
            $amenity->description = $request->description;
            $amenity->save();
            return response()->json(['status' => false, 'mess' => 'Đã sửa nội dung mô tả']);
        }
            $amenity = Amenity::find($request->id);
            $amenity->name = $request->name;
            $amenity->description =$request->description;
            $amenity->save();
        
            
        return response()->json(['status' => true]);
    }

    public function store(Request $request){
        $check = Amenity::where('name', 'like', $request->name)->where('status', 0)->first();
        if ($check) {
            return response()->json(['status' => false, 'mess' => 'Đã tồn tại tiện ích hoặc không có sự thay đổi tiện ích']);
        }
        $amenity = Amenity::create($request->all());
        return response()->json(['status' => true]);
    }

    public function delete(Request $request){
        if($request->id){
            $amenity = Amenity::find($request->id);
            $amenity->status = 1;
            $amenity->save();
            return response()->json(['status' => $amenity]);
        }
        // return response()->json(['status' => false,'mess' => 'Xoá thất bại']);
            return response()->json(['status' => false]);

    }
}
