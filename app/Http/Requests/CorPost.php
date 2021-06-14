<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CorPost extends FormRequest
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

            'codigo' => 'required|string|alpha_num|unique:cores,codigo',
            'imgShirt' => 'required|image|max:8192',
            'nome' => ['required', 'string', Rule::unique('cores')->whereNull('deleted_at')],
        ];
    }

    public function messages()
    {
        return [
            'codigo.required' => 'Codigo cor é obrigatório',
            'codigo.alpha_num' => 'Codigo deve conter apenas letras ou números',
            'codigo.unique' => 'Codigo cor já existe',
            'imgShirt.required' => 'Imagem da t-shirt é obrigatória',
            'imgShirt.image' => 'Deve ser uma imagem válida',
            'imgShirt.max' => 'Tamanho da imagem n deve exceder os 8192KB',
            'nome.required' => 'Nome é obrigatório',
            'nome.unique' => 'Nome já existe',
        ];
    }
}
