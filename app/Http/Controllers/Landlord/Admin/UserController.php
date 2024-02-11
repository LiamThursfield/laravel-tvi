<?php

namespace App\Http\Controllers\Landlord\Admin;

use App\Actions\Landlord\User\UserQueryAction;
use App\Actions\Landlord\User\UserStoreAction;
use App\Actions\Landlord\User\UserUpdateAction;
use App\Http\Controllers\AdminController;
use App\Http\Requests\Landlord\Admin\User\UserIndexRequest;
use App\Http\Requests\Landlord\Admin\User\UserStoreRequest;
use App\Http\Requests\Landlord\Admin\User\UserUpdateRequest;
use App\Interfaces\AppInterface;
use App\Interfaces\Landlord\PermissionInterface;
use App\Models\Landlord\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

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

    public function create() : Response
    {
        $this->addMetaTitleSection('Create')->shareMeta();
        return Inertia::render('admin/user/Create', [
            'selectableRoles' => function () {
                return Auth::user()->getSelectableRoles(true, true);
            }
        ]);
    }

    public function destroy(Request $request, User $user) : RedirectResponse
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

    public function edit(User $user) : Response
    {
        $user->load('roles');

        $this->addMetaTitleSection('Edit - ' . $user->name)->shareMeta();
        return Inertia::render('admin/user/Edit', [
            'selectableRoles' => function () {
                return Auth::user()->getSelectableRoles(true, true);
            },
            'user' => function () use ($user) {
                TenantEditResource::withoutWrapping();
                return TenantEditResource::make($user);
            }
        ]);
    }

    public function index(UserIndexRequest $request) : Response
    {
        $search_options = $request->validated();

        $this->shareMeta();
        return Inertia::render('admin/user/Index', [
            'searchOptions' => $search_options,
            'users' => function () use ($search_options) {
                return app(UserQueryAction::class)->handle($search_options)
                    ->paginate(AppInterface::getSearchPaginationParam($search_options));
            }
        ]);
    }

    public function store(UserStoreRequest $request) : RedirectResponse
    {
        $user = app(UserStoreAction::class)->handle($request->validated());
        return Redirect::to(route('landlord.admin.users.edit', $user))
            ->with('success', 'User created.');
    }

    public function update(UserUpdateRequest $request, User $user) : RedirectResponse
    {
        app(UserUpdateAction::class)->handle($user, $request->validated());
        return Redirect::to(route('landlord.admin.users.edit', $user))
            ->with('success', 'User updated.');
    }
}
