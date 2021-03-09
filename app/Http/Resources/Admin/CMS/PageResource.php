<?php

namespace App\Http\Resources\Admin\CMS;

use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
    public function toArray($request)
    {
        $data = [
            'id'            => $this->id,
            'layout'        => LayoutResource::make($this->whenLoaded('layout')),
            'layout_id'     => $this->layout_id,
            'metadata'      => MetadataResource::make($this->whenLoaded('metadata')),
            'name'          => $this->name,
            'parent'        => PageResource::make($this->whenLoaded('parent')),
            'parent_id'     => $this->parent_id,
            'slug'          => $this->slug,
            'template'      => TemplateResource::make($this->whenLoaded('template')),
            'template_id'   => $this->template_id,
            'url'           => UrlResource::make($this->whenLoaded('url')),
        ];

        // Add content, keyed via template field id
        if ($this->resource->relationLoaded('content')) {
            $content = ContentResource::collection($this->content);
            $data['content'] = $content->keyBy('template_field_id');
        }

        return $data;
    }
}
