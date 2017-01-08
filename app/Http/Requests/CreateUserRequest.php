<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Factory as ValidationFactory;

class CreateUserRequest extends FormRequest
{
    public function __construct(ValidationFactory $validationFactory)
    {
       

    }


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
            'name' => ['required', 'min:6', 'max:70', 'unique:users,name', 'regex:/^[A-Za-z0-9][A-Za-z0-9_]{5,31}$/'],
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ];
    }

    /**
     * Custom message of validation when create user
     */
    public function messages()
    {
        return [
            'name.required' => trans('users.field_required',['field' => trans('users.name')]),
            'name.regex' => trans('users.name_invalid_format'),
            'name.min' => trans('users.string_min', ['field' => trans('users.name'), 'number' => 6]),
            'name.max' => trans('users.string_max', ['field' => trans('users.name'), 'number' => 70]),
            'name.unique' => trans('users.field_unique', ['field' => trans('users.name')]),
            'fullname.required'  => trans('users.field_required', ['field' => trans('users.fullname')]),
            'fullname.min' => trans('users.string_min', ['field' => trans('users.fullname'), 'number' => 6]),
            'fullname.max' => trans('users.string_max', ['field' => trans('users.fullname'), 'number' => 40]),
            'fullname.regex' => trans('users.fullname_format'),
            'email.required'  => trans('users.field_required', ['field' => trans('users.email')]),
            'email.email'  => trans('users.email_format', ['field' => trans('users.email')]),
            'email.unique'  => trans('users.field_unique', ['field' => trans('users.email')]),
            'password.required'  => trans('users.field_required',['field' => trans('users.password')]),
            'password.min' => trans('users.string_min', ['field' => trans('users.password'), 'number' => 6]),
            'password.confirmed' => trans('users.password_confirmed', ['field' => trans('users.password_confirmation')]),
            'country_id.required'  => trans('users.field_required',['field' => trans('users.country')]),
            'avatar.image' => trans('medias.image_format',['field' => trans('users.avatar')])
        ];
    }
}
