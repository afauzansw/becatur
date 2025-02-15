<?php

namespace App\Contract\Reservation;

use App\Contract\BaseContract;

interface ReservationContract extends BaseContract
{
    public function approvePayment($id);

    public function finish($id);
}
