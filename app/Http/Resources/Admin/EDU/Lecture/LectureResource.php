<?php

namespace App\Http\Resources\Admin\EDU\Lecture;

use Illuminate\Http\Resources\Json\JsonResource;

class LectureResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'lecture_count' => $this->lecture_count,
            'content_length' => $this->content_length,
            'index' => $this->index,
            'course_id' => $this->course_id,
            'can_be_previewed' => (bool)$this->can_be_previewed,
            'preview_url' => $this->preview_url,
            'video_url' => $this->video_url,
            'item_type' => $this->item_type,
            'section_id' => $this->section_id,
            'completed' => (bool)$this->completed,
        ];
    }
}
