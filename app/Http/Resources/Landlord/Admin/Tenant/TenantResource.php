<?php

namespace App\Http\Resources\Landlord\Admin\Tenant;

use Illuminate\Http\Resources\Json\JsonResource;

class TenantResource extends JsonResource
{
    public function toArray($request)
    {
       return [
           'id' => $this->id,
           'tenancy_db_name' => $this->tenancy_db_name,
           'domains' => TenantDomainResource::collection($this->whenLoaded('domains'))
       ];
    }
}
