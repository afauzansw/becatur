<?php

namespace App\Http\Controllers\Api\User;

use App\Contract\Setting\SettingContract;
use App\Http\Controllers\Controller;
use App\Utils\WebResponse;

class SettingUserController extends Controller
{
    protected SettingContract $service;

    public function __construct(SettingContract $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $result = $this->service->find(1);
        return WebResponse::json($result, 'Successfully get setting.');
    }
}
