<?php

namespace App\Http\Resources\Admin\EDU\Announcement;

use Illuminate\Http\Resources\Json\JsonResource;

class AnnouncementResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'creator_id' => $this->creator_id,
            'creator' => $this->whenLoaded('creator'),
            'status' => $this->status,
            'platform' => (bool)$this->platform,
            'email' => (bool)$this->email,
            'sms' => (bool) $this->sms,
        ];
    }
}
