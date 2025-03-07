<?php

namespace App\Service\Driver;

use App\Contract\Driver\DriverContract;
use App\Models\Driver;
use App\Models\Reservation;
use App\Service\BaseService;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DriverService extends BaseService implements DriverContract
{
    protected array $relation = [];
    protected string|null $guard = null;
    protected string|null $guardForeignKey = null;
    protected array $fileKeys = [];
    protected Model $model;

    public function __construct(Driver $model)
    {
        $this->model = $model;
    }

    public function setOnlineStatus()
    {
        try {
            DB::beginTransaction();

            $id = Auth::guard('driver')->id();

            $model = $this->model->find($id);
            $model->update(['is_online' => !$model->is_online]);

            DB::commit();

            return $model->first();
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    public function getAvailable($latitude, $longitude)
    {
        try {
            $radius = 10;

            $available = Driver::query()
                ->selectRaw("*, (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance", [$latitude, $longitude, $latitude])
                ->where('is_online', true)
                ->whereRelation('reservation', 'status', '=', Reservation::status['CANCEL_BY_CUSTOMER'])
                ->orWhereDoesntHave('reservation')
                ->having('distance', '<=', $radius) // filter drivers within 10 km radius
                ->orderBy('distance') // optional, if you want to prioritize nearest drivers
                ->first();

            if (!$available) {
                throw new Exception("No available drivers found in the specified radius.");
            }

            return $available; // Return the nearest available driver
        } catch (Exception $e) {
            return $e;
        }
    }

    public function updateLocation($payloads)
    {
        try {
            $id = Auth::guard('driver')->id();

            $model = $this->model->find($id);
            $model->update($payloads);

            return $model;
        } catch (Exception $e) {
            return $e;
        }
    }
}
