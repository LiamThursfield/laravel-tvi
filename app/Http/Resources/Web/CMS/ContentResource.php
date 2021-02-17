<?php

namespace App\Http\Resources\Web\CMS;

use App\Http\Resources\BaseResource;
use App\Interfaces\CMS\TemplateFieldInterface;

class ContentResource extends BaseResource
{
    public $preserveKeys = true;

    public function toArray($request)
    {
        $data = $this->data;
        if (in_array($this->template_field_type, TemplateFieldInterface::JSON_TYPES)) {
            $data = json_decode($data, true);
        }

        return [
            'data'              => $data,
            'template_field'    => TemplateFieldResource::make($this->whenLoaded('templateField')),

        ];
    }
}
