<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoriaPost extends FormRequest
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
            'nome' => ['required', 'string', Rule::unique('categorias')->whereNull('deleted_at')],
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Nome da categoria é um campo obrigatório',
            'nome.string' => 'Nome da categoria deve ser uma string',
            'nome.unique' => 'Nome da categoria já existe',
        ];
    }

}
