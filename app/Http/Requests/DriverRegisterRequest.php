<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DriverRegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:drivers,email',
            'phone' => 'required|string|unique:drivers,phone',
            'password' => 'required|string|min:8',
        ];
    }
}
