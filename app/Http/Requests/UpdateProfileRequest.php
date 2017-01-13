<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
class UpdateProfileRequest extends FormRequest
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
        $currentUser = Auth::user();
        return [
            'name' => ['required', 'min:6', 'max:70', 'unique:users,name,'.$currentUser->id, 'regex:/^[A-Za-z0-9][A-Za-z0-9_]{5,31}$/'],
            'email' => 'required|email|unique:users,email,'.$currentUser->id,
            'password' => 'min:6|confirmed',
        ];
    }
}
