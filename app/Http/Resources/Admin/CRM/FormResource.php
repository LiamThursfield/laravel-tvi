<?php

namespace App\Http\Resources\Admin\CRM;

use Illuminate\Http\Resources\Json\JsonResource;

class FormResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'email_recipients'  => $this->email_recipients ?? [],
            'form_fields'       => FormFieldResource::make($this->whenLoaded('form_fields')),
            'id'                => $this->id,
            'name'              => $this->name,
            'slug'              => $this->slug,
        ];
    }
}
