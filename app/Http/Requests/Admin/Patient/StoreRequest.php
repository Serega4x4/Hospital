<?php

namespace App\Http\Requests\Admin\Patient;

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
            'address' => ['required', 'string'],
            'medical_history' => ['required', 'string'],
            'pesel' => ['required', 'string', 'size:11', 'regex:/^\d{11}$/', 'unique:users,pesel'],
            'email' => ['required', 'string', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }
}
