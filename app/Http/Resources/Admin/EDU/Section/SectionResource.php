<?php

namespace App\Http\Resources\Admin\EDU\Section;

use App\Http\Resources\Admin\EDU\Lecture\LectureResource;
use App\Http\Resources\Admin\EDU\Webinar\WebinarResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class SectionResource extends JsonResource
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
            'child_items' => LectureResource::collection($this->whenLoaded('childItems')),
            'webinar' => WebinarResource::make($this->whenLoaded('webinar')),
            'files' => $this->getFiles() ?? null,
        ];
    }

    protected function getFiles()
    {
        if (!$this->files) {
            return null;
        }

        $files = $this->files;

        foreach ($files as $file) {
            $file->url = Storage::disk('file_manager')->temporaryUrl(
                $file->file_path, Carbon::now()->addHour()
            );
            if (str_contains($file->file_name, '.mp3')) {
                $file->type_audio = true;
            }
        }

        return $files;
    }
}
