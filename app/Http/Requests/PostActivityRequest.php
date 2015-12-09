<?php

namespace WebCoding\Http\Requests;

use Auth;
use Illuminate\Auth\Access\Gate;
use WebCoding\Http\Requests\Request;

class PostActivityRequest extends Request
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
            'content'   =>  'required|max:1000'
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
            'content.required'  =>  'Le contenu ne peut être vide',
            'content.max'       =>  'Le contenu ne peut excéder :max caractères'
        ];
    }
}
