<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstampaPost extends FormRequest
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
            'nome' => 'required|string|max:70',
            'cliente_id' => 'nullable|exists:clientes,id',
            'categoria_id' => 'nullable|exists:categorias,id',
            'estampa_update' => 'nullable',
            'estampa_img' => 'required_if:estampa_update,true|image|max:8192',
            'descricao' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Nome da estampa é obrigatório.',
            'nome.string' => 'Nome deve ser uma string.',
            'nome.max' => 'Nome deve conter no Maximo 70 caracteres.',
            'categoria_id.exists' => 'Categoria não existe.',
            'estampa_img.required_if' => 'Uma imagem para a estampa deve ser carregada.',
            'estampa_img.image' => 'Deve ser uma imagem válida.',
            'descricao.max' => 'Descrição deve conter no máximo 255 caracteres.',
        ];
    }


}
