<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
     * @return array
     */
    public function rules()
    {

        $data['tipo_ref'] = 'true';
        if ($data['tipo_pagamento'] == "") {
            $data['tipo_ref'] = 'false';
        }

        $validation_array = [
            'name' => 'required',
            'endereco' => 'required',
            'bloqueado' => 'required|in:1,0',
            'password' => [
                'nullable',
                'min:4'
            ],
            'nif' => [
                'nullable',
                'numeric',
                'digits:9',
            ],
            'endereco' => [
                'nullable',
                'string',
                'max:255',
            ],
            'password' => 'nullable',
            'tipo_pagamento' => 'nullable|in:MC,PAYPAL,VISA',
            'ref_pagamento' => 'required_if:tipo_ref, true',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->user_id),
            ],

            'foto' => 'nullable|image|max:8192', // Máximum size = 8Mb
        ];

        if ($this->input('tipo_pagamento') == 'MC' || $this->input('tipo_pagamento') == 'VISA') {
            $validation_array = array_merge($validation_array, [
                'ref_pagamento' => 'required_if:tipo_pagamento', 'numeric', 'digits:9',
            ]);
        }
        if ($this->input('tipo_pagamento') == 'PAYPAL') {
            $validation_array = array_merge($validation_array, [
                'ref_pagamento' => 'required_if:tipo_pagamento', 'email',
            ]);
        }

        return $validation_array;
    }
}
