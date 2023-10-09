<?php

namespace App\Http\Controllers\Admin\EDU\Webinar;

use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\EDU\Course\CourseIndexRequest;
use App\Http\Requests\Admin\EDU\Course\CourseStoreRequest;
use App\Http\Requests\Admin\EDU\Course\CourseUpdateRequest;
use App\Interfaces\AppInterface;
use App\Interfaces\PermissionInterface;
use App\Models\EDU\Course\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class WebinarController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->addMetaTitleSection('EDU');
        $this->addMetaTitleSection('Courses');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::CREATE_EDU_WEBINARS)
        )->only(['create', 'store']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::DELETE_EDU_WEBINARS)
        )->only('destroy');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::EDIT_EDU_WEBINARS)
        )->only(['edit', 'update']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::VIEW_EDU_WEBINARS)
        )->only('index');
    }

    public function create() : Response
    {
        $this->addMetaTitleSection('Create')->shareMeta();

        return Inertia::render('admin/edu/course/Create') ;
    }

    public function destroy(Course $course) : RedirectResponse
    {
        $course->delete();

        return Redirect::back(303)->with(
            'success',
            'Deleted.'
        );
    }

    public function edit(Course $course) : Response
    {
        $this->addMetaTitleSection('Edit - ' . $course->name)->shareMeta();

        return Inertia::render('admin/edu/course/Edit', [
            'course' => function () use ($course) {
                AnnouncementResource::withoutWrapping();
                return AnnouncementResource::make($course);
            }
        ]);
    }

    public function index(CourseIndexRequest $request) : Response
    {
        $search_options = $request->validated();

        $this->shareMeta();

        return Inertia::render('admin/edu/course/Index', [
            'courses' => function () use ($search_options) {
                return app(SectionQueryAction::class)
                    ->handle($search_options)
                    ->paginate(AppInterface::getSearchPaginationParam($search_options));
            },
            'searchOptions' => $search_options
        ]);
    }

    public function store(CourseStoreRequest $request) : RedirectResponse
    {
        $course = app(SectionStoreAction::class)->handle($request->validated());

        return Redirect::to(route('admin.edu.courses.edit', $course))
            ->with('success', 'Created');
    }

    public function update(CourseUpdateRequest $request, Course $course) : RedirectResponse
    {
        $course = app(SectionUpdateAction::class)->handle($course, $request->validated());

        return Redirect::to(route('admin.edu.courses.edit', $course))
            ->with('success', 'Updated');
    }
}
