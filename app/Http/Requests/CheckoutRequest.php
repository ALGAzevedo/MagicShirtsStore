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
            'nif' => 'nullable|numeric|digits:9',
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

}
