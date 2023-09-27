<?php

namespace App\Actions\EDU\Course;

use App\Interfaces\Course\CourseInterface;
use App\Models\EDU\Course\Course;
use Illuminate\Support\Str;

class CourseStoreAction
{
    public function handle(array $data) : Course
    {
        $data['slug'] = Str::slug($data['name']);
        $data['status'] = CourseInterface::STATUS_DRAFT;

        return Course::create($data);
    }
}
