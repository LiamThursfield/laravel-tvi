<?php

namespace App\Actions\EDU\Course;

use App\Models\EDU\Course\Course;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class CourseUpdateAction
{
    public function handle(Course $course, array $data): ?Course
    {
        $data = $this->transformData($data);
        $course->update($data);

        return $course->fresh();
    }

    protected function transformData($data) {
        if (Arr::get($data, 'available_from')) {
            $data['available_from'] = Carbon::parse($data['available_from'])->toDateTime();
        }
        if (Arr::get($data, 'available_to')) {
            $data['available_to'] = Carbon::parse($data['available_to'])->toDateTime();
        }

        return $data;
    }
}
