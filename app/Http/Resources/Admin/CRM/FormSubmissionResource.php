<?php

namespace App\Http\Resources\Admin\CRM;

use App\Http\Resources\BaseResource;

class FormSubmissionResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'contact'       => ContactResource::make($this->whenLoaded('contact')),
            'contact_id'    => $this->contact_id,
            'data'          => $this->data,
            'form'          => FormResource::make($this->whenLoaded('form')),
            'form_id'       => $this->form_id,
            'id'            => $this->id,
            'submitted_at'  => $this->formatDateTime($this->submitted_at),
        ];
    }
}
