<?php

namespace App\Http\Resources\Admin\EDU\Webinar;

use Illuminate\Http\Resources\Json\JsonResource;

class WebinarResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'summary' => $this->summary,
            'description' => $this->description,
            'creator_id' => $this->creator_id,
            'course_id' => $this->course_id,
            'section_id' => $this->section_id,
            'creator' => $this->whenLoaded('creator'),
            'course' => $this->whenLoaded('course'),
            'section' => $this->whenLoaded('section'),
            'status' => $this->status,
            'date_time_from' => $this->date_time_from,
            'date_time_to' => $this->date_time_to,
            'webinar_url' => $this->webinar_url,
            'can_users_reserve' => $this->can_users_reserve,
            'is_recorded' => $this->is_recorded,
        ];
    }
}
