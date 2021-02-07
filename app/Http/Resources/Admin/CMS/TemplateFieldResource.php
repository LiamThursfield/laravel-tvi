<?php

namespace App\Http\Resources\Admin\CMS;

use App\Interfaces\CMS\TemplateFieldInterface;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class TemplateFieldResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'description'       => $this->description,
            'id'                => $this->id,
            'is_required'       => $this->is_required ?? false,
            'name'              => $this->name,
            'order'             => $this->order ?? 0,
            'settings'          => $this->settings ?? [],
            'slug'              => $this->slug,
            'type'              => $this->type,
            'type_label'        => Arr::get(
                TemplateFieldInterface::ALL_TYPES_LABELLED,
                $this->type,
                $this->type
            ),
            'template'          => TemplateResource::make($this->whenLoaded('template')),
            'template_id'       => $this->template_id,
        ];
    }
}
