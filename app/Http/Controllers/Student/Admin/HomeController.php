<?php

namespace App\Http\Controllers\Student\Admin;

use App\Http\Controllers\AdminController;
use App\Http\Resources\Admin\EDU\Course\CourseResource;
use App\Interfaces\PermissionInterface;
use App\Models\EDU\Course\Course;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->addMetaTitleSection('Student');
        $this->addMetaTitleSection('Courses');

//        $this->middleware(
//            PermissionInterface::getMiddlewareString(PermissionInterface::EDIT_EDU_COURSES)
//        )->only(['edit', 'update']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::VIEW_STUDENT_ADMIN)
        )->only('index');
    }

    public function index()
    {
        $this->shareMeta();

        $user = Auth::user();
        $user->load('courses');
        $courses = $user->courses;

        CourseResource::withoutWrapping();
        $data = CourseResource::collection($courses);

        return Inertia::render('student/admin/home/Index', [
            'courses' => $data
        ]);
    }

    public function show(Course $course)
    {
        $this->shareMeta();

        $course->load([
            'sections',
            'webinars',
            'creator',
            'labels',
            'programme',
        ]);

        return Inertia::render('student/admin/home/Show', [
            'course' => function () use ($course) {
                CourseResource::withoutWrapping();
                return CourseResource::make($course);
            },
        ]);
    }
}
