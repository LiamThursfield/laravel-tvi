<?php

namespace App\Http\Requests\Admin\EDU\Lecture;

use App\Http\Requests\BaseIndexRequest;

class LectureIndexRequest extends BaseIndexRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'section_title' => 'nullable|string',
            'section_slug' => 'nullable|string',
        ]);
    }
}
