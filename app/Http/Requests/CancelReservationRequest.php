<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CancelReservationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'cancelation_reason' => 'required|string'
        ];
    }
}
