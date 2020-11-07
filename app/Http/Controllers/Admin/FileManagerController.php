<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

class FileManagerController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->addMetaTitleSection('File Manager');
    }

    /**
     * Show the file manager index.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->shareMeta();
        return Inertia::render('admin/file_manager/Index');
    }
}
