<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'travel_costs' => 'nullable|integer',
            'platform_costs' => 'nullable|integer',
            'qris_image' => ['nullable'],
        ];
    }
}
