<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteEstampaRequest extends FormRequest
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
            'nome' => 'required|string|max:255',
            'estampa_update' => 'nullable',
            'estampa_img' => 'required_if:estampa_update,true|image|max:8192',
            'descricao' => 'nullable|string',
        ];
    }


    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string' => 'O campo nome tem que ser texto.',
            'nome.max' => 'O campo nome tem que ter no máximo 255 caracteres.',

            'estampa_img.required_if' => 'A imagem da estampa é obrigatória.',
            'estampa_img.image' => 'A imagem da estampa tem que ser uma imagem.',
            'estampa_img.max' => 'A imagem pode ter no máximo 8Mb.',

            'descricao' => 'A descrição tem que ser texto.',
        ];
    }

}
