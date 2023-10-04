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
        ];
    }
}
