<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Travel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TravelController extends Controller
{
    public function index(Request $request){

        $list = Travel::where('id_user', Auth::id())->where('status', '!=', 2)
                        ->with(array('post' => function ($query) {
                            $query->select('id', 'name', 'img_avatar');
                        }))->orderBy('updated_at', 'DESC')->get(); 
        // return $list;
        if($request->ajax()){

            switch ($request->status) {
                case 0:
                    $list_ajax = Travel::where('id_user', Auth::id())->where('status', 0)
                        ->with(array('post' => function ($query) {
                            $query->select('id', 'name', 'img_avatar');
                        }))->orderBy('updated_at', 'DESC')->get(); 
                    break;
                case 1:
                    $list_ajax = Travel::where('id_user', Auth::id())->where('status',1)
                        ->with(array('post' => function ($query) {
                            $query->select('id', 'name', 'img_avatar');
                        }))->orderBy('updated_at', 'DESC')->get(); 
                    break;
                case 3:
                    $list_ajax = $list;
                    break;
                case 4:
                    $list_ajax = $list;
                    break;
                
                default:
                    $list_ajax = $list;
                    break;
            }
            return view('web.travel.list-travel', ['list' => $list_ajax]);
        }
        
        return view('web.travel.travel-page',['list' => $list]);
    }

    public function store(Request $request){

        request()->validate(
            [
                'title' => 'required|min:1|max:150',
            ],
            [
                'title.required' => 'Kh??ng ???????c ????? tr???ng ti??u ?????',
                'title.max' => 'Kh??ng v?????t qu?? :max k?? t???.',
                'title.min' => 'T???i thi???u :min k?? t???.',   
            ]
        );

        try {
            $travel = new Travel();
            $travel->title = $request->title;
            $travel->id_user = Auth::id();
            $travel->status = $request->status;
            $travel->save();
            
        } catch (\Throwable $th) {
            return response()->json(['status' => false,'mess' => 'L???i x??? l?? DB']);
        }

        return response()->json(['status' => true]);
    }

    public function update(Request $request){
        request()->validate(
        [
            'title' => 'required|min:1|max:150',
        ],
        [
            'title.required' => 'Kh??ng ???????c ????? tr???ng ti??u ?????',
            'title.max' => 'Kh??ng v?????t qu?? :max k?? t???.',
            'title.min' => 'T???i thi???u :min k?? t???.',   
        ]
        );

        try {
            $travel = Travel::find($request->id);
            $travel->title = $request->title;
            $travel->note = $request->note;
            $travel->save();
            $posts = $travel->post;
            $result = Post::setInfoPost($posts);
            
        } catch (\Throwable $th) {
            return response()->json(['status' => false,'mess'=>'L???i x???y ra DB']);
        }


        return response()->json(['status' => true]);
    
    }
    
    public function infoTravel(Request $request){

        try {
            $travel = Travel::find($request->id);
            $posts = $travel->post;
            if($travel->status ==2 || (Auth::id() != $travel->user->id && $travel->status == 0  )){
                return redirect()->back();
            }
            $result = Post::setInfoPost($posts);
            if($request->ajax()){
                return view('web.travel.list-post-travel', ['travel' => $travel, 'posts' => $result]);
        
            }
            return view('web.travel.info-travel',['travel'=>$travel,'posts' => $result]);
        } catch (Exception $e) {
            //throw $th;
        }

        return view('web.travel.info-travel',['travel' => $travel,'post' => array()]);
    }

    public function changeStatus(Request $request){
        
        try {
            $travel = Travel::find($request->id);
            $travel->status = $request->status;
            $travel->save();
            $posts = $travel->post;
            $result = Post::setInfoPost($posts);
          

        } catch (Exception $e) {
            return response()->json(['status' => false,'mess' => 'L???i x??? l?? DB']);
        }

        return  response()->json(['status' => true]);

    }

    public function search(Request $request){

        try {
            if($request->search!=''){
                $data =  Post::where([['name', 'like', '%' . $request->search . '%'], ['status', 0]])
                                ->orWhere([['address', 'like', '%' . $request->search . '%'], ['status', 0]])
                                ->orWhere([['streets', 'like', '%' . $request->search . '%'], ['status', 0]])
                                ->orWhere([['district', 'like', '%' . $request->search . '%'], ['status', 0]])
                                ->with('location')->get();
    
                    // $arr = array();
    
                    // foreach($data as $i){
                    //     $obj = ['label' => $i->name,'value' => $i->name, 'lat' => $i->latitude,'long' => $i->longtitude];
                    //     $arr[] = $obj;
                    // }
    
                    return response()->json(['status' => true, 'data' => $data]);
            }
      
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'data' => array(),'mess' => 'L???i x??? l?? DB']);
        }
            
        
        return response()->json(['status' => false, 'data' => array()]);

    }

    public function removePost(Request $request){
        try {
            if($request->id_post != null and $request->id_travel != null){
                $travel = Travel::find($request->id_travel);
                $travel->post()->detach($request->id_post);
                $posts = $travel->post;
                $result = Post::setInfoPost($posts);
                return response()->json(['status' => true,'data'=>$result]);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'mess' => 'L???i x??? l?? DB']);
            
        }
        return response()->json(['status' => false,'mess' => 'Xo?? th???t b???i']);
    }

    public function removeTravel(Request $request)
    {
        try {
            if ($request->id_travel) {
                $travel = Travel::find($request->id_travel);
                $travel->status = 2;
                $travel->save();
                return response()->json(['status' => true]);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'mess' => 'L???i x??? l?? DB']);
        }
        return response()->json(['status' => false, 'mess' => 'Xo?? th???t b???i']);
    }

    public function addPost(Request $request){
        try {
            if ($request->id_post != null and $request->id_travel != null) {
                $travel = Travel::find($request->id_travel);
                $posts = $travel->post;
                foreach($posts as $post){
                    if($post->id == $request->id_post){
                        return response()->json(['status' => false, 'mess' => '???? t???n t???i trong chuy???n ??i']);
                       
                    }
                }
                $travel->post()->attach($request->id_post);
                $result = Post::setInfoPost($posts);
                return response()->json(['status' => true, 'data' => $result]);
       
                
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'mess' => 'L???i x??? l?? DB']);
        }
        return response()->json(['status' => false, 'mess' => 'Xo?? th???t b???i']);

     
    }
}
