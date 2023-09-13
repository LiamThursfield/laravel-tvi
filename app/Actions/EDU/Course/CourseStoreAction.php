<?php

namespace App\Actions\EDU\Course;

use App\Models\EDU\Course\Course;

class CourseStoreAction
{
    public function handle(array $data) : Course
    {
        return Course::create($data);
    }
}
