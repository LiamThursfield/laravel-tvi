<?php

namespace App\Http\Resources\Admin\EDU\Lecture;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

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
            'section' => $this->section,
            'completed' => (bool)$this->completed,
            'files' => $this->getFiles() ?? null,
            'audio_url' => $this->getAudioUrl()
        ];
    }

    /**
     * Should only ever be one audio per lecture - the audio of the lecture (video_url)
     *
     * @return mixed
     */
    protected function getAudioUrl()
    {
        $audioFile = $this->getFiles()->filter(function ($item) {
            if ($item->type_audio === true) {
                return $item->url;
            }
            return $item->type_audio === true;
        })->values();

        return count($audioFile) ? $audioFile->first()->url:null;
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
