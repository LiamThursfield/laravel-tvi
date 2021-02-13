<?php

namespace App\Http\Resources\Web\CMS;

use App\Http\Resources\BaseResource;

class UrlResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'expired_at'    => $this->formatDateTime($this->expired_at),
            'published_at'  => $this->formatDateTime($this->published_at),
            'url_full'      => $this->url_full,
            'url_main'      => $this->url_main,
        ];
    }
}
