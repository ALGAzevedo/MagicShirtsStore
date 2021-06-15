<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CheckoutRequest extends FormRequest
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
    public function rules(Request $request){

        $validation_array = [
            'nif' => 'required|numeric|digits:9',
            'endereco' => 'required|string|max:255',
            'tipo_pagamento' => 'required|in:MC,PAYPAL,VISA',
            'notas' => 'nullable|string',
        ];

        if ($request->tipo_pagamento == 'MC' || $request->tipo_pagamento == 'VISA') {
            $validation_array = array_merge($validation_array, [
                'ref_pagamento' => 'required|numeric|digits:16',
            ]);
        }
        if ($request->tipo_pagamento == 'PAYPAL') {
            $validation_array = array_merge($validation_array, [
                'ref_pagamento' => 'required|email',
            ]);
        }
        return $validation_array;
    }


    public function messages()
    {

        return [
            'nif.numeric' => 'NIF deve conter apenas números.',
            'nif.required' => 'NIF é um campo obrigatório.',
            'nif.digits' => 'NIF deve conter 9 dígitos.',

            'endereco.string' => 'Endereço deve ser uma string.',
            'endereco.max' => 'Endereço deve conter no máximo 255 caracteres.',

            'notas.string' => 'O campo notas deve ser apenas texto.',

            'tipo_pagamento.required' => 'Tipo de pagamento é obrigatório.',

            'ref_pagamento.required' => 'Referência de pagamento é obrigatória.',
            'ref_pagamento.numeric' => 'Referência de pagamento é um campo numérico.',
            'ref_pagamento.digits' => 'Referência de pagamento deve conter 16 digitos.',
            'ref_pagamento.email' => 'Referência de pagamento deve se rum email válido.',
        ];
    }

}
