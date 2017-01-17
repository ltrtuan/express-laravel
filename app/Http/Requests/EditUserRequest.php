<?php

namespace App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
    public function rules(Request $request)
    {     
        $defaultArray =  [
                            'name' => ['required', 'min:6', 'max:40', 'unique:users,name,'.$request->get('id'), 'regex:/^[A-Za-z0-9][A-Za-z0-9_]{5,31}$/'],
                            'email' => 'required|email|unique:users,email,'.$request->get('id'),
                            'password' => 'min:6|confirmed',
                        ];

        if($this->get('role_id') == '2')
        {
            $defaultArray['extra_user_field.user_fullname'] = ['required', 'min:6', 'max:40', "regex:~^(?:[\p{L}\p{Mn}\p{Pd}\'\x{2019}]+\s?[\p{L}\p{Mn}\p{Pd}\'\x{2019}]+\s?)+$~u"];
            $defaultArray['extra_user_field.user_address'] = ['required'];
            $defaultArray['extra_user_field.user_phone'] = ['required'];
        }
        return $defaultArray;
    }

    public function messages()
    {
        return [
            'name.required' => trans('users.field_required',['field' => trans('users.name')]),
            'name.regex' => trans('users.name_invalid_format'),
            'name.min' => trans('users.string_min', ['field' => trans('users.name'), 'number' => 6]),
            'name.max' => trans('users.string_max', ['field' => trans('users.name'), 'number' => 40]),
            'name.unique' => trans('users.field_unique', ['field' => trans('users.name')]),           
            'email.required'  => trans('users.field_required', ['field' => trans('users.email')]),
            'email.email'  => trans('users.email_format', ['field' => trans('users.email')]),
            'email.unique'  => trans('users.field_unique', ['field' => trans('users.email')]),
            'password.required'  => trans('users.field_required',['field' => trans('users.password')]),
            'password.min' => trans('users.string_min', ['field' => trans('users.password'), 'number' => 6]),
            'password.confirmed' => trans('users.password_confirmed', ['field' => trans('users.password_confirmation')]),
            'country_id.required'  => trans('users.field_required',['field' => trans('users.country')]),
            'avatar.image' => trans('medias.image_format',['field' => trans('users.avatar')]),

            'extra_user_field.user_fullname.required'  => trans('users.field_required', ['field' => trans('users.fullname')]),
            'extra_user_field.user_fullname.min' => trans('users.string_min', ['field' => trans('users.fullname'), 'number' => 6]),
            'extra_user_field.user_fullname.max' => trans('users.string_max', ['field' => trans('users.fullname'), 'number' => 40]),
            'extra_user_field.user_fullname.regex' => trans('users.fullname_format'),

            'extra_user_field.user_address.required'  => trans('users.field_required', ['field' => trans('users.address')]),

            'extra_user_field.user_phone.required'  => trans('users.field_required', ['field' => trans('users.phone_number')]),
           
        ];
    }
}
