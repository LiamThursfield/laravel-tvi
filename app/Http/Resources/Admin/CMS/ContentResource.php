<?php

namespace App\Http\Resources\Admin\CMS;

use Illuminate\Http\Resources\Json\JsonResource;

class ContentResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'data'              => $this->data,
            'id'                => $this->id,
            'template_field'    => TemplateFieldResource::make($this->whenLoaded('templateField')),
            'template_field_id' => $this->template_field_id,
        ];
    }
}
