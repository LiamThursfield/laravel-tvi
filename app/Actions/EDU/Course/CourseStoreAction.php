<?php

namespace App\Actions\EDU\Course;

use App\Interfaces\EDU\Course\CourseInterface;
use App\Models\EDU\Course\Course;
use App\Models\EDU\Lecture\Lecture;
use App\Models\EDU\Section\Section;
use App\Traits\Admin\Slugify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseStoreAction
{
    use Slugify;

    public function handle(array $data)
    {
        return $this->createCourse($data);
    }

    protected function createCourse($data)
    {
        return DB::transaction(function () use ($data) {
            // Get sections for course and unset for course to create
            $sections = $data['sections'];
            unset($data['sections']);

            // Create course
            $data['slug'] = $this->slugifyWithIso8601($data['name']);
            $data['status'] = CourseInterface::STATUS_DRAFT;
            $data['creator_id'] = Auth::id();
            $course = Course::create($data);

            if (count($sections)) {
                // Create the sections and link them to the course
                foreach ($sections as $key => $section) {
                    $newSection = new Section();
                    $newSection->fill([
                        'title' => $section['title'],
                        'slug' => $this->slugifyWithIso8601($data['title']),
                        'lecture_count' => $section['lecture_count'],
                        'content_length' => $section['content_length'],
                        'index' => $key,
                        'course_id' => $course->id,
                    ]);
                    $newSection->save();
                    $newSection->fresh();

                    // Create the lectures and link them to their section
                    foreach ($section['child_items'] as $index => $lecture) {
                        $newLecture = new Lecture();
                        $newLecture->fill([
                            'title' => $lecture['title'],
                            'slug' => $this->slugifyWithIso8601($data['title']),
                            'description' => $lecture['description'],
                            'can_be_previewed' => $lecture['can_be_previewed'],
                            'preview_url' => $lecture['preview_url'],
                            'video_url' => $lecture['video_url'],
                            'content_length' => $lecture['content_length'],
                            'index' => $index,
                            'section_id' => $newSection->id,
                        ]);
                        $newLecture->save();
                    }
                }
            }

            $course->load('sections');

            return $course;
        });
    }
}
