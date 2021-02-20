<?php

namespace App\Http\Resources\Admin\CRM;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactEditResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'email'                 => $this->email,
            'first_name'            => $this->first_name,
            'id'                    => $this->id,
            'last_name'             => $this->last_name,
            'marketing_email'       => $this->marketing_email,
            'marketing_sms'         => $this->marketing_sms,
            'marketing_telephone'   => $this->marketing_telephone,
            'telephone'             => $this->telephone,
            'title'                 => $this->title,
            'name'                  => $this->name ?? '',
        ];
    }
}
