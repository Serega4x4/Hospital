<?php

namespace App\Http\Requests\Admin\Administrator;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('administrator');
        return [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'pesel' => ['required', 'string', 'size:11', 'regex:/^\d{11}$/', Rule::unique('users', 'pesel')->ignore($userId)],
            'email' => ['required', 'string', Rule::unique('users', 'email')->ignore($userId)],
            'password' => ['nullable', 'string', 'min:8'],
        ];
    }
}
