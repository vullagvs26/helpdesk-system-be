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
            'code_name' => 'nullable|string',
            'system_name' => 'required|string',
            'owner' => 'nullable|string',
            'release' => 'nullable|string',
            'type' => 'nullable|string',
            'deployment' => 'nullable|string',
            'language' => 'nullable|string',
            'framework' => 'nullable|string',
            'database' => 'nullable|string',
            'support_section' => 'nullable|string',
            'support_developer' => 'nullable|string',
            'published_at' => 'nullable|date_format:Y-m-d',
            'developed_by' => 'nullable|string',
            'description' => 'nullable|string',
            'status' => 'nullable|string',
            'support_primary' => 'nullable|string',
            'support_secondary' => 'nullable|string',
            'support_tertiary' => 'nullable|string',
            'originay_date' => 'nullable|date_format:Y-m-d',
            'portal_date' => 'nullable|date_format:Y-m-d',
            'prod_path' => 'nullable|string',
            'prod_webserver' => 'nullable|string',
            'prod_database' => 'nullable|string',
            'dev_url' => 'nullable|string',
            'dev_web' => 'nullable|string',
            'dev_database' => 'nullable|string',
            'back_up_url' => 'nullable|string',
            'back_up_web' => 'nullable|string',
            'back_up_database' => 'nullable|string',
            'git_name' => 'nullable|string',
            'git_server' => 'nullable|string',
            'ssi_status' => 'nullable|string',
            'ssi_remarks' => 'nullable|string',
            'ongoing_activity' => 'nullable|string',
            'developer_id' => 'nullable|exists:developers,id',
        ];
    }

    
    public function messages(): array 
    {
        return [
           'code_name.string' => 'Code Name must be a string.',
            'system_name.required' => 'System Name is required.',
            'system_name.string' => 'System Name must be a string.',
            'owner.string' => 'Owner must be a string.',
            'release.string' => 'Release must be a string.',
            'type.string' => 'Type must be a string.',
            'deployment.string' => 'Deployment must be a string.',
            'language.string' => 'Language must be a string.',
            'framework.string' => 'Framework must be a string.',
            'database.string' => 'Database must be a string.',
            'support_section.string' => 'Support Section must be a string.',
            'support_developer.string' => 'Support Developer must be a string.',
            'published_at.date_format' => 'Published Date must be a valid date in the format YYYY-MM-DD.',
            'developed_by.string' => 'Developed By must be a string.',
            'description.string' => 'Description must be a string.',
            'status.string' => 'Status must be a string.',
            'support_primary.string' => 'Support Primary must be a string.',
            'support_secondary.string' => 'Support Secondary must be a string.',
            'support_tertiary.string' => 'Support Tertiary must be a string.',
            'originay_date.date_format' => 'Originay Date must be a valid date in the format YYYY-MM-DD.',
            'portal_date.date_format' => 'Portal Date must be a valid date in the format YYYY-MM-DD.',
            'prod_path.string' => 'Production Path must be a string.',
            'prod_webserver.string' => 'Production Webserver must be a string.',
            'prod_database.string' => 'Production Database must be a string.',
            'dev_url.string' => 'Development URL must be a string.',
            'dev_web.string' => 'Development Web must be a string.',
            'dev_database.string' => 'Development Database must be a string.',
            'back_up_url.string' => 'Backup URL must be a string.',
            'back_up_web.string' => 'Backup Web must be a string.',
            'back_up_database.string' => 'Backup Database must be a string.',
            'git_name.string' => 'Git Name must be a string.',
            'git_server.string' => 'Git Server must be a string.',
            'ssi_status.string' => 'SSI Status must be a string.',
            'ssi_remarks.string' => 'SSI Remarks must be a string.',
            'ongoing_activity.string' => 'Ongoing Activity must be a string.',
            'developer_id.exists' => 'The selected developer is invalid.',
        ];
    }

    public function failedValidation(Validator $validator): array{
        $response = $this->failedValidationResponse($validator->errors());
        throw new HttpResponseException(response()->json($response, 200));
    }
}
