<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
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
            'teacher'=>'required',
            'course_name'=>'required',
            'course_feature'=>'required',
            'course_description'=>'required',
            'total_lesson'=>'required',
            'course_length'=>'required',
            'language'=>'required',
            'difficultly'=>'required',
            'accessibility'=>'required',
            'currency'=>'required',
            'price'=>'required',
            'category'=>'required|integer',
            'sub_category'=>'nullable|integer',
            'tags'     => "required|array|min:1",
            "tags.*"   =>"required|distinct|min:1",
            'status'=>'required',
            'photo'=>'required|mimes:jpg,jpeg,png|max:1024',
        ];
    }
}
