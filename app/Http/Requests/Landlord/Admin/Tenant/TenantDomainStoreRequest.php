<?php

namespace App\Http\Requests\Landlord\Admin\Tenant;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class TenantDomainStoreRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'domain' => [
                'required',
                'string',
                Rule::unique('domains'),
            ],
        ];
    }
}
