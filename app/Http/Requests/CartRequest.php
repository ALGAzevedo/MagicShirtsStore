<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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

    public function rules()
    {
        return [
            //'uuid' => 'required|string|max:255',
            //'nome' => 'required|string|max:255',
            'cor_codigo' => 'required|exists:cores,codigo',
            'estampa_id' => 'required|exists:estampas,id',
            'tamanho' => 'required|in:XS,S,M,L,XL',
            'quantidade' => 'required|integer|min:1',
            //'preco_un' => 'required|numeric',
            //'subtotal' => 'required|numeric',
            //'foto' => 'nullable|string',
        ];
    }
    public function messages()
    {
        return [
            'cor_codigo.required' => 'Código de cor é um campo obrigatório',
            'cor_codigo.exists' => 'Código de cor inválido',
            'estampa_id.required' => 'estampa_id é um campo obrigatório',
            'estampa_id.exists' => 'estampa_id inválida',
            'tamanho.required' => 'tamanho é um campo obrigatório',
            'tamanho.in' => 'Não é um tamanho válido',
            'quantidade.required' => 'quantidade  é um campo obrigatório',
            'quantidade.min' => 'quantidade  mínima é 1'
        ];
    }
}
