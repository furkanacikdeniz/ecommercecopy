<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        //$user_id= $this->reques->get('user_id');
        return [
            "name" => "required",
            "slug"=> "required|sometimes|unique:App\Models\Category,slug,",
        ];
    }
    public function messages(): array
    {
        return [
            "name.required" => "Category name is required",
            "slug.required" => "Slug is required",
            "slug.unique" => "Slug must be unique",
        ];
    }
}
