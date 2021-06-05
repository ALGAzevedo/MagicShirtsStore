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
            'nome' => 'required|string|max:255',
            'cliente_id' => 'nullable|exists:clientes,id',
            'categoria_id' => 'nullable|exists:categorias,id',
            'estampa_update' => 'nullable',
            'estampa_img' => 'required_if:estampa_update,true|image|max:8192',
            'descricao' => 'nullable|string',
        ];
    }


}
