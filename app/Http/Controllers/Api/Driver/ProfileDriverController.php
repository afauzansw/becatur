<?php

namespace App\Http\Controllers\Api\Driver;

use App\Contract\Auth\DriverAuthContract;
use App\Contract\Driver\DriverContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\DriverLocationRequest;
use App\Http\Requests\DriverProfileRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Utils\WebResponse;
use Illuminate\Http\Request;

class ProfileDriverController extends Controller
{
    protected DriverAuthContract $service;
    protected DriverContract $driver;

    public function __construct(DriverAuthContract $service, DriverContract $driver)
    {
        $this->service = $service;
        $this->driver = $driver;
    }

    public function index()
    {
        $result = $this->service->profile();
        return WebResponse::json($result, 'Successfully get profile.');
    }

    public function update(DriverProfileRequest $request)
    {
        $result = $this->service->update($request->validated());
        return WebResponse::json($result, 'Successfully update profile.');
    }

    public function changeOnlineStatus()
    {
        $result = $this->driver->setOnlineStatus();
        return WebResponse::json($result, 'Successfully update profile.');
    }

    public function updateLocation(DriverLocationRequest $request)
    {
        $result = $this->driver->updateLocation($request->validated());
        return WebResponse::json($result, 'Successfully update profile.');
    }
}
