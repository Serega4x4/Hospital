<?php

namespace App\Http\Requests\Admin\Doctor;

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
        $userId = $this->route('doctor');
        return [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'speciality' => ['required', 'string'],
            'pesel' => ['required', 'string', 'size:11', 'regex:/^\d{11}$/', Rule::unique('users', 'pesel')->ignore($userId)],
            'email' => ['required', 'string', Rule::unique('users', 'email')->ignore($userId)],
            'password' => ['nullable', 'string', 'min:8'],
            'appointment_duration' => ['nullable', 'integer', 'min:5', 'max:60'],
            'hours' => ['nullable', 'array'],
            'hours.*.*' => ['nullable', 'regex:/^\d{2}:\d{2}-\d{2}:\d{2}$/'],
        ];
    }
}
