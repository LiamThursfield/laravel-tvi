<?php

namespace App\Http\Requests\Admin\EDU\Lecture;

use App\Http\Requests\BaseIndexRequest;

class LectureUpdateRequest extends BaseIndexRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'lecture_count' => 'nullable|string',
            'can_be_previewed' => 'nullable|bool',
            'preview_url' => 'nullable|string',
            'video_url' => 'nullable|string',
            'content_length' => 'nullable|string',
            'index' => 'nullable|integer',
            'section_id' => 'required|exists:edu_sections,id',
        ]);
    }
}
