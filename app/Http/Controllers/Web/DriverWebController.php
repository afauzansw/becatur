<?php

namespace App\Http\Controllers\Web;

use App\Contract\Driver\DriverContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DriverWebController extends Controller
{
    protected DriverContract $service;

    public function __construct(DriverContract $service)
    {
        $this->service = $service;
    }

    public function fetch()
    {
        $relations = [];

        $data = $this->service->all([], [], true, $relations);
        return response()->json($data);
    }

    public function index()
    {
        return Inertia::render('driver/index');
    }

    public function show($id)
    {
        $data = $this->service->find($id, []);
        return Inertia::render('driver/show', [
            'driver' => $data
        ]);
    }
}
