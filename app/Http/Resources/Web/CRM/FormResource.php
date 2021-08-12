<?php

namespace App\Http\Resources\Web\CRM;

use Illuminate\Http\Resources\Json\JsonResource;

class FormResource extends JsonResource {

    public function toArray($request)
    {
        return [
            'form_fields'           => FormFieldResource::collection($this->whenLoaded('formFields')),
            'id'                    => $this->id,
            'marketing_email'       => $this->marketing_email,
            'marketing_sms'         => $this->marketing_sms,
            'marketing_telephone'   => $this->marketing_telephone,
            'name'                  => $this->name,
        ];
    }
}
