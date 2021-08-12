<?php

namespace App\Http\Resources\Web\CRM;

use Illuminate\Http\Resources\Json\JsonResource;

class FormFieldResource extends JsonResource {

    public function toArray($request)
    {
        return [
            'is_required'       => $this->is_required ?? false,
            'name'              => $this->name,
            'order'             => $this->order ?? 0,
            'settings'          => $this->settings ?? [],
            'slug'              => $this->slug,
            'type'              => $this->type,
        ];
    }
}
