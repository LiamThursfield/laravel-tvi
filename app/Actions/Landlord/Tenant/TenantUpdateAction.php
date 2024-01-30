<?php

namespace App\Actions\Landlord\Tenant;

use App\Models\Tenant;

class TenantUpdateAction
{
    public function handle(Tenant $tenant, array $tenant_data): Tenant
    {
        $tenant->update([
            'id' => $tenant_data['id']
        ]);

        return $tenant;
    }
}
