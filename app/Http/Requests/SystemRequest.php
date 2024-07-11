<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SystemRequest extends FormRequest
{
    use ResponseTrait;
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
            'system_name' => 'required|string',
            'published_at' => 'required|date_format:Y-m-d',
            'developed_by' => 'string',
            'description' => 'required|string',
            'status' => 'required|string',
        ];
    }

    
    public function messages(): array 
    {
        return [
            'system_name.required' => 'System Name is required.',
            'system_name.string' => 'System Name must be a string.',
            'published_at.required' => 'Published Date is required.',
            'published_at.date_format' => 'Published Date must be a valid date in the format YYYY-MM-DD.',
            //'developed_by.required' => 'Developed By is required.',
            'developed_by.string' => 'Developed By must be a string.',
            'description.required' => 'Description is required.',
            'description.string' => 'Description must be a string.',
            'status.required' => 'status is required.',
            'status.string' => 'status must be a string.',
        ];
    }

    public function failedValidation(Validator $validator): array{
        $response = $this->failedValidationResponse($validator->errors());
        throw new HttpResponseException(response()->json($response, 200));
    }
}
