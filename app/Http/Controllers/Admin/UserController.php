<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $countRecord = 10;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::orderBy('id', 'DESC')->paginate($request->count);
            return view('admin.user.table-data', ['arr_data' => $data]);
        }

        $data = User::orderBy('id', 'DESC')->paginate($this->countRecord);

        return view('admin.user.manager-user', ['arr_data' => $data]);
    }

    public function ban_unban_Review(Request $request){
        if($request->id){
            $user = User::find($request->id);
            if( $user->status == 1 ){
                $user->status = 0;
            }else{
                $user->status = 1;
            }
            $user->save();
            return response()->json(['status' => true]);
        }

        return response()->json(['status' => $request->all()]);
    }

    public function profile(Request $request){
        if($request->id){
            $user = User::find($request->id);
            $data = array(
                "email" => $user->email,
                "first_name" => $user->first_name,
                "last_name" => $user->last_name,
                "date_of_birth" => $user->date_of_birth,
                "introduce" =>$user->introduce,
                'img_avatar' => $user->img_avatar,
                "img_wall" => $user->img_wall,
                "phone" => $user->phone,
                "country" => $user->country,
            );

            return response()->json(['status' => true,'data' => $data]);
        }
        return response()->json(["status" => false]);
    }
}
