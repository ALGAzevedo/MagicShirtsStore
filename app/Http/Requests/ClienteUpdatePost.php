<?php

namespace App\Http\Requests;


use Illuminate\Support\Facades\Validator;
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
        return true;
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
            'bloqueado' => 'required|in:1,0',
            'tipo' => 'required|in:C',
            'password' => [
                'required',
                'min:4'
            ],
            'nif' => [
                'nullable',
                'string',
                'size:9'
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

    public function messages()
    {
        return [
            'ref_pagamento.required' => 'O campo referência de pagamento é obrigatório.',
            'ref_pagamento.email' => 'A referência de pagamento deve ser o seu email do PayPal.',
            'ref_pagamento.numeric' => 'A referência de pagamento deve ser o seu número do cartão de crédito',
            'ref_pagamento.digits' => 'O número do seu cartão deve ter 16 digitos',
        ];
    }
}
