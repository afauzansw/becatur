<?php

namespace App\Http\Controllers\Api\User;

use App\Contract\Reservation\ReservationContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\CancelReservationRequest;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Utils\WebResponse;
use Illuminate\Support\Facades\Auth;

class ReservationUserController extends Controller
{
    protected ReservationContract $service;

    public function __construct(ReservationContract $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $condition = ['user_id', '=', Auth::guard('user')->id()];

        $result = $this->service->getWithCondition($condition, [], []);
        return WebResponse::json($result, 'Successfully get all user reservation.');
    }

    public function store(ReservationRequest $request)
    {
        $payloads = $request->validated();
        $payloads['user_id'] = Auth::guard('user')->id();
        $result = $this->service->create($payloads);
        return WebResponse::json($result, 'Successfully create user reservation.');
    }

    public function show(string $id)
    {
        $result = $this->service->find($id);
        return WebResponse::json($result, 'Successfully find user reservation.');
    }

    public function cancel(string $id, CancelReservationRequest $request)
    {
        $payloads = $request->validated();
        $payloads['status'] = Reservation::status['CANCEL_BY_CUSTOMER'];
        $result = $this->service->update($id, $payloads);
        return WebResponse::json($result, 'Successfully cancel reservation.');
    }

    public function payment(string $id)
    {
        $payloads['status'] = Reservation::status['PAID_BY_CUSTOMER'];

        $result = $this->service->update($id, $payloads);
        return WebResponse::json($result, 'Successfully paid reservation.');
    }
}
