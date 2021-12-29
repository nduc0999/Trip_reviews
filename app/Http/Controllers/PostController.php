<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestPost;
use App\Http\Requests\RequestReview;
use App\Models\Amenity;
use App\Models\Answer;
use App\Models\Location;
use App\Models\Photo;
use App\Models\Post;
use App\Models\Question;
use App\Models\Review;
use App\Models\Roomtype;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;

class PostController extends Controller
{
    
    public $photoCount = 10;
    public $countSearch = 10;

    public function adminPost(){

        $location = Location::where('status',0)->orderBy('province', 'ASC')->get();
        return view('admin.post.post',['locations' => $location]);
    }

    public function listAmenity(Request $request){
        if($request->ajax()){
            $amenities = Amenity::all();
            return view('admin.post.list-amenity',['arrayData' => $amenities]);
        }
        return response()->json(['status' => false]);
    }

    public function listRoomtype(Request $request){
        if ($request->ajax()) {
            $roomtype = Roomtype::all();
            return view('admin.post.list-roomtype', ['arrayData' => $roomtype]);
        }
        return response()->json(['status' => false]);
    }

    public function reviewSuccess(){
        return view('web.post.review-success');
    }

    public function proposeSuccess(){
        return view('web.propose.propose-success');
    }

    public function showPropose(){

        $location = Location::where('status', 0)->orderBy('province', 'ASC')->get();
        return view('web.propose.propose',['locations'=>$location]);
    }

    public function store(RequestPost $request){

        $post = new Post();
        $post->name = $request->name;
        $post->introduce = $request->introduce;
        $post->address = $request->address;
        $post->streets = $request->streets;
        $post->district = $request->district;
        $post->id_location = $request->id_location;
        $post->link = $request->link != null ? $request->link : null;
        $post->open = str_replace(":", "h", $request->open);
        $post->closes = str_replace(":", "h", $request->closes);
        $post->min_guest = $request->min_guest;
        $post->max_guest = $request->max_guest;
        $post->phone = $request->phone;
        $post->latitude = $request->latitude;
        $post->longtitude = $request->longtitude;
        $post->email = $request->email != null ? $request->email : null;
        $post->id_user = Auth::user()->id;
        $post->owner= 0;
        $post->type= $request->type;
        
        $post->upAvatarWall($request->file('img_avatar'),$request->file('img_wall'));

        $post->save();

        $post->Amenity()->attach($request->amenity);
        $post->Roomtype()->attach($request->roomtype);

        $post->uploadPhoto($request->file('photo'),$request->note);


        return response()->json(['error' => $request->all()]);
    
    }

    public function storePropose(RequestPost $request){
       

        $post = new Post();
        $post->name = $request->name;
        $post->introduce = $request->introduce;
        $post->address = $request->address;
        $post->streets = $request->streets;
        $post->district = $request->district;
        $post->id_location = $request->id_location;
        $post->link = $request->link != null ? $request->link : null;
        $post->open = str_replace(":", "h", $request->open);
        $post->closes = str_replace(":", "h", $request->closes);
        $post->min_guest = $request->min_guest;
        $post->max_guest = $request->max_guest;
        $post->phone = $request->phone;
        $post->latitude = $request->latitude;
        $post->longtitude = $request->longtitude;
        $post->email = $request->email != null ? $request->email : null;
        $post->id_user = Auth::user()->id;
        $post->owner = $request->owner != null? $request->owner:0;
        $post->type = $request->type;
        $post->status = 1;

        try {
            $post->upAvatarWall($request->file('img_avatar'), $request->file('img_wall'));

            $post->save();

            $post->Amenity()->attach($request->amenity);
            $post->Roomtype()->attach($request->roomtype);

            $post->uploadPhoto($request->file('photo'),$request->note);
        } catch (Exception $e) {
            return response()->json(['status'=>$post->owner,'mess' => 'Lỗi xử lý DB']);
        }
        return response()->json(['status' => true]);
       
        // $arr= array();
        // foreach($request->file('photo') as $item){
        //      $a = $item->getClientOriginalName();
        //      $b = '\''.$a.'\'';
        //      $arr[] = $request->note[$b];
        // }
        // return $arr;
    }

