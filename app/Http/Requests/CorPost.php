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
            'codigo_picker' => 'nullable|string|unique:cores,codigo',
            'codigo_text' => 'required_if:codigo_picker,null|string|unique:cores,codigo',
            'nome' => ['required', 'string', Rule::unique('cores')->whereNull('deleted_at')],

        ];
    }
}
