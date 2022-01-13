<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PhotoUser;
use App\Models\Post;
use App\Models\PostPhoto;
use App\Models\Review;
use App\Models\Travel;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public $countRecord = 1;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            if($request->filter == 1){
                $data = User::where('role', 1)->orderBy('id', 'DESC')->paginate($request->count);
            }else{
                $data = User::where('role',0)->orderBy('id', 'DESC')->paginate($request->count);
            }
            return view('admin.user.table-data', ['arr_data' => $data]);
        }

        $data = User::where('role', 0)->orderBy('id', 'DESC')->paginate($this->countRecord);

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

            return response()->json(['status' => true,'data' => $user]);
        }
        return response()->json(["status" => false]);
    }

    public function viewChangePassword(){
        return view('auth.passwords.change-password');
    }

    public function resetPasswordAdmin(Request $request){
        $comb = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $shfl = str_shuffle($comb);
        $pwd = substr($shfl, 0, 8);
        
        try {
            if(is_int($request->id)){
                $user = User::find($request->id);
                $user->password = Hash::make($pwd);
                $user->save();
                return response()->json(['status' => true,'pass' => $pwd]);
            }
            
        } catch (Exception $e) {
            return response()->json(['status' => false, 'mess' => 'Lỗi giá trị trong DB']);
        }
        return response()->json(['status' => false, 'mess' => 'Lỗi id']);

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

    private function date_compare($element1, $element2)
    {
        $datetime1 = strtotime($element1['created_at']);
        $datetime2 = strtotime($element2['created_at']);
        return $datetime2 - $datetime1;
    }

    public function profileUser(Request $request){

        $user = User::where('id', $request->id)
                    ->first(['id','first_name','last_name','img_avatar','img_wall','phone','country','email','date_of_birth','introduce','created_at','updated_at']);
        $listData = array();
        $reviews = Review::where('id_user', $request->id)->orderBy('created_at','DESC')->get();
        foreach($reviews as $review){
            $review->type='review';
            $a = $review->likereview()->where('id',Auth::id())->exists();
            if($a){
                $review->like = true;
            }else{
                $review->like = false;
            }
            $post = Post::where('id',$review->id_post)->get();

            $review->post = Post::setInfoPost($post);
            $listData[] = $review;
        }
        $postPhotos = PostPhoto::where('id_user', $request->id)->orderBy('created_at', 'DESC')->get();
        
        foreach ($postPhotos as $postPhoto) {
            
            $check = $postPhoto->likePostPhoto()->where('id_user',Auth::id())->first();
            if($check){
                $postPhoto->like = true;
            }else{
                $postPhoto->like = false;
            }
            $item = $postPhoto->PhotoUser()->groupBy('id_post')->get('id_post');
            $arrTag = Post::whereIn('id',$item)->get(['id','name']);
            $postPhoto->arrTag = $arrTag;
            $postPhoto->type = 'postPhoto';
            $postPhoto->count = $postPhoto->photoUser()->count();
            $listData[] = $postPhoto;
        }
     
        usort($listData, array($this,'date_compare'));
        $travels = Travel::where('id_user',$request->id)->where('status',1)->orderBy('updated_at','DESC')->paginate(2, ['*'], 'travelPage');
        $total = count($listData); //total items in array    
        $limit = 3; //per page    
        $totalPages = ceil($total / $limit); //calculate total pages
        // return $listData;
        if ($request->ajax()){
            if($request->type == 1){
                $currPage = $request->currentPage;
                // $page = !empty($currPage) ? $currPage : 1;
                $page = $currPage;
                $page = max($page, 1); //get 1 page when $_GET['page'] <= 0
                $page = min($page, $totalPages); //get last page when $_GET['page'] > $totalPages
                $offset = ($page - 1) * $limit;
                if ($offset < 0) $offset = 0;
                $dataArray = array_slice($listData, $offset, $limit);
                return view('web.user.tab-feed-activity',['list_data' => $dataArray,'user' => $user,'totalPage' => $totalPages]);
            }
            // return $travels;
            return view('web.user.tab-travel', ['travels' => $travels, 'user' => $user ]);
            
        }
        $listData  = array_slice($listData, 0, $limit);
        return view('web.user.profile',[
                                        'list_data' =>$listData,
                                        'user' => $user,
                                        'totalPage' => $totalPages,
                                        'travels' => $travels,
                                        ]);
    }

    public function updateProfile(Request $request){

        request()->validate(
            [
                'first_name' => 'required|min:1|max:50',
                'last_name' => 'required|min:1|max:50',
                'country' => 'max:100',
                'phone' => 'digits_between:6,15|numeric|nullable',
                'introduce' => 'max:150',
            ],
            [
                'required' => 'Không được để trống ô nhập trên',
                'max' => 'Không vượt quá :max ký tự.',
                'phone.numeric' => 'Số điện thoại phải là chữ số',
                'phone.digits_between' => 'Độ dài Sđt trong phải khoảng :min and :max số.',
                'min' => 'Tối thiểu :min ký tự.',
            ]
        );
        try {
            $user = User::find( Auth::id());
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->date_of_birth = $request->date_of_birth;
            $user->country = ucwords($request->country);
            $user->phone = $request->phone;
            $user->introduce = $request->introduce;
            $user->save();
        } catch (Exception $e) {
            return response()->json(['status' =>false,'mess' => 'Lỗi xử lý DB']);
        }
        return response()->json(['status' => true]);
    }

    public function changeAvatar(Request $request){
        request()->validate(
            [
                'img_avatar' => 'mimes:jpeg,jpg,png,gif|max:3072',
                
            ],
            [
                'mimes' => 'Chỉ được upload ảnh :values',
                'max' => "Dung lượng tối đa của ảnh là 3MB ",   
            ]
        );
        try {
            $user = User::find(Auth::id());
            $user->changeAvatar($request->file('img_avatar'));
            $user->save();
        } catch (Exception $e) {
            return response()->json(['status' => false, 'mess' => 'Lỗi xử lý DB']);
        }
        return response()->json(['status' => true, 'img' => $user->img_avatar]); 
    }

    public function changeWall(Request $request){
        request()->validate(
            [
                'img_wall' => 'mimes:jpeg,jpg,png,gif|max:3072',

            ],
            [
                'mimes' => 'Chỉ được upload ảnh :values',
                'max' => "Dung lượng tối đa của ảnh là 3MB ",
            ]
        );
        try {
            $user = User::find(Auth::id());
            $a = $user->changeWall($request->file('img_wall'));
            $user->save();
        } catch (Exception $e) {
            return response()->json(['status' => false, 'mess' => 'Lỗi xử lý DB']);
        }
        return response()->json(['status' => true,'img' => $user->img_wall]); 
    }

    public function postPhoto(Request $request){
        request()->validate(
            [
                'content' => 'required|min:3|max:1000',
                'photo' => 'required',
                'photo.*' => 'required|mimes:jpeg,jpg,png,gif|max:3072',
                'description.*' => 'required|min:3|max:500',
                'post.*' => 'required|numeric',

            ],
            [
                'required' => 'Trường này là bắt buộc',
                'content.max' => 'Độ dài tối đa :max ký tự.',
                'content.min' => 'Độ dài tối thiểu :min ký tự.',
                'description.*.max' => 'Độ dài tối đa :max ký tự.',
                'description.*.min' => 'Độ dài tối thiểu :min ký tự.',
                'post.numeric' => 'Là số',
                'photo.required' => 'Bạn cần tải ảnh!',
                'photo.*.mimes' => 'Chỉ được upload ảnh :values',
                'photo.*.max' => "Dung lượng tối đa của ảnh là 3MB ",
            ]
        );
        
        try {
            $postPhoto = new PostPhoto();
            $postPhoto->content = $request->content;
            $postPhoto->id_user = Auth::id();
            $postPhoto->save();
            $postPhoto->savePhoto($request->file('photo'),$request->description,$request->post);
            
        } catch (Exception $e) {
            return response()->json(['status' => false,'mess' => 'Lỗi truy vấn trong DB']);
        }

        return response()->json(['status' => true]);
        
    }

    public function likePostPhoto(Request $request)
    {
        try {
            if ($request->id) {
                $user = User::find(Auth::id());
                $check = $user->LikePostPhoto()->where('id_postphoto', $request->id)->first();

                if ($check) {
                    $like = $user->LikePostPhoto()->detach($request->id);
                } else {
                    $like = $user->LikePostPhoto()->attach($request->id);
                }
                $postPhoto = PostPhoto::find($request->id);
                $count = count($postPhoto->LikePostPhoto);
                return response()->json(['status' => true, 'count' => $count]);
            }
        } catch (Exception $e) {
            return response()->json(['status' => false, 'mess' => 'Lỗi truy vấn']);
        }

        return response()->json(['status' => false, 'mess' => 'Lỗi không xác định']);;
    }

    public function deletePostPhoto(Request $request){
        try {
            if($request->id){
                $postPhoto = PostPhoto::find($request->id);
                $photoUser = PhotoUser::where('id_postphoto',$request->id)->get();
                PhotoUser::deletePhotoUser($photoUser);
                $postPhoto->delete();
                return response()->json(['status' => true]);
            }
            
        } catch (Exception $e) {
            return response()->json(['status' => false,'mess' => "Lỗi xử lý DB"]);
        }
        return response()->json(['status' => false, 'mess' => "Không tìm thấy id"]);
    }
}
