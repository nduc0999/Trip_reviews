<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Exception;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    private $activity = 0;
    private $hide =1;
    private $approval = 2;
    private $recordCount = 5;

    public function listApproval(Request $request){

        if($request->ajax()){
            $reviews = Review::where('status', $this->approval)
                ->with(array(
                    'user' => function ($query) {
                        $query->select('id', 'first_name', 'last_name');
                    },
                    'post' => function ($query) {
                        $query->select('id', 'name');
                    }
                ))->orderBy('created_at', 'ASC')->paginate($request->count);

                return view('admin.review.table-data-approval',['listApproval' => $reviews]);
        }

        $reviews = Review::where('status',$this->approval)
                    ->with(array('user' => function($query){ $query->select('id','first_name','last_name'); },
                                'post' => function($query){ $query->select('id','name'); }))->orderBy('created_at','ASC')->paginate($this->recordCount);

        return view('admin.review.approval-review',['listApproval' => $reviews]);
    }

    public function updateStatus(Request $request){

        try {
            
            if($request->id != ''){
                $review = Review::find($request->id);
                $review->status = $request->status;
                $review->save();

                return response()->json(['status' => true]);
            }

        } catch (Exception $e) {
            return response()->json(['status' => false,'mess' => $e->getMessage()]);
        }

        return response()->json(['status' => false,'mess' => 'Không tìm thấy id']);
    }

    public function listReview(Request $request){
        if ($request->ajax()) {

            switch ($request->filter) {
                case 0:
                    $reviews = Review::where('status', $this->activity)->where('title', 'like', '%' . $request->search . '%');
                    break;
                case 1:
                    $reviews = Review::where('status', $this->hide)->where('title', 'like', '%' . $request->search . '%');
                    break;
                case 3:
                    $reviews = Review::where([['title','like','%'.$request->search.'%'],['status', $this->activity]])->orWhere([['title','like', '%' . $request->search . '%'],['status', $this->hide]]);
                    break;
                default:
                    $reviews = Review::where('status', $this->activity)->orWhere('status', $this->hide);
                    break;
            }
            
            $data = $reviews->with(array(
                    'user' => function ($query) {
                        $query->select('id', 'first_name', 'last_name');
                    },
                    'post' => function ($query) {
                        $query->select('id', 'name');
                    }
                ))->orderBy('created_at', 'DESC')->paginate($request->count);

            return view('admin.review.table-data-review', ['listReview' => $data]);
        }

        $reviews = Review::where('status', $this->activity)->orWhere('status', $this->hide)
            ->with(array(
                'user' => function ($query) {
                    $query->select('id', 'first_name', 'last_name');
                },
                'post' => function ($query) {
                    $query->select('id', 'name');
                }
            ))->orderBy('created_at', 'DESC')->paginate($this->recordCount);

        return view('admin.review.list-review', ['listReview' => $reviews]); 
    }
}
