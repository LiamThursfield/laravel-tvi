<?php

namespace App\Http\Resources\Admin\CRM;

use Illuminate\Http\Resources\Json\JsonResource;

class OrganisationUnitResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'address_id'            => $this->address_id,
            'children'              => OrganisationUnitResource::collection($this->whenLoaded('children')),
            'company'               => OrganisationUnitResource::make($this->whenLoaded('company')),
            'company_id'            => $this->company_id,
            'email'                 => $this->email,
            'id'                    => $this->id,
            'location'              => OrganisationUnitResource::make($this->whenLoaded('location')),
            'location_id'           => $this->location_id,
            'name'                  => $this->name,
            'notification_emails'   => $this->notification_emails,
            'parent'                => OrganisationUnitResource::make($this->whenLoaded('parent')),
            'parent_id'             => $this->parent_id,
            'slug'                  => $this->slug,
            'socials'               => $this->socials,
            'telephone'             => $this->telephone,
            'type'                  => $this->type,
        ];
    }
}
