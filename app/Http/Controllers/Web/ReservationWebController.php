<?php

namespace App\Http\Controllers\Web;

use App\Contract\Reservation\ReservationContract;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Utils\WebResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;


class ReservationWebController extends Controller
{
    protected ReservationContract $service;

    public function __construct(ReservationContract $service)
    {
        $this->service = $service;
    }

    public function fetch()
    {
        $relations = ['user', 'driver'];

        $data = $this->service->all([], ['status', 'payment_status'], true, $relations);
        return response()->json($data);
    }

    public function index()
    {
        return Inertia::render('reservation/index');
    }

    public function show($id)
    {
        $data = $this->service->find($id, ["user", "driver"]);
        return Inertia::render('reservation/show', [
            'reservation' => $data
        ]);
    }

    public function acceptPayment($id)
    {
        $data = $this->service->approvePayment($id);
        return WebResponse::inertia($data, 'web.backoffice.reservation.index');
    }
}
