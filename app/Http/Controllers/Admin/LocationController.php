<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Exception;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public $countRecord = 5;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Location::where('status', 0)->orderBy('id', 'DESC')->paginate($request->count);
            return view('admin.location.table-data', ['arr_data' => $data]);
        }

        $data = Location::where('status', 0)->orderBy('id', 'DESC')->paginate($this->countRecord);


        return view('admin.location.manager-location', ['arr_data' => $data]);
    }


    public function update(Request $request)
    {

        try{
            $checkProvince = Location::where('province', 'LIKE', $request->province)->where('status', 0)->first();
            $checkAll = Location::where('province', 'like', $request->province)
                                        ->where('region','like',$request->region)
                                        ->where('latitude',$request->latitude)
                                        ->where('longtitude',$request->longtitude)
                                        ->where('status', 0)->first();
        }catch(Exception $e){
            return response()->json(['status' => false, 'mess' => 'Lỗi xảy ra']);
        }

        if ($checkProvince) {
            if ($checkAll) {
                return response()->json(['status' => false, 'mess' => 'Không có sự thay đổi địa điểm']);
            }
            if($checkProvince->id != $request->id){
                return response()->json(['status' => false, 'mess' => 'Địa điểm đã tồn tại']);
            }
            $location = Location::find($request->id);
            $location->region = $request->region;
            $location->latitude= $request->latitude;
            $location->longtitude = $request->longtitude;
            $location->save();
            return response()->json(['status' => true, 'mess' => 'Đã sửa nội dung mô tả']);
        }
        $location = Location::find($request->id);
        $location->province = $request->province;
        $location->region = $request->region;
        $location->latitude = $request->latitude;
        $location->longtitude = $request->longtitude;
        $location->save();

        return response()->json(['status' => true]);
    }

    public function store(Request $request)
    {
        $check = Location::where('province', 'like', $request->province)->where('status', 0)->first();
        if ($check) {
            return response()->json(['status' => false, 'mess' => 'Đã tồn tại địa điểm']);
        }
        $location = Location::create($request->all());
        return response()->json(['status' => true]);
      
    }

    public function delete(Request $request)
    {
        if ($request->id) {
            $location = Location::find($request->id);
            $location->status = 1;
            $location->save();
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false, 'mess' => 'Xoá thất bại']);
    }
}
