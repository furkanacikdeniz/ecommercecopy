<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Str;

class ProductRequest extends FormRequest
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
        return [
            "category_id" => "required|integer|exists:categories,category_id",
            "name" => "required|string|max:255",
            "price" => "required|numeric|min:0",
            "old_price" => "nullable|numeric|min:0",
            "lead" => "required|string|min:10",
        ];
    }
    public function messages(){
        return [
            "category_id.required" => "Category ID is required.",
            "category_id.integer" => "Category ID must be an integer.",
            "category_id.exists" => "The selected category does not exist.",
            "name.required" => "Product name is required.",
            "name.string" => "Product name must be a string.",
            "name.max" => "Product name may not be greater than 255 characters.",
            "price.required" => "Price is required.",
            "price.numeric" => "Price must be a number.",
            "price.min" => "Price must be at least 0.",
            "old_price.numeric" => "Old price must be a number.",
            "old_price.min" => "Old price must be at least 0.",
            "lead.required" => "Lead text is required.",
            "lead.string" => "Lead text must be a string.",
            "lead.min" => "Lead text may not be less than 10 characters."
        ];
    }
    protected function passedValidation()
    {
        if (!$this->request->has('slug')) {
            $name = $this->request->get('name');
            $slug = Str::of($name)->slug();
            $this->request->set('slug', $slug);
        }
    }
}
