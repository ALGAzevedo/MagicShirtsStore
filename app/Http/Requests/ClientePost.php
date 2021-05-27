<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientePost extends FormRequest
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
            'name' =>         'required',
            'endereco' => 'required',
            'bloqueado' =>     'required|in:1,0',
            'password' => [
                'required',
                ],
            'nif' => [
                'required',
                'numeric',
                'size:9'
            ],
            'tipo_pagamento' => 'required|in:LC,PAYPAL,VISA',
            'ref_pagamento' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->id),
            ],

            'foto' => 'nullable|image|max:8192', // Máximum size = 8Mb
        ];
    }
}
