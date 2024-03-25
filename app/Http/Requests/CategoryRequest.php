<?php

namespace App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
    public function rules(Request $request)
    {
        //'attr_image.*'  => 'mimes:jpg,jpeg,png',
        if($request->post('category_id')>0)
            $image_required = 'mimes:jpeg,jpg,png';
        else
            $image_required = '';
        return [
            'category_name' => 'required',
            'category_image' => $image_required,
            'category_slug' =>  'required|unique:categories,category_slug,'.$request->post('category_id'),
        ];
    }
}
