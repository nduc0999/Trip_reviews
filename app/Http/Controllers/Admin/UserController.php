<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $countRecord = 3;

    public function index(Request $request)
    {

        $data = User::orderBy('id', 'DESC')->paginate($this->countRecord);

        if ($request->ajax()) {
            return view('admin.user.table-data', ['arr_data' => $data]);
        }

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
}
