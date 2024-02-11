<?php

namespace App\Http\Requests\Landlord\Admin\Tenant;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class TenantDomainUpdateRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'domain' => [
                'required',
                'string',
                Rule::unique('domains')->ignore($this->domain->domain, 'domain'),
            ]
        ];
    }
}
