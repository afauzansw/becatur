<?php

namespace App\Models;

use App\Service\FireStoreService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public const status = [
        'CREATED' => 'CREATED',
        'CANCEL_BY_CUSTOMER' => 'CANCEL_BY_CUSTOMER',
        'ACCEPT_BY_DRIVER' => 'ACCEPT_BY_DRIVER',
        'REJECT_BY_DRIVER' => 'REJECT_BY_DRIVER',
        'PAID_BY_CUSTOMER' => 'PAID_BY_CUSTOMER',
        'PAID_SUCCESS' => 'PAID_SUCCESS',
        'PICKUP_BY_DRIVER' => 'PICKUP_BY_DRIVER',
        'SUCCESS' => 'SUCCESS',
    ];

    public const paymentStatus = [
        'UNPAID' => 'UNPAID',
        'PAID' => 'PAID',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($reservation, FireStoreService $fireStoreService) {
            $docId = $fireStoreService->add('reservations', $reservation->toArray());

            $reservation->update(['doc_id' => $docId]);
        });

        static::updating(function ($reservation, FireStoreService $fireStoreService) {
            $fireStoreService->update(
                'reservations',
                $reservation->firestore_doc_id,
                $reservation->toArray()
            );
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
