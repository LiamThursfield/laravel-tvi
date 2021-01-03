<?php

namespace App\Http\Resources\Admin\CMS;

use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
    public function toArray($request)
    {
        $data = [
            'enabled_at'    => $this->enabled_at,
            'expired_at'    => $this->expired_at,
            'id'            => $this->id,
            'is_enabled'    => $this->is_enabled,
            'is_expired'    => $this->is_exired,
            'is_live'       => $this->is_live,
            'is_published'  => $this->is_published,
            'layout'        => LayoutResource::make($this->whenLoaded('layout')),
            'layout_id'     => $this->layout_id,
            'parent'        => PageResource::make($this->whenLoaded('parent')),
            'parent_id'     => $this->parent_id,
            'name'          => $this->name,
            'published_at'  => $this->published_at,
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
