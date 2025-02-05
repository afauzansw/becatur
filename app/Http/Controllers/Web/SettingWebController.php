<?php

namespace App\Http\Controllers\Web;

use App\Contract\Setting\SettingContract;
use App\Http\Controllers\Controller;
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

    public function update()
    {
        $data = $this->service->update(1, []);
        return WebResponse::inertia($data, 'web.backoffice.setting.index');
    }
}
