<?php

namespace WebCoding\Http\Requests;

use Auth;
use WebCoding\Http\Requests\Request;

class ReplyActivityRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if( Auth::check() ) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'reply'   =>  'required|max:10000',
        ];
    }

    /**
     * Get the validation messages that apply to the request
     *
     * @return array
     */
    public function messages()
    {
        return [
            'reply.required'  =>  'Le commentaire ne peut être vide',
            'reply.max'       =>  'Le commentaire ne peut excéder :max caractères'
        ];
    }
}
