<?php

namespace App\Http\Controllers\Api\Driver;

use App\Contract\Reservation\ReservationContract;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Utils\WebResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationDriverController extends Controller
{
    protected ReservationContract $service;

    public function __construct(ReservationContract $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $condition = ['driver_id', '=', Auth::guard('driver')->id()];

        $result = $this->service->getWithCondition($condition, [], []);
        return WebResponse::json($result, 'Successfully get all driver reservation.');
    }

    public function show(string $id)
    {
        $result = $this->service->find($id);
        return WebResponse::json($result, 'Successfully find driver reservation.');
    }

    public function accept(string $id)
    {
        $payloads['status'] = Reservation::status['accept_by_driver'];

        $result = $this->service->update($id, $payloads);
        return WebResponse::json($result, 'Successfully accept reservation.');
    }

    public function reject(string $id)
    {
        $payloads['status'] = Reservation::status['reject_by_driver'];

        $result = $this->service->update($id, $payloads);
        return WebResponse::json($result, 'Successfully reject reservation.');
    }
}
