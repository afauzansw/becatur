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

    public function add($name, $payloads)
    {
        try {
            $payloads = array_filter($payloads, function ($value) {
                return $value !== null;
            });

            $collection = $this->database->collection($name);
            $doc = $collection->add($payloads);

            return $doc->id();
        } catch (Exception $exception) {
            return $exception;
        }
    }

    public function update($collectionName, $docId, $payloads)
    {
        try {
            $payloads = array_filter($payloads, function ($value) {
                return $value !== null;
            });

            $collection = $this->database->collection($collectionName);

            $doc = $collection->document($docId);
            $doc->set($payloads);

            return $doc->id();
        } catch (Exception $exception) {
            return $exception;
        }
    }
}
