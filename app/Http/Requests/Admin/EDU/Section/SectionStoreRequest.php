<?php

namespace App\Http\Requests\Admin\EDU\Section;

use App\Http\Requests\BaseIndexRequest;

class SectionStoreRequest extends BaseIndexRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'lecture_count' => 'nullable|string',
            'content_length' => 'nullable|string',
            'index' => 'nullable|string',
            'course_id' => 'required|exists:edu_courses',
        ]);
    }
}
