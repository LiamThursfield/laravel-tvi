<?php

namespace App\Http\Resources\Admin\EDU\Creator;

use App\Http\Resources\Admin\EDU\Section\SectionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CreatorResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'first_name'    => $this->first_name,
            'id'            => $this->id,
            'last_name'     => $this->last_name,
            'name'          => $this->name ?? '',
        ];
    }
}
