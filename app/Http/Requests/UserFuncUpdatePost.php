<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
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
        return Auth::check();
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

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'oldPassword.required' => 'O campo password antiga é obrigatório.',

            'newPassword.required' => 'O campo nova password é obrigatório.',
            'newPassword.string' => 'O campo nova password tem que ser texto.',
            'newPassword.min' => 'O campo nova password tem que ter tamanho mínimo 8.',
            'newPassword.confirmed' => 'As passwords não coincidem.',

            'newPassword_confirmation.required' => 'O campo confirmação de password é obrigatório.',
            'newPassword_confirmation.string' => 'O campo confirmação de password tem que ser texto.',
            'newPassword_confirmation.min' => 'O campo confirmação de password tem que ter tamanho mínimo 8.',
        ];
    }
}
