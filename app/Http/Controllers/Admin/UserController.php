<?php

namespace App\Http\Controllers\Admin;

use App\Actions\User\UserQueryAction;
use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\User\UserIndexRequest;
use App\Http\Requests\Admin\User\UserStoreRequest;
use App\Http\Requests\Admin\User\UserUpdateRequest;
use App\Interfaces\PermissionInterface;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Http\Request;

class UserController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->addMetaTitleSection('Users');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::CREATE_USERS)
        )->only(['create', 'store']);

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

    public function create()
    {
        $this->addMetaTitleSection('Create')->shareMeta();
        return Inertia::render('admin/user/Create');
    }

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
        $this->addMetaTitleSection('Edit - ' . $user->name)->shareMeta();

        return Inertia::render('admin/user/Edit', [
            'user' => function () use ($user) {
                return $user;
            }
        ]);
    }

    public function index(UserIndexRequest $request)
    {
        $search_options = $request->validated();
        $search_options['per_page'] = Arr::get($search_options, 'per_page', 15);

        $this->shareMeta();
        return Inertia::render('admin/user/Index', [
            'search_options' => $search_options,
            'users' => function () use ($search_options) {
                return app(UserQueryAction::class)->handle($search_options)
                    ->paginate(Arr::get($search_options, 'per_page'));
            }
        ]);
    }

    public function store(UserStoreRequest $request)
    {
        // @TODO - Move this to an action so that Roles can be edited in the same endpoint
        $user = User::create($request->validated());
        return Redirect::to(route('admin.users.edit', $user))
            ->with('success', 'User created.');
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        // @TODO - Move this to an action so that Roles can be edited in the same endpoint
        $user->update($request->validated());
        return Redirect::to(route('admin.users.edit', $user))
            ->with('success', 'User updated.');
    }
}
