<?php

namespace App\Http\Controllers\Student\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('student/admin/home/Index');
    }
}