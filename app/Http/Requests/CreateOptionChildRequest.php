<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOptionChildRequest extends FormRequest
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
            'name_option' => ['required'],           
        ];
    }

    public function messages()
    {
        return [
            'name_option.required'  => trans('general.field_required', ['field' => trans('option.name_option')]),
        ];
    }
}
