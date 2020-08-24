<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Show the admin index.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return Inertia::render('admin/user/Index', [
            'users' => function () use ($request) {
                return User::orderBy('first_name')
                    ->orderBy('last_name')
                    ->paginate($request->get('per_page'));
            }
        ]);
    }
}
