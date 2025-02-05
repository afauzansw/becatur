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

        $data = $this->service->all([], ['true'], true, $relations);
        return response()->json($data);
    }

    public function index()
    {
        return Inertia::render('reservation/index');
    }

    public function show($id)
    {
        $data = $this->service->find($id, []);
        return Inertia::render('reservation/show', [
            'kol' => $data
        ]);
    }

    public function acceptPayment($id)
    {
        $data = $this->service->update($id, ['status' => Reservation::status['paid_success']]);
        return WebResponse::inertia($data, 'web.backoffice.reservation.index');
    }
}
