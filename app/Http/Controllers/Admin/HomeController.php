<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends AdminController
{
    /**
     * Show the admin index.
     *
     * @return Response
     */
    public function index()
    {
        $this->shareMeta();
        return Inertia::render('admin/home/Index');
    }
}
