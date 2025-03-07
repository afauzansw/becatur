<?php

namespace App\Contract\Driver;

use App\Contract\BaseContract;

interface DriverContract extends BaseContract
{
    public function setOnlineStatus();
    public function getAvailable($reservation);
    public function updateLocation($payloads);
}
