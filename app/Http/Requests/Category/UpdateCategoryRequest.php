<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
           "name" => "string|unique:categories,name",
           "description" =>"string"
        ];
    }

     public function messages():array
    {
    return [
        "name.string" => "El nombre debe ser un texto",
        "name.unique" => "Ya existe una categoria con ese nombre",
        "description.string" => "La descripcion debe ser texto"
    ];
    }
}
