<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MessagesRequest extends Request
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
            'message'=>'required|min:5|max:500',
            'title'=>'required|min:5|max:50',
            'user_id'=>'required|integer',
        ];
    }
}
