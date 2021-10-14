<?php

namespace App\Http\Requests\UserRequests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'username' => 'required|max:225',
            'email' => 'required|max:225|email|unique:user',
            'password' => 'required|min:6|max:16',
            'confirm_password' => 'required|min:6|max:16|same:password',
            'role' => 'required'
        ];
    }
}
