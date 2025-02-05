<?php

namespace App\Http\Controllers\Web;

use App\Contract\Admin\AdminContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminWebController extends Controller
{
    protected AdminContract $service;

    public function __construct(AdminContract $service)
    {
        $this->service = $service;
    }

    public function fetch()
    {
        $data = $this->service->all([], [], true, []);
        return response()->json($data);
    }

    public function index()
    {
        return Inertia::render('admin/index');
    }
}
