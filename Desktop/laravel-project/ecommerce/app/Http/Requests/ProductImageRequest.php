<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductImageRequest extends FormRequest
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
            "product_id"=> "required|numeric",
            "image_url" =>"required|image|mimes:jpeg,png,jpg",
        ];
    }
    public function messages()
    {
        return [
            "product_id.required" =>"Ürün ID'si zorunludur!",
            "product_id.numeric" =>"Bu alan sadece sayısal değer alabilir!",
            "image_url.required"=> "Bu alan zorunludur!",
            "image_url.image" => "Yüklenen dosya bir resim olmalıdır!",
            "image_url.mimes" => "Yüklenen resim sadece jpeg, png veya jpg formatında olmalıdır!",
        ];
    }
}
