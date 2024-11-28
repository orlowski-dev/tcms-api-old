<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
                'roleId' => 'required|integer|exists:roles,id',
                'name' => 'required|min:3|max:50',
                'email' => 'required|email|max:150',
            ];
        } else {
            return [
                'roleId' => 'sometimes|required|integer|exists:roles,id',
                'name' => 'sometimes|required|min:3|max:50',
                'email' => 'sometimes|required|email|max:150',
            ];
        }
    }

    public function prepareForValidation()
    {
        $data = [];

        if ($this->roleId) {
            $data['role_id'] = $this->roleId;
        }

        $this->merge($data);
    }
}
