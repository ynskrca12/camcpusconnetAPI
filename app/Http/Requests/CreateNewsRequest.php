<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;

class CreateNewsRequest extends FormRequest
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
            'title' => 'required'
        ];
    }

    public function failedValidation(ValidationValidator $validator){
        throw new HttpResponseException(response()->json([
            'success' => false,
            'error' => true,
            'message' =>'Validasyon hatası',
            'errorsList' =>$validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'title.required' => 'Başlık alanı boş geçilemez.'
        ];
    }
}
