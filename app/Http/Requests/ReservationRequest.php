<?php

namespace App\Http\Requests;

use App\Traits\ApiValidator;
use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    use ApiValidator;

    public function rules(): array
    {
        return [
            // 'driver_id' => 'required|exists:drivers,id',
            'start_address' => 'required|string',
            'start_latitude' => 'required|numeric|between:-90,90',
            'start_longitude' => 'required|numeric|between:-180,180',
            'mid_address' => 'nullable|string',
            'mid_latitude' => 'nullable|numeric|between:-90,90',
            'mid_longitude' => 'nullable|numeric|between:-180,180',
            'end_address' => 'required|string',
            'end_latitude' => 'required|numeric|between:-90,90',
            'end_longitude' => 'required|numeric|between:-180,180',
            'total_price' => 'required|integer',
        ];
    }
}
