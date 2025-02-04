<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public const status = [
        'created' => 'CREATED',
        'cancel_by_customer' => 'CANCEL_BY_CUSTOMER',
        'accept_by_driver' => 'ACCEPT_BY_DRIVER',
        'reject_by_driver' => 'REJECT_BY_DRIVER',
        'paid' => 'PAID',
    ];
}
