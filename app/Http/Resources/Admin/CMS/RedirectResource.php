<?php

namespace App\Http\Resources\Admin\CMS;

use App\Http\Resources\BaseResource;

class RedirectResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'expired_at'    => $this->formatDateTime($this->expired_at),
            'http_status'   => $this->http_status,
            'id'            => $this->id,
            'is_active'     => $this->is_active,
            'is_enabled'    => $this->is_enabled,
            'is_permanent'  => $this->is_permanent,
            'published_at'  => $this->formatDateTime($this->published_at),
            'url_from'      => $this->url_from,
            'url_to'        => $this->url_to,
        ];
    }
}
