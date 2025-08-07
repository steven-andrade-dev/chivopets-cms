<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreSectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "id" => "required|integer",
            "title" => "required|string",
            "bloque_principal" => "required|string",
            "bloque_secundario" => "nullable|string",
            "url" => "nullable|string",
            "id_locale" => "nullable|integer",
            "carruselItems" => "nullable|array",
            "carruselItems.*.id" => "nullable|integer",
            "carruselItems.*.title" => "nullable|string",
            "carruselItems.*.description" => "nullable|string",
            "carruselItems.*.image" => "nullable|string",
            "carruselItems.*.url" => "nullable|string",
            "carruselItems.*.id_locale" => "nullable|string",
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'errorCode' => 2,
            'errors' => $validator->errors(),
            'msg' => 'Revisar campos obligatorios.'
        ], 422));
    }
}
