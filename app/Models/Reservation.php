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

        static::created(function ($reservation) {
            $reservation->addFirestore();
        });

        static::updated(function ($reservation) {
            $reservation->updateFirestore();
        });
    }

    protected function addFirestore()
    {
        $fireStoreService = app(FireStoreService::class);

        $data = $this->toArray();
        $data['user'] = $this->user()->first()->toArray();


        $docId = $fireStoreService->add(
            'reservations',
            $data
        );

        $this->update(['firestore_doc_id' => $docId]);
    }

    protected function updateFirestore()
    {
        $fireStoreService = app(FireStoreService::class);

        $data = $this->toArray();
        $data['user'] = $this->user()->first()->toArray();

        $fireStoreService->update(
            'reservations',
            $this->firestore_doc_id,
            $data
        );
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
