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
            $data = Question::where('status', 0)->orderBy('id', 'DESC')->paginate($request->count);
            return view('admin.question.table-data', ['arr_data' => $data]);
        }
        $data = Question::where('status', 0)->orderBy('id', 'DESC')->paginate($this->countRecord);
        return view('admin.question.manager-question', ['arr_data' => $data]);
    }


    public function update(Request $request)
    {
        try{
            $check = Question::where('question', 'like', $request->question)->where('status', 0)->first();
        }catch(Exception $e){
            return response()->json(['status' => false, 'mess' => 'Lỗi không xác định']);
        }
        if ($check) {
            return response()->json(['status' => false, 'mess' => 'Đã tồn tại câu hỏi']);
        }
        $question = Question::find($request->id);
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
}
