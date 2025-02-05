<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BackofficeWebController extends Controller
{
    public function index()
    {
        return Inertia::render('home');
    }
}
