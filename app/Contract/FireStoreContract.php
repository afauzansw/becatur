<?php

namespace App\Contract;

interface FireStoreContract
{
    public function add($collection, $payloads);

    public function update($collectionName, $docId, $payloads);

    public function delete($collectionName, $docId);
}
