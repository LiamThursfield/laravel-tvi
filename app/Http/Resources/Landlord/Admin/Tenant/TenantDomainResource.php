<?php

namespace App\Http\Resources\Landlord\Admin\Tenant;

use Illuminate\Http\Resources\Json\JsonResource;

class TenantDomainResource extends JsonResource
{
    public function toArray($request)
    {
       return [
           'id' => $this->id,
           'domain' => $this->domain,
       ];
    }
}
