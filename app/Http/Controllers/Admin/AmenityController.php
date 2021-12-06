<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use Illuminate\Http\Request;

class AmenityController extends Controller
{

    public $countRecord = 3;

    public function index(Request $request){

        $data = Amenity::where('status',0)->orderBy('id', 'DESC')->paginate($this->countRecord);

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
                return response()->json(['status' => false,'mess' => 'Không có sự thay đổi tiện ích']);
            }
            if($checkName->id != $request->id){
                return response()->json(['status' => false, 'mess' => 'Đã tồn tại tiện ích']);
            }
            $amenity = Amenity::find($request->id);
            $amenity->description = $request->description;
            $amenity->save();
            return response()->json(['status' => true, 'mess' => 'Đã sửa nội dung mô tả']);
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
            return response()->json(['status' => false, 'mess' => 'Đã tồn tại tiện ích']);
        }
        $amenity = Amenity::create($request->all());
        return response()->json(['status' => true]);
    }

    public function delete(Request $request){
        if($request->id){
            $amenity = Amenity::find($request->id);
            $amenity->status = 1;
            $amenity->save();
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false,'mess' => 'Xoá thất bại']);

    }
}