    public function loadPost(Request $request){
        $arrId = array();
        if($request->ajax()){
            $post = Post::find($request->id);
            $photos = $post->photo()->paginate($this->photoCount);
            return response()->json(['photos' => $photos]);
        }
        if($request->id){
            
            $post = Post::find($request->id);
            if($post->status == 1){
                return redirect()->back();
            }

            $photos = $post->photo()->paginate($this->photoCount);
            $location = $post->Location;
            $amenity = $post->amenity;
            $roomtype = $post->roomtype;
            $reviews = $post->getReview();
            $post_all = $post->getSinglePost();

        
            
            if (isset($_COOKIE['last_id'])) {
                $arr_json = json_decode($_COOKIE['last_id'], true);
                
                $arrId = array_slice($arr_json, 0, 6);
                if (in_array((string)$request->id, $arrId)) {
                    unset($arrId[array_search($request->id, $arrId)]);
                }
                array_unshift($arrId, $request->id);
                $array_json = json_encode($arrId);
                setcookie("last_id", $array_json, time() + 86400, "/");
            } else {
                $array_json = json_encode(array($request->id));
                setcookie("last_id", $array_json, time() + 86400, "/");
            }

            return view('web.post.post-info',[   'post' => $post_all,
                                            'photos' => $photos,
                                            'location' => $location,
                                            'amenity' => $amenity,
                                            'roomtype' => $roomtype,
                                            'reviews' => $reviews,

                                        ]);
        }
        return "Page not found";
    }

    public function formReview(Request $request){

        $post = Post::find($request->id);
        $location = $post->location;
        $question = Question::where('status',0)->orderBy('id', 'DESC')->get();
        return view('web.post.form-review',[ 'post' => $post,
                                        'location' => $location,
                                        'questions' => $question,
                                    ]);
    }

    public function storeReivew(RequestReview $request){
        
        $review = new Review();
        $review->title = $request->title;
        $review->comment = $request->comment;
        $review->rate = $request->rate;
        $review->trip_type = $request->trip_type;
        $review->trip_when = $request->trip_when.'-1';
        $review->rate_service = $request->rate_service;
        $review->rate_value = $request->rate_value;
        $review->rate_sleep = $request->rate_sleep;
        $review->id_post = $request->id_post;
        $review->id_user = Auth::user()->id;
        $review->save();

        if(isset($request->answer)){
            $a = array();
            $questions = Question::where('status',0)->get(['id']);
            foreach($questions as $question){
            
                $answer = new Answer();
                $answer->id_review = $review->id;
                $answer->id_question = $question->id;
                $answer->answer = $request->answer[$question->id];
                $answer->save();
            }
          
        }

        return response()->json(['status' => true]);
      
       
    }

    public function likeReview(Request $request){
        try {
            if($request->id){
                $user = User::find(Auth::id());
                $check = $user->LikeReview()->where('id_review',$request->id)->first();
            
                if($check){
                    $like = $user->LikeReview()->detach($request->id);
                }else{
                    $like = $user->LikeReview()->attach($request->id);
                }
                $review = Review::find($request->id);
                $count = count($review->LikeReview);
                return response()->json(['status' => true,'count' => $count]);
            }
        } catch ( Exception $e ) {
            return response()->json(['status' =>false,'mess'=>'Lỗi truy vấn']);
        }

        return response()->json(['status' => false, 'mess' => 'Lỗi không xác định']);   ;
    }

    public function repReview(Request $request){
        try{
            $review = Review::find($request->id_review);
            $review->rep = $request->rep;
            $review->id_respondent = Auth::id();
            $review->save();
            $post = Post::find($request->id_post);
            $reviews = $post->getReview();

            return response()->json(['status' => true]);
            // return view('web.post.data-review',['reviews' => $reviews,'post' => $post]);
        }catch(Exception $e){
            return response()->json(['status' => false,'mess' => $e->getMessage()]);
        }

        return response()->json(['status'=>false,'mess' => 'Lỗi không xác định']);

        // return response()->json(['status' => $request->all()]);
    
    }

    public function deleteRep(Request $request){
        try {
            $review = Review::find($request->id_review);
            $review->rep = null;
            $review->id_respondent = Auth::id();
            $review->save();
            

            return response()->json(['status' => true]);
         
        } catch (Exception $e) {
            return response()->json(['status' => false, 'mess' => $e->getMessage()]);
        }

        return response()->json(['status' => false, 'mess' => 'Lỗi không xác định']);
    }

    public function repUpdate(Request $request){

        try{
            if($request->id_review){
                $review = Review::find($request->id_review);
                $review->rep = $request->rep;
                $review->id_respondent = Auth::id();
                $review->save();
                return response()->json(['status' => true]);
            }

        }catch(Exception $e){
            return response()->json(['status' => false,'mess'=> 'Lỗi dữ liệu vào']);
        }
        return response()->json(['status' => false,'mess' => 'Lỗi không thấy id']);
    }

    public function hiddenReview(Request $request){
        try {
            if ($request->id_review) {
                $review = Review::find($request->id_review);
                $review->status = 1;
                $review->id_respondent = Auth::id();
                $review->save();
                return response()->json(['status' => true]);
            }
        } catch (Exception $e) {
            return response()->json(['status' => false, 'mess' => 'Lỗi dữ liệu vào']);
        }
        return response()->json(['status' => false, 'mess' => 'Lỗi không thấy id']);
    }

