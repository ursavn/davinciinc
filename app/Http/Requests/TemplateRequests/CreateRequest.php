<?php

namespace App\Http\Requests\TemplateRequests;

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
            'name' => 'required|max:225',
            'description' => 'max:2000',
            'category_id' => 'required',
            'img_url' => 'required',
            'html_url' => 'required'
        ];
    }
}
