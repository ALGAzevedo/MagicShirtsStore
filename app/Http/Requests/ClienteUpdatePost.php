<?php

namespace App\Http\Requests;


use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class ClienteUpdatePost extends FormRequest
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
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function rules(Request $request)
    {

        $validation_array = [
            'name' => 'required',
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
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->user_id),
            ],

            'foto' => 'nullable|image|max:8192', // Máximum size = 8Mb
        ];

        if ($request['tipo_pagamento'] == 'MC' || $request['tipo_pagamento'] == 'VISA') {
            $validation_array += [
                'ref_pagamento' => ['required', 'numeric', 'digits:16'],
            ];
        }
        if ($request['tipo_pagamento'] == 'PAYPAL') {
            $validation_array += [
                'ref_pagamento' => ['required', 'email'],
            ];
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

            'endereco.string' => 'O campo endereço tem que ser texto.',
            'endereco.max' => 'O campo endereço tem um limite de 255 caracteres.',

            'tipo.required' => 'O campo tipo é obrigatório.',
            'tipo.in' => 'O campo tipo tem que ser Cliente.',

            'nif.numeric' => 'O campo NIF tem que ser numérico.',
            'nif.digits' => 'O campo NIF tem que ter exatamente 9 dígitos.',

            'bloqueado.required' => 'O campo bloqueado é obrigatório.',
            'bloqueado.in' => 'O campo bloqueado tem que ser 1 ou 0.',

            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O campo email tem que ser um email válido.',
            'email.unique' => 'O email que utilizou já existe.',

            'tipo_pagamento.in' => 'O campo tipo pagamento tem que ser MC,VISA ou PAYPAL.',

            'ref_pagamento.required' => 'O campo referência de pagamento é obrigatório.',
            'ref_pagamento.email' => 'A referência de pagamento deve ser o seu email do PayPal.',
            'ref_pagamento.numeric' => 'A referência de pagamento deve ser o seu número do cartão de crédito.',
            'ref_pagamento.digits' => 'O número do seu cartão deve ter 16 digitos.',

            'foto.image' => 'A foto tem que ser uma imagem.',
            'foto.max:8192' => 'A foto tem que ter tamanho máximo de 8Mb.',
        ];
    }
}
