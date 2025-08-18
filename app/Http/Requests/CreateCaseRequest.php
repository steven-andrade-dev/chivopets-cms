<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'name'         => ['required','string','max:255'],
            'image'        => ['nullable','string','max:2048'],
            'image_author' => ['nullable','string','max:2048'],
            'author'       => ['nullable','string','max:255'],
            'area'         => ['nullable','string','max:255'],
            'introduction' => ['nullable','string'],
            'id_locale'    => ['required','integer'],
            'date'         => ['nullable','date'],
            'text_button'  => ['nullable','string','max:255'],
            'id_description' => ['prohibited'],
            'locale'         => ['prohibited'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'      => 'El título (name) es obligatorio.',
            'id_locale.required' => 'El idioma (id_locale) es obligatorio.',
            'id_description.prohibited' => 'id_description no debe enviarse al crear el caso.',
            'locale.prohibited'        => 'Usa id_locale en lugar de locale.',
        ];
    }
}
