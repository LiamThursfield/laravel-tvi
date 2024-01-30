<?php

namespace App\Http\Requests\Landlord\Admin\Tenant;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class TenantStoreRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'id' => [
                'required',
                'string',
                Rule::unique('tenants'),
            ],
        ];
    }
}
