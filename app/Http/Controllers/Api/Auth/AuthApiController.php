<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Utils\WebResponse;
use App\Contract\Auth\UserAuthContract;
use App\Http\Requests\Auth\LoginRequest;

class AuthApiController extends Controller
{
    protected UserAuthContract $service;

    public function __construct(UserAuthContract $service)
    {
        $this->service = $service;
    }

    public function attempt(LoginRequest $request)
    {
        $payload = $request->validated();
        $result = $this->service->login($payload);

        return WebResponse::json($result, 'Successfully login.');
    }

    public function store(UserRegisterRequest $request)
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
}
