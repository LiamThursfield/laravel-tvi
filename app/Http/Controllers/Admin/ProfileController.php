<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Show the profile index.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return Inertia::render('admin/profile/Index', [
            'profile' => function () {
                return Auth::user();
            }
        ]);
    }
}
