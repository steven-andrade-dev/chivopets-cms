<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "image" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "image_author" => "required|string",
            "author" => "required|string",
            "area" => "required|string",
            "name" => "required|string",
            "introduction" => "required|string",
            "id_description" => "required|integer",
            "date" => "required|date",
            "text_button" => "required|string",
            "locale" => "required|string",
        ];
    }
}
