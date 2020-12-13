<?php

namespace App\Http\Resources\Admin\CMS;

use Illuminate\Http\Resources\Json\JsonResource;

class LayoutResource extends JsonResource
{

    public function toArray($request)
    {
        $data = [
            'id'            => $this->id,
            'name'          => $this->name,
            'slug'          => $this->slug,
            'template'      => TemplateResource::make($this->whenLoaded('template')),
            'template_id'   => $this->template_id,
        ];

        // Add content, keyed via template field id
        if ($this->resource->relationLoaded('content')) {
            $content = ContentResource::collection($this->content);
            $data['content'] = $content->keyBy('template_field_id');
        }

        return $data;
    }
}
