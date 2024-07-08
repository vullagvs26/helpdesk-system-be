<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class TicketRequest extends FormRequest
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
        'ticket_no' => 'required|integer',
        'type_of_ticket' => 'required|string',
        'impact' => 'required|string',
        'status' => 'required|string',
        'description' => 'required|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'full_name_id' => 'required|integer|exists:users,id',
        'email_id' => 'required|email|exists:users,id',
        'system_name_id' =>'required|integer|exists:systems,id',
        'assigned_to_id' => 'required|integer||exists:developers,id',
        ];
    }

    public function messages(): array 
    {
        return [
            'ticket_no.required' => 'ticket number is required.',
            'ticket_no.integer' => 'ticket number must be a integer.',
            'type_of_ticket.required' => 'type of ticket is required.',
            'type_of_ticket.string' => 'type of ticket must be a string.',
            'impact.required' => 'impact is required.',
            'impact.string' => 'impact must be a string.',
            'status.required' => 'status is required.',
            'status.string' => 'status must be a string.',
            'description.required' => 'description is required.',
            'description.string' => 'description must be a string.',
            'image.required' => 'Image is required.',
            'image.image' => 'Uploaded file must be an image (JPEG, PNG, JPG, GIF).',
            'image.mimes' => 'Image must be of type: jpeg, png, jpg, gif.',
            'image.max' => 'Image may not be greater than 2 MB in size.',
            'full_name_id.required' => 'Full name ID is required.',
            'full_name_id.integer' => 'Full name ID must be an integer.',
            'full_name_id.exists' => 'The selected full name is invalid.',
            'email_id.required' => 'Email ID is required.',
            'email_id.email' => 'Email ID must be a valid email address.',
            'email_id.exists' => 'The selected email is invalid.',
            'system_name_id.required' => 'System name ID is required.',
            'system_name_id.integer' => 'System name ID must be an integer.',
            'system_name_id.exists' => 'The selected system name is invalid.',
            'assigned_to_id.required' => 'Assigned to ID is required.',
            'assigned_to_id.integer' => 'Assigned to ID must be an integer.',
            'assigned_to_id.exists' => 'The selected assigned to is invalid.',
        ];
    }

    public function failedValidation(Validator $validator): array{
        $response = $this->failedValidationResponse($validator->errors());
        throw new HttpResponseException(response()->json($response, 200));
    }
}   