<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrecoPost extends FormRequest
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
            'preco_un_catalogo' => 'required|numeric|min:1',
            'preco_un_proprio' => 'required|numeric|min:1',
            'preco_un_catalogo_desconto' => 'required|numeric|min:1',
            'preco_un_proprio_desconto' => 'required|numeric|min:1',
            'quantidade_desconto' => 'required|numeric|min:0',
        ];
    }


    public function messages()
    {
        return [
            'preco_un_catalogo.required' => 'Preço unitário catálogo é obrigatorio.',
            'preco_un_catalogo.numeric' => 'Preço unitário catálogo deve ser do tipo númerico.',
            'preco_un_catalogo.min' => 'Preço unitário catálogo deve ser igual ou maior que 1.',

            'preco_un_proprio.required' => 'Preço unitário próprio é obrigatorio.',
            'preco_un_proprio.numeric' => 'Preço unitário próprio deve ser do tipo númerico.',
            'preco_un_proprio.min' => 'Preço unitário próprio deve ser igual ou maior que 1.',

            'preco_un_catalogo_desconto.required' => 'Preço unitário catálogo desconto é obrigatorio.',
            'preco_un_catalogo_desconto.numeric' => 'Preço unitário catálogo desconto deve ser do tipo númerico.',
            'preco_un_catalogo_desconto.min' => 'Preço unitário catálogo deve ser igual ou maior que 1.',

            'preco_un_proprio_desconto.required' => 'Preço unitário próprio desconto é obrigatorio.',
            'preco_un_proprio_desconto.numeric' => 'Preço unitário próprio desconto deve ser do tipo númerico.',
            'preco_un_proprio_desconto.min' => 'Preço unitário próprio desconto deve ser igual ou maior que 1.',


            'quantidade_desconto.required' => 'Quantidade desconto é obrigatorio.',
            'quantidade_desconto.numeric' => 'Quantidade desconto deve ser do tipo númerico.',
            'quantidade_desconto.min' => 'Preço unitário próprio desconto deve ser igual ou maior que 0.',

        ];
    }

}
