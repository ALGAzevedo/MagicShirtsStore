<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserPost extends FormRequest
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
            'name' =>         'required',
            'tipo' =>        'required|in:A,F',
            'bloqueado' =>     'required|in:1,0',
            'newPassword' => ['required', 'string', 'min:8', 'confirmed'],
            'newPassword_confirmation' => ['required', 'string', 'min:8'],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->user_id),
            ],
            'foto' => 'nullable|image|max:8192', // Máximum size = 8Mb
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
            'name.required' => 'O campo nome é obrigatório.',

            'tipo.required' => 'O campo tipo é obrigatório.',
            'tipo.in' => 'O campo tipo tem que ser Administrador ou Funcionário.',

            'bloqueado.required' => 'O campo bloqueado é obrigatório.',

            'newPassword.required' => 'O campo password é obrigatório.',
            'newPassword.string' => 'O campo password tem que ser texto.',
            'newPassword.min' => 'O campo password tem que ter tamanho mínimo 8.',
            'newPassword.confirmed' => 'As passwords não coincidem.',

            'newPassword_confirmation.required' => 'O campo confirmação de password é obrigatório.',
            'newPassword_confirmation.string' => 'O campo confirmação de password tem que ser texto.',
            'newPassword_confirmation.min' => 'O campo confirmação de password tem que ter tamanho mínimo 8.',

            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O campo email tem que ser um email válido.',
            'email.unique' => 'O email que utilizou já existe.',

            'foto.image' => 'A foto tem que ser uma imagem.',
            'foto.max:8192' => 'A foto tem que ter tamanho máximo de 8Mb.',
        ];
    }
}
