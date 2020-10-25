<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UserUpdateRequest;
use App\Interfaces\PermissionInterface;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::DELETE_USERS)
        )->only('destroy');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::EDIT_USERS)
        )->only(['edit', 'update']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::VIEW_USERS)
        )->only('index');
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
                'Deleting your own user is not allowed.'
            );
        }

        $user->delete();

        return Redirect::back(303)->with(
            'success',
            'User deleted.'
        );
    }

    public function edit(User $user)
    {
        return Inertia::render('admin/user/Edit', [
            'user' => function () use ($user) {
                return $user;
            }
        ]);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        // @TODO - Move this to an action so that Roles can be edited in the same endpoint
        $user->update($request->validated());
        return Redirect::to(route('admin.users.edit', $user))
            ->with('success', 'User updated.');
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
