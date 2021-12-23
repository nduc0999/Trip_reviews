<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestPost extends FormRequest
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
            'name' => 'required|max:70',
            'id_location' => 'required|max:70',
            'streets' => 'required|max:70',
            'district' => 'required|max:70',
            'address' => 'required|max:150',
            'latitude' => 'required',
            'longtitude' => 'required',
            'open' => 'required|max:20',
            'closes' => 'required|max:20',
            'phone' => 'required|max:15',
            'min_guest' => 'required|max:4',
            'max_guest' => 'required|max:4',
            'introduce' => 'required',
            'email' => 'email|nullable|max:100',
            'link' => 'max:255',
            'amenity' => 'required',
            'roomtype' => 'required',
            'img_avatar' => 'required|max:255',
            'img_wall' => 'required|max:255',
            'photo' => 'required',
            'owner' => 'numeric',
        ];
    }

    public function messages(){
        return [
            'required' => 'Không được để trống ô nhập trên.',
            'id_location.required' => 'Cần chọn tỉnh/thành phố',
            'max' => 'Không vượt quá :max ký tự.',
            'email' => 'Không đúng định dạng email.',
            'amenity.required' => 'Cần chọn các loại tiện ích',
            'roomtype.required' => 'Cần chọn các loại phòng',
            'img_avatar.required' => 'Không được để ảnh đại diện trống',
            'img_wall.required' => 'Không đước để ảnh nền trống',
            'photo.required' => 'Cần cung cấp một số ảnh về Homestay - Resort',
            'owner.numeric' => 'Bạn phải xác nhận mình có là chủ',
        ];
    }
}
