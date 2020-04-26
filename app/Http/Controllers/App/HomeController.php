<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    /**
     * Show the application homepage.
     *
     * @return Response
     */
    public function index()
    {
        return Inertia::render('app/home/Index');
    }
}
