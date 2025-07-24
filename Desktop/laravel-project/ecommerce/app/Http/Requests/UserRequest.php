<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $user_id = $this->request -> get("user_id");
        return [

            "name" =>"required|sometimes|min:3",
            "email" => "required|sometimes|email|unique:users,email,$user_id,user_id",
            "password" => "required|sometimes|string|min:5|confirmed"
        ];
    }
    public function messages()
    {
        return [
            "name.required" =>"İsim kısmını boş bırakamazsınız!",
            "name.min" =>"İsim alanı an az 3 karakterden oluşmalıdır!",
            "email.required"=>"Bu alan zorunludur.",
            "email.email"=>"Eposta formatına uygun şekilde mailinizi giriniz.",
            "email.unique"=>"Bu eposta adresi zaten kayıtlı.",
            "password.required" => "Şifreyi boş bırakamazsınız.",
            "password.min" => "Şifreniz az 5 karakterden oluşmalıdır.",
            "password.confirmed" => "Şifreler uyuşmamaktadır."
        ];
    }
}
