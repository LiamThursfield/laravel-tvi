<?php

namespace App\Http\Resources\Admin\CMS;

use Illuminate\Http\Resources\Json\JsonResource;

class MetadataResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'canonical'         => $this->canonical,
            'description'       => $this->description,
            'og_description'    => $this->og_description,
            'og_image'          => $this->og_image,
            'og_title'          => $this->og_title,
            'og_type'           => $this->og_type,
            'og_url'            => $this->og_url,
            'title'             => $this->title,
        ];
    }
}