    public function search(Request $request){

        try {
            if($request->search){
                $data = Post::where('name', 'like', '%'.$request->search.'%')
                            ->orWhere('address','like', '%' . $request->search . '%')
                            ->orWhere('streets', 'like', '%'.$request->search.'%')
                            ->orWhere('district', 'like', '%'.$request->search.'%')->with('location')->get();
                if($request->ajax()){
                    return response()->json(['status' => true, 'data' => $data]);
                }

                return view('web.search-page',['results' => $data]);
            }
            
        } catch (Exception $e) {
            return response()->json(['status' => false, 'mess' => 'Lỗi xử lý DB']);
            
        }
        if($request->ajax()){
            return response()->json(['status' => false ,'mess' => 'Giá trị search trống ']);
        }
        return view('web.search-page',['results' => array()]);
    }

    public function searchPage(Request $request){
       
        try {
            if ($request->ajax()) {
                if ($request->search == '') {
                    return view('web.search.list-data', ['results' => array(), 'search' => $request->search]);
                }
            }
            if ($request->search) {
              
                if($request->ajax()){
                  
                    switch ($request->type) {
                        case 0:
                            $result = Post::where([['name', 'like', '%' . $request->search . '%'], ['type', 0], ['status', 0]])
                                ->orWhere([['address', 'like', '%' . $request->search . '%'], ['type', 0], ['status', 0]])
                                ->orWhere([['streets', 'like', '%' . $request->search . '%'], ['type', 0], ['status', 0]])
                                ->orWhere([['district', 'like', '%' . $request->search . '%'], ['type', 0], ['status', 0]])
                                ->orWhere(function ($query) use ($request) {
                                    $query->where('type', 0)->where('status',0)->WhereHas('location', function ($query1) use ($request) {
                                        $query1->where('province', 'like', '%' . $request->search . '%');
                                    });
                                })
                                ->paginate($this->countSearch)->appends(request()->query());
                            $homestays = Post::setInfoPost($result); 
                            return view('web.search.list-data',['results'=>$homestays]);
                            
                        case 1:
                            $result =  Post::where([['name', 'like', '%' . $request->search . '%'], ['type', 1],['status',0]])
                                ->orWhere([['address', 'like', '%' . $request->search . '%'], ['type', 1], ['status', 0]])
                                ->orWhere([['streets', 'like', '%' . $request->search . '%'], ['type', 1], ['status', 0]])
                                ->orWhere([['district', 'like', '%' . $request->search . '%'], ['type', 1], ['status', 0]])
                                ->orWhere(function ($query) use ($request) {
                                    $query->where('type', 1)->where('status',0)->WhereHas('location', function ($query1) use ($request) {
                                        $query1->where('province', 'like', '%' . $request->search . '%');
                                    });
                                })
                                ->paginate($this->countSearch)->appends(request()->query());
                            $resorts = Post::setInfoPost($result);
                            return view('web.search.list-data', ['results' => $resorts]);
                        case 2:
                            $result =  Post::where([['name', 'like', '%' . $request->search . '%'], ['status', 0]])
                                ->orWhere([['address', 'like', '%' . $request->search . '%'], ['status', 0]])
                                ->orWhere([['streets', 'like', '%' . $request->search . '%'], ['status', 0]])
                                ->orWhere([['district', 'like', '%' . $request->search . '%'], ['status', 0]])
                                ->orWhere(function ($query) use ($request) {
                                    $query->where('status', 0)->WhereHas('location', function ($query1) use ($request) {
                                        $query1->where('province', 'like', '%' . $request->search . '%');
                                    });
                                })
                                ->paginate($this->countSearch)->appends(request()->query());

                            $all = Post::setInfoPost($result);
                            return view('web.search.list-data', ['results' => $all]);
                        default:
                            return view('web.search.list-data', ['results' => array(), 'search' => $request->search]);
                           
                    }
                    
                }
                $result = Post::where([['name', 'like', '%' . $request->search . '%'], ['status', 0]])
                                ->orWhere([['address', 'like', '%' . $request->search . '%'], ['status', 0]])
                                ->orWhere([['streets', 'like', '%' . $request->search . '%'], ['status', 0]])
                                ->orWhere([['district', 'like', '%' . $request->search . '%'], ['status', 0]])
                                ->orWhere(function ($query) use ($request) {
                                    $query->where('status', 0)->WhereHas('location', function ($query1) use ($request) {
                                        $query1->where('province', 'like', '%' . $request->search . '%');
                                    });
                                })
                                ->paginate($this->countSearch)->appends(request()->query());

                $all = Post::setInfoPost($result);
                
                // return $result;
                return view('web.search.search-page', ['results' => $all,'search' => $request->search]);
            }
          
        } catch (Exception $e) {
            return view('web.search.search-page', ['results' => array(), 'search' => $request->search]);
      
        }
     
        return view('web.search.search-page', ['results' => array(), 'search' => $request->search]);
    }
    
}
