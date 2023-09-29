<?php

namespace App\Http\Resources\Admin\EDU\Label;

use Illuminate\Http\Resources\Json\JsonResource;

class LabelResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'   => $this->id,
            'label' => $this->label,
            'slug' => $this->slug,
        ];
    }
}
