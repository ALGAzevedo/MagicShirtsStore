<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EncomendaUpdatePost extends FormRequest
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
            'estado' => 'required|string|in:paga,fechada,anulada',
        ];
    }

    public function messages()
    {
        return [
            'estado.required' => 'Estado da encomenda é obrigatório.',
            'estado.string' => 'Estado deve ser uma string.',
            'estado.in' => 'Estado deve ser paga, fechada ou anulada.',
        ];
    }
}
