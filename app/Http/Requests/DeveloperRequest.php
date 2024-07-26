<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DeveloperRequest extends FormRequest
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'position' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|string',

            'profile_photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
    public function messages(): array
    {
        return [
            'first_name.required' => 'First Name is required.',
            'first_name.string' => 'First Name must be a string.',
            'last_name.required' => 'Last Name is required.',
            'last_name.string' => 'Last Name must be a string.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid email address.',
            'position.required' => 'Position is required.',
            'position.string' => 'Position must be a string.',

            'description.string' => 'Description must be a string.',
            'status.required' => 'status is required.',
            'status.string' => 'status must be a string.',

            'profile_photo.image' => 'Uploaded file must be an image (JPEG, PNG, JPG, GIF).',
            'profile_photo.mimes' => 'Profile Photo must be of type: jpeg, png, jpg, gif.',
            'profile_photo.max' => 'Profile Photo may not be greater than 2 MB in size.',
        ];
    }

    public function failedValidation(Validator $validator): array
    {
        $response = $this->failedValidationResponse($validator->errors());
        throw new HttpResponseException(response()->json($response, 200));
    }
}
