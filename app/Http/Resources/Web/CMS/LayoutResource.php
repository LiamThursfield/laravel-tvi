<?php

namespace App\Http\Resources\Web\CMS;

use App\Http\Resources\BaseResource;
use App\Traits\CMS\ResourceHasContent;

class LayoutResource extends BaseResource
{
    use ResourceHasContent;

    public function toArray($request)
    {
        $data = [
            'name'          => $this->name,
            'slug'          => $this->slug,
        ];

        // Add content
        if ($this->resource->relationLoaded('content')) {
            $data['content'] = $this->formatContent();
        }

        return $data;
    }
}
