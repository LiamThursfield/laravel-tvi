<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
 use App\Http\Requests\Admin\Profile\ProfileUpdateRequest;
use App\Interfaces\PermissionInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ProfileController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->addMetaTitleSection('Profile');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::EDIT_PROFILE)
        )->only(['edit', 'update']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::VIEW_PROFILE)
        )->only('index');
    }

    public function edit()
    {
        $this->addMetaTitleSection('Edit');
        $this->shareMeta();

        return Inertia::render('admin/profile/Edit', [
            'profile' => function () {
                return Auth::user();
            }
        ]);
    }

    public function index()
    {
        $this->shareMeta();
        return Inertia::render('admin/profile/Index', [
            'profile' => function () {
                return Auth::user();
            }
        ]);
    }

    public function update(ProfileUpdateRequest $request)
    {
        Auth::user()->update($request->validated());
        return Redirect::to(route('admin.profile.index'))->with('success', 'Profile updated.');
    }
}
