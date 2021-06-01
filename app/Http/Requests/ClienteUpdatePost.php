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
        if($data['tipo_pagamento'] == ""){
            $data['tipo_ref'] = 'false';
        }

        return [
            'name' => 'required',
            'endereco' => 'required',
            'bloqueado' => 'required|in:1,0',
            'nif' => [
                'required',
                'numeric',
                'digits:9',
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
    }
}
