<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

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
        $post_slide = Post::all();
        if(isset($_COOKIE['last_id'])){
            $last_post=array();
            $last_id = json_decode($_COOKIE['last_id'],true);
            foreach($last_id as $i){
                $last_post[] = Post::find($i);
            }

            return view('web.home', ['post_slide' => $post_slide, "last_post" => $last_post]);
        }
        return view('web.home',['post_slide' => $post_slide]);
    }
    public function admin(){
        return view('admin.home');
    }
}
