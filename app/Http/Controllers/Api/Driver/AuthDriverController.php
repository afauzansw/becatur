<?php

namespace App\Http\Controllers\Api\Driver;

use App\Contract\Auth\DriverAuthContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\DriverRegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Utils\WebResponse;
use Illuminate\Http\Request;

class AuthDriverController extends Controller
{
    protected DriverAuthContract $service;

    public function __construct(DriverAuthContract $service)
    {
        $this->service = $service;
    }

    public function attempt(LoginRequest $request)
    {
        $payload = $request->validated();
        $result = $this->service->login($payload);

        return WebResponse::json($result, 'Successfully login.');
    }

    public function store(DriverRegisterRequest $request)
    {
        $payload = $request->validated();
        $result = $this->service->register($payload);

        return WebResponse::json($result, 'Successfully register.');
    }

    public function logout()
    {
        $result = $this->service->logout();
        return WebResponse::json($result, 'Successfully logout.');
    }

    public function refreshToken()
    {
        $result = $this->service->logout();
        return WebResponse::json($result, 'Successfully refresh token.');
    }
}
