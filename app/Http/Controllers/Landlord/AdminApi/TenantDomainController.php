<?php

namespace App\Http\Controllers\Landlord\AdminApi;

use App\Actions\Landlord\Tenant\TenantDomainStoreAction;
use App\Actions\Landlord\Tenant\TenantUpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Landlord\Admin\Tenant\TenantDomainStoreRequest;
use App\Http\Requests\Landlord\Admin\Tenant\TenantDomainUpdateRequest;
use App\Http\Resources\Landlord\Admin\Tenant\TenantDomainResource;
use App\Interfaces\Landlord\PermissionInterface;
use App\Models\Tenant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Stancl\Tenancy\Database\Models\Domain;

class TenantDomainController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::CREATE_TENANTS)
        )->only(['store']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::DELETE_TENANTS)
        )->only('destroy');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::EDIT_TENANTS)
        )->only(['update']);
    }

    public function destroy(Request $request, Tenant $tenant, Domain $domain) : JsonResponse
    {
        $domain->delete();

        return response()->json([
            'success' => true
        ]);
    }

    public function store(TenantDomainStoreRequest $request, Tenant $tenant): TenantDomainResource
    {
        $domain = app(TenantDomainStoreAction::class)->handle($tenant, $request->validated());
        return TenantDomainResource::make($domain);
    }

    public function update(TenantDomainUpdateRequest $request, Tenant $tenant, Domain $domain) : RedirectResponse
    {
        app(TenantUpdateAction::class)->handle($tenant, $request->validated());
        return Redirect::to(route('landlord.admin.tenants.edit', $tenant))
            ->with('success', 'Tenant updated.');
    }
}
