<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOptionChildRequest extends FormRequest
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
        foreach($this->request->get('name_option') as $idOption => $nameOption)
        {
            $rules['name_option.'.$idOption] = 'required';
        }       
        return $rules;
    }

    public function messages()
    {
        return [
            'name_option.*.required' => trans('general.field_required',['field' => trans('option.name_option')]),
        ];
    }
}
