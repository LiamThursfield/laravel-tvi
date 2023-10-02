<?php

namespace App\Actions\EDU\Course;

use App\Traits\Admin\EDU\CourseActions;

class CourseStoreAction
{
    use CourseActions;

    public function handle(array $data)
    {
        return $this->createCourse($data);
    }
}
