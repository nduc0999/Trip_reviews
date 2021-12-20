<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestReview extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'comment' => 'required|min:200',
            'rate' => 'required',
            'title' => 'required|max:150|min:5',
            'trip_when' => 'required|max:70',
            'trip_type' => 'required',
            'rate_service' => 'required',
            'rate_value' => 'required',
            'rate_sleep' => 'required',
            'terms' => 'required',
            'id_post' => 'required|numeric',
            
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Không được để trống ô nhập trên.',
            'max' => 'Không vượt quá :max ký tự.',
            'min' => 'Cần nhập tối thiểu :min ký tự',
            'rate.required' => 'Bạn cần phải đánh giá sao.',
            'rate_service.required' => 'Bạn cần phải đánh giá sao.',
            'rate_value.required' => 'Bạn cần phải đánh giá sao.',
            'rate_sleep.required' => 'Bạn cần phải đánh giá sao.',
            'trip_type.required' => 'Hãy chọn loại chuyến đi.',
            'trip_when.required' => 'Hãy chọn khoảng thời gian đi.',
            'terms.required' => 'Bạn có đồng ý điều khoản.',
            'id_post.required' => 'Không tìm thấy ID.',
        ];
    }
}
