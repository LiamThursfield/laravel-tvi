<?php

namespace App\Http\Resources\Web\CMS;

use App\Http\Resources\BaseResource;
use App\Traits\CMS\ResourceHasContent;

class FullPageResource extends BaseResource
{
    use ResourceHasContent;

    public function toArray($request)
    {
        $data = [
            'layout'        => LayoutResource::make($this->whenLoaded('layout')),
            'metadata'      => MetadataResource::make($this->whenLoaded('metadata')),
            'name'          => $this->name,
            'slug'          => $this->slug,
            'template'      => TemplateResource::make($this->whenLoaded('template')),
            'url'           => UrlResource::make($this->whenLoaded('url')),
        ];

        // Add content
        if ($this->resource->relationLoaded('content')) {
            $data['content'] = $this->formatContent();
        }

        return $data;
    }
}
