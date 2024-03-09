<?php

namespace App\Actions\EDU\Course\Student;

use App\Http\Resources\Admin\EDU\Course\CourseResource;
use App\Models\EDU\Course\Course;
use App\Models\EDU\Lecture\LectureUser;
use Illuminate\Support\Facades\Auth;

class StudentCourseShowAction
{

    public function handle(Course $course)
    {
        $course->load([
            'sections',
            'sections.webinars',
            'sections.files',
            'webinars',
            'creator',
            'labels',
            'programme',
        ]);

        $lecturesCompleted = LectureUser::where('user_id', Auth::id())->get()->pluck('lecture_id')->toArray();

        foreach ($course->sections as $section) {
            foreach ($section->childItems as $item) {
                if (in_array($item->id, $lecturesCompleted)) {
                    $item->completed = true;
                } else {
                    $item->completed = false;
                }
            }
        }
//        dd($course->toArray());

        CourseResource::withoutWrapping();
        return CourseResource::make($course);
    }
}
