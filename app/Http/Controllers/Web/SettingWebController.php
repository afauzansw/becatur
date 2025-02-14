<?php

namespace App\Http\Controllers\Web;

use App\Contract\Setting\SettingContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Utils\WebResponse;
use Inertia\Inertia;

class SettingWebController extends Controller
{
    protected SettingContract $service;

    public function __construct(SettingContract $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $data = $this->service->find(1);
        return Inertia::render('setting/index', ["setting" => $data]);
    }

    public function update(SettingRequest $request)
    {
        // return $request->validated();
        return $data = $this->service->update(1, $request->validated());
        // return WebResponse::inertia($data, 'web.backoffice.setting.index');
    }
}
