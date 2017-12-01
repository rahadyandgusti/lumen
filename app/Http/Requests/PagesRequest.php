<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PagesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::guard();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $lastId = \Request::segment(2);
        $rules['content'] = 'required';
        $rules['title'] = 'required|unique:pages,title';
        if (is_numeric($lastId)) {
            $rules['title'] = 'required|unique:pages,title,'.$lastId;
        }
        return [];
    }
}
