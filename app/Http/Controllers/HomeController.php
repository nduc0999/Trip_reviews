<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Post;
use App\Models\Review;
use App\Models\Travel;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
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
        $dataArray = array();
        $dataArrayComment = array();
        foreach($post_slide_rate as $post){
            if($post->avg_rate >0 ){
                $dataArray[] =$post;
            }
        }
        
        usort($dataArray,fn($a,$b) => $a->avg_rate < $b->avg_rate);
        $arrRateHight = array_slice($dataArray, 0, 5);

        usort($dataArray, fn ($a, $b) => $a->count_review < $b->count_review);
        $arrReviewHight= array_slice($dataArray, 0, 5);

        $post_new_rate = Post::setInfoPost($post_new);

     
        $arrCountPost = Location::getCountPost();
        
        // return $post_slide_rate;
        $random = Post::inRandomOrder()->where('status',0)->limit(6)->get();
        $listRandom = Post::setInfoPost($random);
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

          

            return view('web.home', [   'post_slide' => $arrRateHight,
                                        'last_post' => $last_post_rate, 
                                        'post_new' => $post_new_rate,
                                        'listRandom' => $listRandom,
                                        'arrReviewHight' => $arrReviewHight,
                                        'arrCountPost' => $arrCountPost,
                                    ]);
        }
        return view('web.home',['post_slide' => $arrRateHight,
                                'post_new' => $post_new_rate,
                                'listRandom' => $listRandom,
                                'arrReviewHight' => $arrReviewHight,
                                'arrCountPost' => $arrCountPost
                                ]);
    }

    
    public function admin(){

        try {
            $users = Review::groupBy('id_user')->selectRaw('count(*) as total, id_user')->orderBy('total', 'DESC')->take(3)->get();

            $postTop = Post::where('status', 0)->get();

            $post_slide_rate = Post::setInfoPost($postTop);
            $dataArray = array();

            foreach ($post_slide_rate as $post) {
                if ($post->avg_rate > 0) {
                    $dataArray[] = $post;
                }
            }

            usort($dataArray, fn ($a, $b) => $a->avg_rate < $b->avg_rate);
            $arrRateHight = array_slice($dataArray, 0, 3);


            $end = new Datetime();
            $start = new Datetime();
            $day = $start->format('j');
            $start->modify('first day of -6 month');
            $start->modify('+' . (min($day, $start->format('t')) - 1) . ' days');
            $userTotal = Post::reportUserMonth($start->format('Y-m-d'), $end->format('Y-m-d'));
            $userActivity = User::where('status', 0)->count();
            $userBan = User::where('status', 1)->count();

            $countHomestay = Post::where('type', 0)->where('status', 0)->count();
            $countResort = Post::where('type', 1)->where('status', 0)->count();
            $countUser = User::count();
            $countReview = Review::count();
            $count = array();
            $count['homestay'] = $countHomestay;
            $count['resort'] = $countResort;
            $count['user'] = $countUser;
            $count['review'] = $countReview;
        } catch (Exception $e) {
            return $e->getMessage();
        }
       
        
        return view('admin.home',[
            'users' => $users,
            'count' => $count,
            'postTop' => $arrRateHight,
            'userTotal' => $userTotal,
            'userActivity' => $userActivity,
            'userBan' => $userBan,

        ]);
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

    public function loadChart(Request $request){
        
        $dateForm = new DateTime($request->dateFrom);
        $dateTo = new DateTime($request->dateTo);
        if($dateForm < $dateTo){
            try {
                switch ($request->filter) {
                    case 0:
                        $post2 = Post::where('status',0)->whereBetween('created_at', [$request->dateFrom, $request->dateTo])->selectRaw('year(created_at) year, monthname(created_at) month, count(*) data')
                                ->groupBy('year', 'month')
                                ->orderBy('year', 'asc')->orderBy('month', 'desc')
                                ->get();
                        $totalReview = Review::where('status', 0)->whereBetween('created_at', [$request->dateFrom, $request->dateTo])->selectRaw('year(created_at) year, monthname(created_at) month, count(*) data')
                                ->groupBy('year', 'month')
                                ->orderBy('year', 'asc')->orderBy('month', 'desc')
                                ->get();
    
                        break;
                    case 1:
                        $post2 = Post::where('status',0)->whereBetween('created_at', [$request->dateFrom, $request->dateTo])->selectRaw('year(created_at) year, count(*) data')
                                ->groupBy('year')
                                ->orderBy('year', 'asc')
                                ->get();
                        $totalReview = Review::where('status', 0)->whereBetween('created_at', [$request->dateFrom, $request->dateTo])->selectRaw('year(created_at) year, count(*) data')
                                ->groupBy('year')
                                ->orderBy('year', 'asc')
                                ->get();
    
                        break;
                    
                    default:
                        $post2 = Post::where('status', 0)->whereBetween('created_at', [$request->dateFrom, $request->dateTo])->selectRaw('year(created_at) year, monthname(created_at) month, count(*) data')
                                ->groupBy('year', 'month')
                                ->orderBy('year', 'asc')->orderBy('month', 'desc')
                                ->get();
                        $totalReview = Review::where('status', 0)->whereBetween('created_at', [$request->dateFrom, $request->dateTo])->selectRaw('year(created_at) year, monthname(created_at) month, count(*) data')
                                ->groupBy('year', 'month')
                                ->orderBy('year', 'asc')->orderBy('month', 'desc')
                                ->get();
                        break;
                }
                $post1 = Post::where('status', 0)->where('type', 0)->get()->groupBy(function ($val) {
                    return Carbon::parse($val->created_at)->format('m');
                });
              
        
                $homestay = Post::reportPostMonthYear(0, $request->dateFrom, $request->dateTo,$request->filter);
                $resort = Post::reportPostMonthYear(1, $request->dateFrom, $request->dateTo,$request->filter);

                return response()->json([
                    'status' => true,
                    'posts' => $post2,
                    'homestay' => $homestay,
                    'resort' => $resort,
                    'totalReview' => $totalReview,

                ]);
                     
            } catch (Exception $e) {
                return response()->json(['status' => false,'mess' => 'Lỗi xử lý DB']);
            }
        }
        return response()->json(['status' => false, 'mess' => 'Ngày bắt dầu lớn hơn ngày kết thúc']);
       
          // $previous_week = strtotime("-0 week +1 day");
        // $start_week = strtotime("last monday", $previous_week);
        // $end_week = strtotime("next sunday", $start_week);
        // $start_week = date("Y-m-d", $start_week);
        // $end_week = date("Y-m-d", $end_week);

        // $date =  Carbon::now()->month(Carbon::now()->month - 3);
        // print_r($date);
        // $startDate = Carbon::now()->startOfQuarter(); // the actual start of quarter method
        // $endDate = Carbon::now()->endOfQuarter();
    }
}
