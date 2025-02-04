<?php

namespace App\Http\Controllers\Web;

use App\Contract\Auth\AdminAuthContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Utils\WebResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthWebController extends Controller
{
    protected AdminAuthContract $service;

    public function __construct(AdminAuthContract $service)
    {
        $this->service = $service;
    }

    public function login()
    {
        if (Auth::guard('admin')->check()) return redirect(route('web.backoffice.index'));
        return Inertia::render('auth/login');
    }

    public function attempt(LoginRequest $request)
    {
        $payload = $request->validated();
        $result = $this->service->login($payload);

        return WebResponse::inertia($result, 'web.backoffice.index');
    }

    public function logout()
    {
        $result = $this->service->logout();
        return WebResponse::inertia($result, 'web.auth.login');
    }
}
