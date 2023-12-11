<?php

namespace Database\Seeders\EDU;

use App\Interfaces\EDU\Course\CourseInterface;
use App\Models\EDU\Course\Course;
use App\Models\EDU\Course\CourseInstalmentPlan;
use App\Models\EDU\Course\CourseUser;
use App\Models\EDU\Label\Label;
use App\Models\EDU\Lecture\Lecture;
use App\Models\EDU\Lecture\LectureUser;
use App\Models\EDU\Section\Section;
use App\Models\EDU\Webinar\Webinar;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(array $options = [])
    {
        // Random course statuses
        Course::factory()->count(
            Arr::get($options, 'course_count', 10)
        )->create();

        // Live courses
        Course::factory()->count(
            Arr::get($options, 'live_course_count', 3)
        )->create([
            'status' => CourseInterface::STATUS_PUBLISHED,
            'available_from' => now(),
            'available_to' => now()->addDecade()
        ]);

       $courses = Course::all();
       foreach ($courses as $key => $course) {
           Section::factory()->count(2)->create([
               'course_id' => $course->id,
               'lecture_count' => Arr::get($options, 'lecture_count', 2),
               'index' => $key,
           ]);

           // Create some instalment plans
           $instalment_counts = [
               6, 12, 18
           ];
           foreach ($instalment_counts as $instalment_count) {
               CourseInstalmentPlan::factory()->create([
                   'course_id' => $course->id,
                   'instalment_count' => $instalment_count,
                   'instalment_price' => (int) (($course->price * 1.5) / $instalment_count)
               ]);
           }
       }

        $sections = Section::all();
        foreach ($sections as $index => $section) {
            Lecture::factory()->count(
                Arr::get($options, 'lecture_count', 2)
            )->create([
                'preview_url' => 'https://player.vimeo.com/video/439035104?h=8a93ad7e59',
                'video_url' => 'https://player.vimeo.com/video/465991951?h=f7f7feb73d',
                'section_id' => $section->id,
                'index' => $index
            ]);

            Webinar::factory()->create([
                'section_id' => $section->id,
                'course_id' => $section->course_id,
            ]);
        }

        foreach ($sections as $section) {
            $query = Lecture::where('section_id', $section->id);
            $section->content_length = $query->sum('content_length');
            $section->lecture_count = $query->count();
            $section->save();
        }

        $labels = Label::all()->pluck('id');
        foreach ($courses as $course) {
            $course->labels()->attach($labels);
            break;
        }

        $studentUser = User::where('email', Arr::get($options, 'user_email', 'student@example.com'))->first();

        $courseUser = new CourseUser();

        $courseUser->fill([
            'course_id' => $courses->first()->id,
            'user_id' => $studentUser->id,
        ]);

        $courseUser->save();

        $lectures = Lecture::all();

        // One lecture complete
        $lectureUser = new LectureUser();
        $lectureUser->fill([
            'lecture_id' => $lectures->first()->id,
            'user_id' => $studentUser->id,
            'completed' => true,
        ]);
        $lectureUser->save();

        // One lecture incomplete
        $lectureUser = new LectureUser();
        $lectureUser->fill([
            'lecture_id' => $lectures->last()->id,
            'user_id' => $studentUser->id,
            'completed' => false,
        ]);
        $lectureUser->save();
    }
}
