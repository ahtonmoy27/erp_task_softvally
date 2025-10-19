<?php

namespace App\Http\Requests;

use App\Traits\Api\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ApprovalRequestStoreRequest extends FormRequest
{
    use ApiResponseTrait;
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'amount' => 'required|numeric|min:0',
            'department_id' => 'required|exists:departments,id',
        ];
    }

    public function messages(): array
    {
        return [
            'amount.required' => 'The amount field is required.',
            'amount.numeric' => 'The amount must be a numeric value.',
            'amount.min' => 'The amount must be at least 0.',
            'department_id.required' => 'The department field is required.',
            'department_id.exists' => 'The selected department is invalid.',
        ];
    }

    public function getData(): array
    {
        return $this->validated();

    }
    protected function failedValidation(Validator $validator)
    {

        $response = $this->sendResponse(422, 'Validation errors', null, $validator->errors());
     
        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
