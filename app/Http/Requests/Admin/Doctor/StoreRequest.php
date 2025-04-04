<?php

namespace App\Http\Requests\Admin\Doctor;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'speciality' => ['required', 'string'],
            'pesel' => ['required', 'string', 'size:11', 'regex:/^\d{11}$/', 'unique:users,pesel'],
            'email' => ['required', 'string', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'appointment_duration' => ['nullable', 'integer', 'min:5', 'max:60'],
            'hours' => ['nullable', 'array'],
            'hours.*.*' => ['nullable', 'regex:/^\d{2}:\d{2}-\d{2}:\d{2}$/'],
        ];
    }
}
