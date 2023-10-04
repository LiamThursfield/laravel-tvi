<?php

namespace App\Actions\EDU\Course;

use App\Models\EDU\Course\Course;
use App\Traits\Admin\EDU\CourseActions;

class CourseUpdateAction
{
    use CourseActions;

    public function handle(Course $course, array $data): ?Course
    {
        return $this->updateCourse($course, $data);
    }
}
