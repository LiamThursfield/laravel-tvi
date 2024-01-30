<?php

namespace App\Http\Requests\Landlord\Admin\Tenant;

use App\Http\Requests\BaseIndexRequest;

class TenantIndexRequest extends BaseIndexRequest
{
    public function rules() : array
    {
        return array_merge(parent::rules(), [
            'tenant_id' => 'nullable|string',
        ]);
    }
}
