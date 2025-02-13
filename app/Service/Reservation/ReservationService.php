<?php

namespace App\Service\Reservation;

use App\Contract\Driver\DriverContract;
use App\Contract\FireStoreContract;
use App\Contract\Reservation\ReservationContract;
use App\Models\Reservation;
use App\Service\BaseService;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class ReservationService extends BaseService implements ReservationContract
{
    protected array $relation = [];
    protected string|null $guard = null;
    protected string|null $guardForeignKey = null;
    protected array $fileKeys = [];
    protected Model $model;
    protected DriverContract $driver;
    protected FireStoreContract $firestore;

    public function __construct(Reservation $model, DriverContract $driver, FireStoreContract $firestore)
    {
        $this->model = $model;
        $this->driver = $driver;
        $this->firestore = $firestore;
    }

    public function create($payloads)
    {
        try {
            if (!is_null($this->guardForeignKey)) {
                $payloads[$this->guardForeignKey] = $this->userID();
            }

            DB::beginTransaction();
            $model = $this->model->create($payloads);

            $payloads['created_at'] = date('Y-m-d H:i:s');

            $this->firestore->add('reservations', $payloads);

            DB::commit();

            return $model->fresh();
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    public function approvePayment($id)
    {
        try {

            $driverId = $this->driver->getAvailable();

            DB::beginTransaction();

            $model = $this->model->find($id);

            $model->update([
                'driver_id' => $driverId,
                'payment_status' => Reservation::paymentStatus['PAID'],
            ]);

            DB::commit();

            return $model->fresh();
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
    }
}
