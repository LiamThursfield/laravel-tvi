<?php

namespace App\Http\Controllers\Website;

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
        if (!config('tvi.web.enabled')) {
            return redirect(route('admin.index'));
        }

        return Inertia::render('website/home/Index');
    }
}
