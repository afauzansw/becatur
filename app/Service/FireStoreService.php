<?php

namespace App\Service;

use App\Contract\FireStoreContract;
use Exception;
use Kreait\Firebase\Factory;

class FireStoreService implements FireStoreContract
{
    protected $factory;
    protected $database;

    public function __construct()
    {
        $this->factory = (new Factory)->withServiceAccount(config('firebase.credentials'));
        $this->database = $this->factory->createFirestore()->database();
    }

    public function add($collection, $payloads)
    {
        try {
            $collection = $this->database->collection($collection);
            $doc = $collection->add($payloads);

            return $doc->id();
        } catch (Exception $exception) {
            return $exception;
        }
    }
}
