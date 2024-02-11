<?php

namespace App\Actions\Landlord\Tenant;

use App\Models\Tenant;

class TenantStoreAction
{
    public function handle(array $tenant_data) : Tenant
    {
        return Tenant::create([
            'id' => $tenant_data['id']
        ]);
    }
}
