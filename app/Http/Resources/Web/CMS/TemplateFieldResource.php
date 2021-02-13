<?php

namespace App\Http\Resources\Web\CMS;

use App\Http\Resources\BaseResource;

class TemplateFieldResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'order'             => $this->order ?? 0,
            'slug'              => $this->slug,
            'type'              => $this->type,
        ];
    }
}
