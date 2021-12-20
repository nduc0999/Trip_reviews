<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Exception;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public $countRecord = 5;


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Question::where('status',0 )->orWhere('status', 2)->orderBy('id', 'DESC')->paginate($request->count);
            return view('admin.question.table-data', ['arr_data' => $data]);
        }
        $data = Question::where('status' , 0)->orWhere('status', 2)->orderBy('id', 'DESC')->paginate($this->countRecord);
        return view('admin.question.manager-question', ['arr_data' => $data]);
    }


    public function update(Request $request)
    {
        
        try{
            $check = Question::where('question', 'LIKE BINARY', $request->question)->where('status', 0)->first();
            $question = Question::find($request->id);

        }catch(Exception $e){
            return response()->json(['status' => false, 'mess' => 'Lỗi không xác định']);
        }
        if ($check) {
            return response()->json(['status' => false, 'mess' => 'Đã tồn tại câu hỏi']);
        }
  
        $question->question = $request->question;
        $question->save();
        return response()->json(['status' => true]);
    }

    public function store(Request $request)
    {
        $check = Question::where('question', 'like', $request->question)->where('status', 0)->first();
        if ($check) {
            return response()->json(['status' => false, 'mess' => 'Đã tồn tại câu hỏi']);
        }
        $question = Question::create($request->all());
        return response()->json(['status' => true]);
    }

    public function delete(Request $request)
    {
        if ($request->id) {
            $question = Question::find($request->id);
            $question->status = 1;
            $question->save();
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false, 'mess' => 'Xoá thất bại']);
    }

    public function activityQuestion(Request $request){
        if($request->id){
            try{
                $question = Question::find($request->id);
                $question->status = $question->status == 0 ? 2: 0;
                $question->save();
                return response()->json(['status' => true]);
            }catch(Exception $e){
                return response()->json(['status' => false,'mess' => 'Không tìm thấy id']);
            }

        }

        return response()->json(['status' => false, 'mess' => 'Không có id']);
    }
}
