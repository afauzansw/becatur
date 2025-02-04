<?php

namespace App\Service\Reservation;

use App\Contract\Reservation\ReservationContract;
use App\Models\Reservation;
use App\Service\BaseService;
use Illuminate\Database\Eloquent\Model;

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
    }
}
