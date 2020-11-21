<?php

namespace App\Http\Resources\Admin\CMS;

use App\Interfaces\CMS\TemplateInterface;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class TemplateResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'description'       => $this->description,
            'id'                => $this->id,
            'name'              => $this->name,
            'slug'              => $this->slug,
            'type'              => $this->type,
            'type_label'        => Arr::get(
                TemplateInterface::ALL_TYPES_LABELLED,
                $this->type,
                $this->type
            ),
            'template_fields'   => TemplateFieldResource::collection($this->whenLoaded('templateFields')),
        ];
    }
}
