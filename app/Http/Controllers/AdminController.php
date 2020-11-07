<?php

namespace App\Http\Controllers;

use App\Traits\Admin\InertiaMeta;

class AdminController extends Controller
{
    use InertiaMeta;

    public function __construct()
    {
        $this->initialiseMeta();
    }
}
