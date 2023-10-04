<?php

namespace App\Actions\EDU\Course;

use App\Models\EDU\Course\Course;
use App\Traits\Admin\EDU\CourseActions;

class CoursePublishAction
{
    use CourseActions;

    public function handle(Course $course)
    {
        return $this->publishCourse($course);
    }
}
