<?php

namespace App\Http\Resources\Admin\CMS;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'menu_items'    => $this->menu_items,
            'name'          => $this->name,
            'slug'          => $this->slug,
        ];
    }
}
