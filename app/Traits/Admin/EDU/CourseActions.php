<?php

namespace App\Traits\Admin\EDU;

use App\Interfaces\EDU\Course\CourseInterface;
use App\Models\EDU\Course\Course;
use App\Models\EDU\Lecture\Lecture;
use App\Models\EDU\Section\Section;
use App\Traits\Admin\Slugify;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait CourseActions
{
    use Slugify;

    public function createLecture($lecture, $index, $sectionId): Lecture
    {
        $newLecture = new Lecture();
        $newLecture->fill([
            'title' => $lecture['title'],
            'slug' => $this->slugifyWithUnix($lecture['title']),
            'description' => $lecture['description'],
            'can_be_previewed' => $lecture['can_be_previewed'],
            'preview_url' => $lecture['preview_url'],
            'video_url' => $lecture['video_url'],
            'content_length' => $lecture['content_length'],
            'index' => $index,
            'section_id' => $sectionId,
        ]);
        $newLecture->save();

        return $newLecture;
    }

    public function createSection($section, $index, $courseId): Section
    {
        $newSection = new Section();
        $newSection->fill([
            'title' => $section['title'],
            'slug' => $this->slugifyWithUnix($section['title']),
            'lecture_count' => $section['lecture_count'],
            'content_length' => $section['content_length'],
            'index' => $index,
            'course_id' => $courseId,
        ]);
        $newSection->save();
        $newSection->fresh();

        return $newSection;
    }

    public function createCourse($data)
    {
        return DB::transaction(function () use ($data) {
            // Get sections for course and unset for course to create
            $sections = $data['sections'];
            unset($data['sections']);

            // Create course
            $data['slug'] = $this->slugifyWithUnix($data['name']);
            $data['status'] = CourseInterface::STATUS_DRAFT;
            $data['creator_id'] = Auth::id();
            $course = Course::create($data);

            if (count($sections)) {
                // Create the sections and link them to the course
                foreach ($sections as $key => $section) {
                    $newSection = $this->createSection($section, $key, $course->id);

                    // Create the lectures and link them to their section
                    foreach ($section['child_items'] as $index => $lecture) {
                        $this->createLecture($lecture, $index, $newSection->id);
                    }
                }
            }

            $course->load('sections');

            return $course;
        });
    }

    public function updateSection($section, $index, $courseId)
    {
        if (!isset($section['id'])) {
            $updateSection = $this->createSection($section, $index, $courseId);
        } else {
            $updateSection = Section::findOrFail($section['id']);

            $updateSection->fill([
                'title' => $section['title'],
                'slug' => $section['slug'],
                'lecture_count' => $section['lecture_count'],
                'content_length' => $section['content_length'],
                'index' => $index,
                'course_id' => $courseId,
            ]);
            $updateSection->save();
            $updateSection->fresh();
        }

        return $updateSection;
    }

    public function updateLecture($lecture, $index, $sectionId)
    {
        if (!Arr::get($lecture, 'id')) {
            unset($lecture['child_items']);
            return $this->createLecture($lecture, $index, $sectionId);
        } else {
            $updateLecture = Lecture::findOrFail($lecture['id']);
            $updateLecture->fill([
                'index' => $index,
                'section_id' => $lecture['section_id'],
            ]);
            $updateLecture->save();

            return $updateLecture;
        }
    }

    public function updateCourse($course, $data)
    {
        $data = $this->transformData($data);

        return DB::transaction(function () use ($course, $data) {
            // Get sections for course and unset for course to create
            $sections = $data['sections'];
            unset($data['sections']);

            $course->update($data);

            if (count($sections)) {
                // Create the sections and link them to the course
                foreach ($sections as $key => $section) {
                    $updateSection = $this->updateSection($section, $key, $course->id);

                    // Create the lectures and link them to their section
                    foreach ($section['child_items'] as $index => $lecture) {
                       $this->updateLecture($lecture, $index, $updateSection->id);
                    }
                }
            }

            $course->fresh();
            $course->load('sections');

            return $course;
        });
    }

    public function transformData($data) {
        if (Arr::get($data, 'available_from')) {
            $data['available_from'] = Carbon::parse($data['available_from'])->toDateTime();
        }
        if (Arr::get($data, 'available_to')) {
            $data['available_to'] = Carbon::parse($data['available_to'])->toDateTime();
        }

        return $data;
    }

    public function publishCourse($course)
    {
        return Course::where('id', $course->id)->update(['status'=> CourseInterface::STATUS_PUBLISHED]);
    }
}
