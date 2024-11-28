<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
        if ($this->method() == 'PUT') {
            return [
                'phoneNumber' => 'min:9|max:31|nullable',
                'address' => 'min:3|max:60|nullable',
                'city' => 'min:3|max:50|nullable',
                'postalCode' => 'min:5|max:12|nullable'
            ];
        } else {
            return [
                'phoneNumber' => 'sometimes|min:9|max:31|nullable',
                'address' => 'sometimes|min:3|max:60|nullable',
                'city' => 'sometimes|min:3|max:50|nullable',
                'postalCode' => 'sometimes|min:5|max:12|nullable'
            ];
        }
    }

    public function prepareForValidation()
    {
        $data = [];

        if ($this->phoneNumber) {
            $data['phone_number'] = $this->phoneNumber;
        }

        if ($this->postalCode) {
            $data['postal_code'] = $this->postalCode;
        }

        $this->merge($data);
    }
}
