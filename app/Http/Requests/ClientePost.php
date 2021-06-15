<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;


class ClientePost extends FormRequest
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
    public function rules(Request $request)
    {
        $flag = 'true';
        dd($request['tipo_pagamento']);
        if($request['tipo_pagamento'] == ""){
            $flag = 'false';
        }

        $validation_array = [
            'name' => 'required',
            'endereco' => 'required',
            'bloqueado' => 'required|in:1,0',
            'tipo' => 'required|in:C',
            'password' => [
                'required'
            ],
            'nif' => [
                'nullable',
                'numeric',
                'digits:9'
            ],
            'endereco' => [
                'nullable',
                'string',
                'max:255',
            ],
            'tipo_pagamento' => 'nullable|in:MC,PAYPAL,VISA',
            'ref_pagamento' => 'required_if:flag, true',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->user_id),
            ],

            'foto' => 'nullable|image|max:8192', // Máximum size = 8Mb
        ];

        if ($this->input('tipo_pagamento') == 'MC' || $this->input('tipo_pagamento') == 'VISA') {
            $validation_array = array_merge($validation_array, [
                'ref_pagamento' => 'required_if:flag, true', 'numeric', 'digits:9',
            ]);
        }
        if ($this->input('tipo_pagamento') == 'PAYPAL') {
            $validation_array = array_merge($validation_array, [
                'ref_pagamento' => 'required_if:flag, true', 'email',
            ]);
        }
        return $validation_array;
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

            'endereco.required' => 'O campo endereço é obrigatório.',

            'tipo.required' => 'O campo tipo é obrigatório.',
            'tipo.in' => 'O campo tipo tem que ser Cliente.',

            'bloqueado.required' => 'O campo bloqueado é obrigatório.',
            'bloqueado.in' => 'O campo bloqueado tem que ser 1 ou 0.',

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
