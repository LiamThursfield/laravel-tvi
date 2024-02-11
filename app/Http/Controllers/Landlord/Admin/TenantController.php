<?php

namespace App\Http\Controllers\Landlord\Admin;

use App\Actions\Landlord\Tenant\TenantQueryAction;
use App\Actions\Landlord\Tenant\TenantStoreAction;
use App\Actions\Landlord\Tenant\TenantUpdateAction;
use App\Http\Controllers\AdminController;
use App\Http\Requests\Landlord\Admin\Tenant\TenantIndexRequest;
use App\Http\Requests\Landlord\Admin\Tenant\TenantStoreRequest;
use App\Http\Requests\Landlord\Admin\Tenant\TenantUpdateRequest;
use App\Http\Resources\Landlord\Admin\Tenant\TenantResource;
use App\Interfaces\AppInterface;
use App\Interfaces\Landlord\PermissionInterface;
use App\Models\Tenant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class TenantController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->addMetaTitleSection('Tenants');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::CREATE_TENANTS)
        )->only(['create', 'store']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::DELETE_TENANTS)
        )->only('destroy');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::EDIT_TENANTS)
        )->only(['edit', 'update']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::VIEW_TENANTS)
        )->only('index');
    }

    public function create() : Response
    {
        $this->addMetaTitleSection('Create')->shareMeta();
        return Inertia::render('admin/tenant/Create');
    }

    public function destroy(Request $request, Tenant $tenant) : RedirectResponse
    {
        $tenant->delete();

        return Redirect::back(303)->with(
            'success',
            'Tenant deleted.'
        );
    }

    public function edit(Tenant $tenant) : Response
    {
        $this->addMetaTitleSection('Edit - ' . $tenant->id)->shareMeta();
        return Inertia::render('admin/tenant/Edit', [
            'tenant' => function () use ($tenant) {
                $tenant->load('domains');
                TenantResource::withoutWrapping();
                return TenantResource::make($tenant);
            }
        ]);
    }

    public function index(TenantIndexRequest $request) : Response
    {
        $search_options = $request->validated();

        $this->shareMeta();
        return Inertia::render('admin/tenant/Index', [
            'searchOptions' => $search_options,
            'tenants' => function () use ($search_options) {
                return app(TenantQueryAction::class)->handle($search_options)
                    ->paginate(AppInterface::getSearchPaginationParam($search_options));
            }
        ]);
    }

    public function store(TenantStoreRequest $request) : RedirectResponse
    {
        $tenant = app(TenantStoreAction::class)->handle($request->validated());
        return Redirect::to(route('landlord.admin.tenants.edit', $tenant))
            ->with('success', 'Tenant created.');
    }

    public function update(TenantUpdateRequest $request, Tenant $tenant) : RedirectResponse
    {
        app(TenantUpdateAction::class)->handle($tenant, $request->validated());
        return Redirect::to(route('landlord.admin.tenants.edit', $tenant))
            ->with('success', 'Tenant updated.');
    }
}
