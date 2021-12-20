<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use Exception;
use Illuminate\Http\Request;

class AmenityController extends Controller
{

    public $countRecord = 5;

    public function index(Request $request){

        if($request->ajax()){
            $data = Amenity::where('status', 0)->orderBy('id', 'DESC')->paginate($request->count);
            return view('admin.amenity.table-data', ['arr_data' => $data]);
        }
        $data = Amenity::where('status',0)->orderBy('id', 'DESC')->paginate($this->countRecord);

        return view('admin.amenity.manager-amenities',['arr_data' => $data]);
    }


    public function update(Request $request){

        try{
            $checkName = Amenity::where('name', 'LIKE BINARY', $request->name )->where('status', 0)->first();
            $checkDescription = Amenity::where('name','LIKE BINARY', $request->name)->where('description', 'LIKE BINARY',$request->description)->where('status', 0)->first();

        }catch(Exception $e){
            return response()->json(['status' => false, 'mess' => 'Lỗi không xác định']);
        }
        if($checkName){
            if($checkDescription){
                return response()->json(['status' => false,'mess' => 'Không có sự thay đổi tiện ích','data'=> $checkDescription]);
            }
            if($checkName->id != $request->id){
                return response()->json(['status' => false, 'mess' => 'Đã tồn tại tiện ích']);
            }
            $amenity = Amenity::find($request->id);
            $amenity->description = ucfirst($request->description);
            $amenity->save();
            return response()->json(['status' => true, 'mess' => 'Đã sửa nội dung mô tả']);
        }
            $amenity = Amenity::find($request->id);
            $amenity->name = ucfirst($request->name);
            $amenity->description = ucfirst($request->description);
            $amenity->save();
        
            
        return response()->json(['status' => true]);
    }

    public function store(Request $request){
        $check = Amenity::where('name', 'LIKE', $request->name)->where('status', 0)->first();
        if ($check) {
            return response()->json(['status' => false, 'mess' => 'Đã tồn tại tiện ích']);
        }
        $amenity = new Amenity();
        $amenity->name = ucfirst($request->name);
        $amenity->description = ucfirst($request->description);
        $amenity->save();
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
