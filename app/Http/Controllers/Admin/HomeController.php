<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    /**
     * Show the admin index.
     *
     * @return Response
     */
    public function index()
    {
        return Inertia::render('admin/home/Index');
    }
}
