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
            // básicos del caso
            'name'         => ['required','string','max:255'],

            // imágenes opcionales como string/URL (ajusta a 'url' si quieres ser estricto)
            'image'        => ['nullable','string','max:2048'],
            'image_author' => ['nullable','string','max:2048'],

            'author'       => ['nullable','string','max:255'],
            'area'         => ['nullable','string','max:255'],
            'introduction' => ['nullable','string'],

            // 👇 tu modelo usa id_locale (no 'locale')
            'id_locale'    => ['required','integer'],

            // opcionales según tu DB
            'date'         => ['nullable','date'],
            'text_button'  => ['nullable','string','max:255'],

            // 👇 NO se debe enviar al crear el case (la descripción vive en otra tabla)
            'id_description' => ['prohibited'],
            'locale'         => ['prohibited'],
        ];
    }

    // (opcional) mensajes más claros
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
