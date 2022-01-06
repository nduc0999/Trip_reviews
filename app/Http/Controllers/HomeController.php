<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Travel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $post_slide = Post::where('status', 0)->with('review')->get();
        $post_new = Post::where('status',0)->with('review')->orderBy('id','DESC')->take(6)->get();
  

        $post_slide_rate = Post::setInfoPost($post_slide);
        $post_new_rate = Post::setInfoPost($post_new);

        // return $post_slide_rate;

        if(isset($_COOKIE['last_id'])){
            $last_post=array();
            $last_id = json_decode($_COOKIE['last_id'],true);
            foreach($last_id as $i){
                $post = Post::find($i);
                if($post->status == 0){
                    $review = $post->review;
                    $post->setAttribute('review',$review);
                    $last_post[] = $post;
                }
            }
            $last_post_rate = Post::setInfoPost($last_post);

          

            return view('web.home', ['post_slide' => $post_slide_rate,
                                     'last_post' => $last_post_rate, 
                                     'post_new' => $post_new_rate,
                      
                                    ]);
        }
        return view('web.home',['post_slide' => $post_slide_rate,
                                'post_new' => $post_new_rate,
                                ]);
    }
    public function admin(){
        return view('admin.home');
    }

    public function listHomeTravel(Request $request){

        try {
            if($request->id){
                $travels = Travel::where('id_user', Auth::id())->where('status', '!=', 2)
                    ->with(array('post' => function ($query) {
                        $query->select('id', 'name', 'img_avatar');
                    }))->orderBy('updated_at', 'DESC')->get();
    
                $result = Travel::checkHeart($travels,$request->id);
                return view('web.travel.list-home-travel',['travels' => $result]);
            }
       
        } catch (Exception $e) {
            return response()->json(['status' => false,'mess' => 'Lỗi xử lý dữ liệu DB']);
        }
        return response()->json(['status' => false, 'mess' => 'Không tháy id']);
        
    }

    public function addToTravel(Request $request){

        try {
            if($request->id_post != null and $request->id_travel != null){
                $travel = Travel::find($request->id_travel);
                if($request->heart == 1){
                    $travel->post()->detach($request->id_post);
                    $type = 0;
                }else{
                    $travel->post()->attach($request->id_post);
                    $type =1;
                }
                $post = Post::find($request->id_post);
                $post_all = $post->getSinglePost();
                $check_heart = $post_all->heart; 
    
                return response()->json(['status' => true, 'type' => $type,'check_heart' => $check_heart]);
            }
            
            
        } catch (Exception $e) {
            return response()->json(['status' => false,'mess' => $e->getMessage()]);
        }

        return response()->json(['status' => false,'mess' => 'Mất dũ liệu truyền']);

    }

}
