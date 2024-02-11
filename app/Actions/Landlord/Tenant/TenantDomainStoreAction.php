<?php

namespace App\Actions\Landlord\Tenant;

use App\Models\Tenant;
use Illuminate\Support\Arr;
use Stancl\Tenancy\Database\Models\Domain;

class TenantDomainStoreAction
{
    public function handle(Tenant $tenant, array $tenant_domain_data): Domain
    {
        return $tenant->domains()->create(['domain' => Arr::get($tenant_domain_data, 'domain')]);
    }
}
