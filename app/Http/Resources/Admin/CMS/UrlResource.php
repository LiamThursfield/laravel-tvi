<?php

namespace App\Http\Resources\Admin\CMS;

use App\Http\Resources\BaseResource;

class UrlResource extends BaseResource
{

    public function toArray($request)
    {
        return [
            'expired_at'    => $this->formatDateTime($this->expired_at),
            'id'            => $this->id,
            'is_enabled'    => $this->is_enabled,
            'is_live'       => $this->is_live,
            'published_at'  => $this->formatDateTime($this->published_at),
            'url_full'      => $this->url_full,
            'url_main'      => $this->url_main,
            'urlable_id'    => $this->urlable_id,
            'urlable_type'  => $this->urlable_type,
        ];
    }
}
