<?php

namespace App\Http\Controllers\Api\User;

use App\Contract\Auth\UserAuthContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Utils\WebResponse;
use Illuminate\Http\Request;

class ProfileUserController extends Controller
{
    protected UserAuthContract $service;

    public function __construct(UserAuthContract $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $result = $this->service->profile();
        return WebResponse::json($result, 'Successfully get profile.');
    }

    public function update(ProfileUpdateRequest $request)
    {
        $result = $this->service->update($request->validated());
        return WebResponse::json($result, 'Successfully update profile.');
    }
}
