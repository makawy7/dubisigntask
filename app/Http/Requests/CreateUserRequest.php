<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_type' => ['required', 'string', 'in:standard,certified,locationed'],
            'username' => ['required', 'string', 'unique:users,username'],
            'email' => ['required', 'string', 'email', 'unique:users,email'],
            'bio' => ['nullable', 'string'],
            'map_location' => ['required_if:user_type,locationed', 'string'],
            'date_of_birth' => ['required_if:user_type,locationed', 'date'],
            'cert_name' => ['required_if:user_type,certified', 'string'],
            'file_path' => ['required_if:user_type,certified', 'string'],
        ];
    }
}
