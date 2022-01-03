<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function addAdmin(Request $request){
        request()->validate(
            [
                'first_name' => ['required', 'string', 'max:50'],
                'last_name' => ['required', 'string', 'max:50'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
            ],
            [
                'first_name.max' => 'Vượt quá độ dài 50 ký tự',
                'last_name.max' => 'Vượt quá độ dài 50 ký tự',
                'email.unique' => 'Đã tồn tại email',
                'password.min' => 'Mật khẩu cần ít nhất 8 ký tự'
            ]
        );

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date('Y-m-d H:i:s');
        try {
            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->verification_code = sha1(time());
            $user->email_verified_at = $date;
            $user->role = 1;
            $user->save();
        } catch (Exception $e) {
            return response()->json(['status' => false,'mess' => 'Lỗi giá trị trong DB']);
        }

        return response()->json(['status' => true]);

        
    }
}
