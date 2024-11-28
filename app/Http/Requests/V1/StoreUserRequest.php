<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'roleId' => 'required|integer|exists:roles,id',
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users|max:150',
            'password' => 'required|min:8|max:250'
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'role_id' => $this->roleId,
        ]);
    }
}
