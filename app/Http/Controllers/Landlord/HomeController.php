<?php

namespace App\Http\Controllers\Landlord;

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
    public function index(): Response
    {
        return Inertia::render('website/home/Index');
    }
}
