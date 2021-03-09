<?php

namespace App\Http\Resources\Admin\CRM;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
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
            'name'                  => $this->name ?? '',
            'name_with_title'       => $this->name_with_title ?? '',
            'telephone'             => $this->telephone,
            'title'                 => $this->title,
        ];
    }
}
