<?php

namespace App\Service\Reservation;

use App\Contract\Reservation\ReservationContract;
use App\Models\Reservation;
use App\Service\BaseService;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Contract\Firestore;


class ReservationService extends BaseService implements ReservationContract
{
    protected array $relation = [];
    protected string|null $guard = null;
    protected string|null $guardForeignKey = null;
    protected array $fileKeys = [];
    protected Model $model;

    public function __construct(Reservation $model)
    {
        $this->model = $model;
        // $this->firestore = $firestore;
    }

    public function create($payloads)
    {
        try {
            if (!is_null($this->guardForeignKey)) {
                $payloads[$this->guardForeignKey] = $this->userID();
            }

            DB::beginTransaction();
            $model = $this->model->create($payloads);

            // $this->database->getReference('config/website')
            //     ->set([
            //         'name' => 'My Application',
            //         'emails' => 'sales@example.com',
            //         'website' => 'https://tes.tes.com',
            //     ]);


            DB::commit();

            return $model->fresh();
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
    }
}
