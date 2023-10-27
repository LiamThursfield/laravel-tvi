<?php

namespace App\Http\Controllers\Student\Admin;

use App\Actions\EDU\Course\Student\StudentCourseShowAction;
use App\Actions\EDU\Lecture\Student\LectureCompleteAction;
use App\Actions\EDU\Lecture\Student\LectureDownloadPdfsAction;
use App\Http\Controllers\AdminController;
use App\Http\Resources\Admin\EDU\Course\CourseResource;
use App\Interfaces\PermissionInterface;
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

        CourseResource::withoutWrapping();
        $data = CourseResource::collection($courses);

        return Inertia::render('student/admin/home/Index', [
            'courses' => $data
        ]);
    }

    public function show(Course $course): Response
    {
        $this->shareMeta();

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
            'Completed.'
        );
    }

    public function downloadLecturePDFs(Lecture $lecture): RedirectResponse
    {
        app(LectureDownloadPdfsAction::class)->handle($lecture);

        return Redirect::back(303)->with(
            'success',
            'Completed.'
        );
    }
}
