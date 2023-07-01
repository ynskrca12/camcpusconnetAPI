<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;

class RegisterUSer extends FormRequest
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
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',

        ];
    }

    public function failedValidation(ValidationValidator $validator){
        throw new HttpResponseException(response()->json([
            'success' => false,
            'status_code' => 422,
            'error' => true,
            'message' =>'Validasyon hatası',
            'errorsList' =>$validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'name.required' => 'İsim alanı boş geçilemez.',
            'email.required' => 'E-mail alanı boş geçilemez.',
            'name.unique' => 'Bu email kullanılıyor.',
            'password.required' => 'Şifre alanı boş bırakılamaz.',
        ];
    }
}
