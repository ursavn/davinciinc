<?php

namespace App\Http\Requests\AuthRequests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'password' => 'required|min:6|max:16|confirmed',
            'password_confirmation' => 'required|min:6|max:16',
        ];
    }
}
