<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DriverLocationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'latitude' => 'required',
            'longitude' => 'required',
        ];
    }
}
