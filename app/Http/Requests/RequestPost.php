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
            'introduce' => 'required',
            'address' => 'required|max:150',
            'streets' => 'required|max:70',
            'district' => 'required|max:70',
            'id_location' => 'required|max:70',
            'link' => 'max:255',
            'open' => 'required|max:20',
            'closes' => 'required|max:20',
            'min_guest' => 'required|max:4',
            'max_guest' => 'required|max:4',
            'phone' => 'required|max:15',
            'latitude' => 'required',
            'longtitude' => 'required',
            'img_avatar' => 'required|max:255',
            'img_wall' => 'required|max:255',
            'email' => 'email|nullable|max:100',
            'amenity' => 'required',
            'photo' => 'required',
            'roomtype' => 'required',
        ];
    }

    public function messages(){
        return [
            'required' => 'Không được để trống ô nhập trên.',
            'max' => 'Không vượt quá :max ký tự.',
            'email' => 'Không đúng định dạng email.',
        ];
    }
}
