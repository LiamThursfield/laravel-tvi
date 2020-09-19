<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

class FileManagerController extends Controller
{
    /**
     * Show the file manager index.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return Inertia::render('admin/file_manager/Index');
    }
}
