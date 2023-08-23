<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "title" => "string|min:2",
            "body" => "required|string|min:40",
            "banner" => "string|nullable",
            "body" => "required|string|min:40",
            "type" => "string",
            "categories" => "array",
            "categories.*" => "numeric"
        ];
    }
}
