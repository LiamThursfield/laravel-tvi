<?php

namespace App\Http\Controllers\Student\Admin;

use App\Actions\EDU\Course\Student\StudentCourseShowAction;
use App\Actions\EDU\Lecture\Student\LectureCompleteAction;
use App\Actions\EDU\Lecture\Student\LectureDownloadPdfsAction;
use App\Http\Controllers\AdminController;
use App\Http\Resources\Admin\EDU\Announcement\AnnouncementResource;
use App\Http\Resources\Admin\EDU\Course\CourseResource;
use App\Interfaces\EDU\Announcement\AnnouncementInterface;
use App\Interfaces\PermissionInterface;
use App\Models\EDU\Announcement\Announcement;
use App\Models\EDU\Course\Course;
use App\Models\EDU\Lecture\Lecture;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->addMetaTitleSection('Student');
        $this->addMetaTitleSection('Courses');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::EDIT_EDU_COURSES)
        )->only(['edit', 'update']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::VIEW_STUDENT_ADMIN)
        )->only('index');
    }

    public function index()
    {
        $this->shareMeta();

        $user = Auth::user();
        $user->load(['courses', 'courses.creator']);
        $courses = $user->courses;
        $announcements = Announcement::where('status', AnnouncementInterface::STATUS_PUBLISHED)
            ->where('platform', true)
            ->get();

        // TODO:: Logic to calculate completion percentage
        // For each course get the total sections
        // calculate percentage of completion out of all sections

        CourseResource::withoutWrapping();
        AnnouncementResource::withoutWrapping();

        return Inertia::render('student/admin/home/Index', [
            'courses' => CourseResource::collection($courses),
            'announcements' => AnnouncementResource::collection($announcements),
        ]);
    }

    public function show($slug): Response
    {
        $this->shareMeta();
        $course = Course::where('slug', $slug)->firstOrFail();

        return Inertia::render('student/admin/home/Show', [
            'course' => function () use ($course) {
                return app(StudentCourseShowAction::class)->handle($course);
            },
        ]);
    }

    public function completeLecture(Lecture $lecture): RedirectResponse
    {
        app(LectureCompleteAction::class)->handle($lecture);

        return Redirect::back(303)->with(
            'success',
            trans('messages.mark-complete-success')
        );
    }

    public function downloadLecturePDFs(Lecture $lecture): RedirectResponse
    {
        app(LectureDownloadPdfsAction::class)->handle($lecture);

        return Redirect::back(303)->with(
            'success',
            trans('messages.mark-complete-success')
        );
    }
}
