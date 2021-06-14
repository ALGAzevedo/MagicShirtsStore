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
            'preco_un_catalogo' => 'required|numeric',
            'preco_un_proprio' => 'required|numeric',
            'preco_un_catalogo_desconto' => 'required|numeric',
            'preco_un_proprio_desconto' => 'required|numeric',
            'quantidade_desconto' => 'required|numeric',
        ];
    }


    public function messages()
    {
        return [
            'preco_un_catalogo.required' => 'Preço unitário catalogo é obrigatorio',
            'preco_un_catalogo.numeric' => 'Preço unitário catalogo deve ser do tipo númerico',
            'preco_un_proprio.required' => 'Preço unitário proprio é obrigatorio',
            'preco_un_proprio.numeric' => 'Preço unitário proprio deve ser do tipo númerico',
            'preco_un_catalogo_desconto.required' => 'Preço unitário catalogo desconto é obrigatorio',
            'preco_un_catalogo_desconto.numeric' => 'Preço unitário catalogo desconto deve ser do tipo númerico',
            'preco_un_proprio_desconto.required' => 'Preço unitário proprio desconto é obrigatorio',
            'preco_un_proprio_desconto.numeric' => 'Preço unitário proprio desconto deve ser do tipo númerico',
            'quantidade_desconto.required' => 'Quantidade desconto é obrigatorio',
            'quantidade_desconto.numeric' => 'Quantidade desconto deve ser do tipo númerico',

        ];
    }

}
