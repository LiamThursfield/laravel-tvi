<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:delete users')->only('delete');
        $this->middleware('can:view users')->only('index');
    }


    /**
     * Delete a user.
     * @param Request $request
     * @param User $user
     */
    public function destroy(Request $request, User $user)
    {
        if (auth()->user()->id === $user->id) {
            return Redirect::back(303)->with(
                'error',
                'Deleting own user is not allowed.'
            );
        }

        $user->delete();

        return Redirect::back(303)->with(
            'success',
            'User deleted.'
        );
    }

    /**
     * Show the user index.
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
