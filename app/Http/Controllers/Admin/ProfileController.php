<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
 use App\Http\Requests\Admin\Profile\ProfileUpdateRequest;
use App\Interfaces\PermissionInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::EDIT_PROFILE)
        )->only(['edit', 'update']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::VIEW_PROFILE)
        )->only('index');
    }

    public function edit()
    {
        return Inertia::render('admin/profile/Edit', [
            'profile' => function () {
                return Auth::user();
            }
        ]);
    }

    public function index()
    {
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
