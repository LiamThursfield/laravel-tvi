<?php

namespace App\Http\Resources\Web\CMS;

use App\Http\Resources\BaseResource;

class ContentResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'data'              => $this->data,
            'template_field'    => TemplateFieldResource::make($this->whenLoaded('templateField')),
        ];
    }
}
