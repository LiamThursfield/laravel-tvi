<?php

namespace App\Http\Requests\Admin\EDU\Course;

use App\Http\Requests\BaseIndexRequest;

class CourseIndexRequest extends BaseIndexRequest
{
    public function rules() : array
    {
        return array_merge(parent::rules(), [
            'course_name' => 'nullable|string',
            'course_slug' => 'nullable|string',
        ]);
    }
}
