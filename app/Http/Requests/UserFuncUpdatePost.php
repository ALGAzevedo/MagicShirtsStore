<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserFuncUpdatePost extends FormRequest
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
            'oldPassword' =>     'required',
            'newPassword' =>     ['required', 'string', 'min:8', 'confirmed'],
            'newPassword_confirmation' =>     ['required', 'string', 'min:8'],
        ];
    }
}
