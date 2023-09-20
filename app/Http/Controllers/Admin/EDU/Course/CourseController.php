<?php

namespace App\Http\Controllers\Admin\EDU\Course;

use App\Actions\EDU\Course\ProgrammeQueryAction;
use App\Actions\EDU\Course\ProgrammeStoreAction;
use App\Actions\EDU\Course\ProgrammeUpdateAction;
use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\EDU\Course\LabelIndexRequest;
use App\Http\Requests\Admin\EDU\Course\LabelStoreRequest;
use App\Http\Requests\Admin\EDU\Course\LabelUpdateRequest;
use App\Http\Resources\Admin\EDU\Course\CourseResource;
use App\Interfaces\AppInterface;
use App\Interfaces\PermissionInterface;
use App\Models\EDU\Course\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class CourseController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->addMetaTitleSection('EDU');
        $this->addMetaTitleSection('Courses');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::CREATE_EDU_COURSE)
        )->only(['create', 'store']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::DELETE_EDU_COURSE)
        )->only('destroy');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::EDIT_EDU_COURSE)
        )->only(['edit', 'update']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::VIEW_EDU_COURSE)
        )->only('index');
    }

    public function create() : Response
    {
        $this->addMetaTitleSection('Create')->shareMeta();

        return Inertia::render('admin/edu/course/Create', []) ;
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
                CourseResource::withoutWrapping();
                return CourseResource::make($course);
            }
        ]);
    }

    public function index(LabelIndexRequest $request) : Response
    {
        $search_options = $request->validated();

        $this->shareMeta();

        return Inertia::render('admin/edu/course/Index', [
            'courses' => function () use ($search_options) {
                return app(ProgrammeQueryAction::class)
                    ->handle($search_options)
                    ->paginate(AppInterface::getSearchPaginationParam($search_options));
            },
            'searchOptions' => $search_options
        ]);
    }

    public function store(LabelStoreRequest $request) : RedirectResponse
    {
        $course = app(ProgrammeStoreAction::class)->handle($request->validated());

        return Redirect::to(route('admin.edu.course.edit', $course))
            ->with('success', 'Created');
    }

    public function update(LabelUpdateRequest $request, Course $course) : RedirectResponse
    {
        $course = app(ProgrammeUpdateAction::class)->handle($course, $request->validated());

        return Redirect::to(route('admin.edu.course.edit', $course))
            ->with('success', 'Updated');
    }
}
