<?php

namespace App\Http\Resources\Admin\CMS;

use Illuminate\Http\Resources\Json\JsonResource;

class LayoutResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'slug'          => $this->slug,
            'template'      => TemplateResource::make($this->whenLoaded('template')),
            'template_id'   => $this->template_id,
        ];
    }
}
