<?php

namespace App\Http\Controllers\Web;

use App\Contract\User\UserContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserWebController extends Controller
{
    protected UserContract $service;

    public function __construct(UserContract $service)
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
        return Inertia::render('user/index');
    }

    public function show($id)
    {
        $data = $this->service->find($id, []);
        return Inertia::render('user/show', [
            'user' => $data
        ]);
    }
}
