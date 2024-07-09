<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
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
            'full_name' => 'required|string',
            'email' => 'required|string',
            'position' => 'required|string',

        ];
    }

    public function messages(): array 
    {
        return [
            
            'full_name.required' => 'Full Name is required.',
            'full_name.string' => 'Full Name must be a string.',
            'email.required' => 'email is required.',
            'email.string' => 'email must be a string.',
            'position.required' => 'Position is required.',
            'position.string' => 'Position must be a string.',
        ];
    }

    public function failedValidation(Validator $validator): array{
        $response = $this->failedValidationResponse($validator->errors());
        throw new HttpResponseException(response()->json($response, 200));
    }
}
