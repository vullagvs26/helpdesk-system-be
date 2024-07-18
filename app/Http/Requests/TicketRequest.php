<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class TicketRequest extends FormRequest
{
    use ResponseTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => 'nullable|string',
            'email' => 'nullable|email',
            'ticket_no' => 'nullable|string',  // Not nullable as it is auto-generated
            'type_of_ticket' => 'nullable|string',
            'impact' => 'nullable|string',
            'status' => 'nullable|string',
            'description' => 'nullable|string',
            'remarks' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'system_name_id' => 'nullable|integer|exists:systems,id',
            'assigned_to_id' => 'nullable|integer|exists:developers,id',
            'started_at' => 'nullable|date',
            'completed_at' => 'nullable|date',
            'completed_time' => 'nullable|date_format:H:i',
        ];
    }

    public function messages(): array 
    {
        return [
           
            'full_name.string' => 'Full Name must be a string.',
           
            'email.email' => 'Email must be a valid email address.',
            'ticket_no.string' => 'Ticket number must be a string.',
            'type_of_ticket.required' => 'Type of ticket is required.',
            'type_of_ticket.string' => 'Type of ticket must be a string.',
            'impact.required' => 'Impact is required.',
            'impact.string' => 'Impact must be a string.',
            'status.required' => 'Status is required.',
            'status.string' => 'Status must be a string.',
            'description.required' => 'Description is required.',
            'description.string' => 'Description must be a string.',
            'remarks.string' => 'remarks must be a string.',
            'image.image' => 'Uploaded file must be an image (JPEG, PNG, JPG, GIF).',
            'image.mimes' => 'Image must be of type: jpeg, png, jpg, gif.',
            'image.max' => 'Image may not be greater than 2 MB in size.',
            'system_name_id.integer' => 'System name ID must be an integer.',
            'system_name_id.exists' => 'The selected system name is invalid.',
            'assigned_to_id.integer' => 'Assigned to ID must be an integer.',
            'assigned_to_id.exists' => 'The selected assigned to is invalid.',
            'assigned_to_id.integer' => 'Assigned to ID must be an integer.',
            'assigned_to_id.exists' => 'The selected assigned to is invalid.',
            'started_at.date' => 'Started At must be a valid date.',
            'completed_at.date' => 'Completed At must be a valid date.',
            'completed_time.date_format' => 'Completed Time must be in the format HH:MM.',
        ];
    }

    public function failedValidation(Validator $validator): array
    {
        $response = $this->failedValidationResponse($validator->errors());
        throw new HttpResponseException(response()->json($response, 200));
    }
}
