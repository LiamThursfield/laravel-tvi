<?php

namespace App\Actions\EDU\Course;

use App\Interfaces\EDU\Course\CourseInterface;
use App\Models\EDU\Course\Course;
use App\Models\EDU\Lecture\Lecture;
use App\Models\EDU\Section\Section;
use App\Traits\Admin\Slugify;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CourseUpdateAction
{
    use Slugify;

    public function handle(Course $course, array $data): ?Course
    {
        $data = $this->transformData($data);
        return $this->updateCourse($course, $data);
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

    protected function updateCourse($course, $data)
    {
        return DB::transaction(function () use ($course, $data) {
            // Get sections for course and unset for course to create
            $sections = $data['sections'];
            unset($data['sections']);

            // Create course
            $data['status'] = CourseInterface::STATUS_DRAFT;
            $course->update($data);

            if (count($sections)) {
                // Create the sections and link them to the course
                foreach ($sections as $key => $section) {
                    $updateSection = Section::findOrFail($section['id']);
                    $updateSection->fill([
                        'title' => $section['title'],
                        'slug' => $this->slugifyWithIso8601($data['title']),
                        'lecture_count' => $section['lecture_count'],
                        'content_length' => $section['content_length'],
                        'index' => $key,
                        'course_id' => $course->id,
                    ]);
                    $updateSection->save();
                    $updateSection->fresh();

                    // Create the lectures and link them to their section
                    foreach ($section['child_items'] as $index => $lecture) {
                        $updateLecture = Lecture::findOrFail($lecture['id']);
                        $updateLecture->fill([
                            'title' => $lecture['title'],
                            'slug' => $this->slugifyWithIso8601($data['title']),
                            'description' => $lecture['description'],
                            'can_be_previewed' => $lecture['can_be_previewed'],
                            'preview_url' => $lecture['preview_url'],
                            'video_url' => $lecture['video_url'],
                            'content_length' => $lecture['content_length'],
                            'index' => $index,
                            'section_id' => $lecture['section_id'],
                        ]);
                        $updateLecture->save();
                    }
                }
            }

            $course->fresh();
            $course->load('sections');

            return $course;
        });
    }
}
