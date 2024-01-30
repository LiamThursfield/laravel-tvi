<?php

namespace App\Actions\Landlord\Tenant;

use App\Actions\AbstractQueryAction;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Builder;

class TenantQueryAction extends AbstractQueryAction
{
    protected array $searchable_fields_likes = [
        'id' => 'tenant_id',
    ];

    protected string $order_by = 'id';

    protected function getQueryBuilder(): Builder
    {
        return Tenant::query();
    }
}
