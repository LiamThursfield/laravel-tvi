<?php

namespace App\Http\Resources\Admin\EDU\Programme;

use Illuminate\Http\Resources\Json\JsonResource;

class ProgrammeResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'slug'          => $this->slug,
            'summary'       => $this->summary,
            'description'   => $this->description,
            'creator_id'    => $this->creator_id,
            'creator'       => $this->whenLoaded('creator'),
            'status'        => $this->status,
            'content_length_video' => $this->content_length_video,
        ];
    }
}
