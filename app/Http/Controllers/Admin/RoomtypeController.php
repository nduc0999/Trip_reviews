<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Roomtype;
use Illuminate\Http\Request;

class RoomtypeController extends Controller
{
    public $countRecord = 3;

    public function index(Request $request)
    {

        $data = Roomtype::where('status', 0)->orderBy('id', 'DESC')->paginate($this->countRecord);

        if ($request->ajax()) {
            return view('admin.roomtype.table-data', ['arr_data' => $data]);
        }

        return view('admin.roomtype.manager-roomtype', ['arr_data' => $data]);
    }


    public function update(Request $request)
    {

        $checkName = Roomtype::where('name', 'like', $request->name)->where('status', 0)->first();
        $checkDescription = Roomtype::where('name', 'like', $request->name)->where('description', 'like', $request->description)->where('status', 0)->first();
        if ($checkName) {
            if ($checkDescription) {
                return response()->json(['status' => false, 'mess' => 'Không có sự thay đổi loại phòng']);
            }
            if ($checkName->id != $request->id) {
                return response()->json(['status' => false, 'mess' => 'Đã tồn tại loại phòng']);
            }
            $roomtype = Roomtype::find($request->id);
            $roomtype->description = $request->description;
            $roomtype->save();
            return response()->json(['status' => true, 'mess' => 'Đã sửa nội dung mô tả']);
        }
        $roomtype = Roomtype::find($request->id);
        $roomtype->name = $request->name;
        $roomtype->description = $request->description;
        $roomtype->save();


        return response()->json(['status' => true]);
    }

    public function store(Request $request)
    {
        $check = Roomtype::where('name', 'like', $request->name)->where('status', 0)->first();
        if ($check) {
            return response()->json(['status' => false, 'mess' => 'Đã tồn tại loại phòng']);
        }
        $roomtype = Roomtype::create($request->all());
        return response()->json(['status' => true]);
    }

    public function delete(Request $request)
    {
        if ($request->id) {
            $roomtype = Roomtype::find($request->id);
            $roomtype->status = 1;
            $roomtype->save();
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false, 'mess' => 'Xoá thất bại']);
    }
}
