<?php

namespace App\Actions\EDU\Course;

use App\Models\EDU\Course\Course;

class CourseUpdateAction
{
    public function handle(Course $course, array $data): ?Course
    {
        $course->update($data);

        return $course->fresh();
    }
}
