<?php

namespace App\Http\Requests;

use App\Models\Driver;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DriverProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(Driver::class)->ignore(Auth::guard('driver')->id())],
            'phone' => 'required'
        ];
    }
}
