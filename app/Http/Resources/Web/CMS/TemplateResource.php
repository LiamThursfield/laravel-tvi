<?php

namespace App\Http\Resources\Web\CMS;

use App\Http\Resources\BaseResource;

class TemplateResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
        ];
    }
}
