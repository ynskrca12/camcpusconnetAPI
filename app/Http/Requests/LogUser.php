<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;

class LogUser extends FormRequest
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
            'email' => 'required|email|exists:users,email',
            'password' =>'required'
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
            'email.required' => 'E-mail alanı boş geçilemez.',
            'email.email' => 'Lütfe email formatı girin.',
            'email.exists' => 'Böyle bir email bulunamadı.',
            'password.required' => 'Şifre alanı boş bırakılamaz.',
        ];
    }
}
