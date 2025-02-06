<?php

namespace App\Contract;

interface FireStoreContract
{
    public function add($collection, $payloads);
}
