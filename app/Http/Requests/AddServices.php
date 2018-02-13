<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddServices extends Request
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
            'name'=>'required|min:7|max:200',
            'des'=>'required|min:50|max:2000',
            'cat_id'=>'required|integer',
            'price'=>'required|integer',
            'image' => 'dimensions:min_width=300,min_height=300,max=1000,max=1000',

        ];
    }
}
