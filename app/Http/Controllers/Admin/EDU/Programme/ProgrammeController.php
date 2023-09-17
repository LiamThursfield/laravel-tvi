<?php

namespace App\Http\Controllers\Admin\EDU\Programme;

use App\Actions\EDU\Course\CourseQueryAction;
use App\Actions\EDU\Course\CourseStoreAction;
use App\Actions\EDU\Course\CourseUpdateAction;
use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\EDU\Course\CourseIndexRequest;
use App\Http\Requests\Admin\EDU\Course\CourseStoreRequest;
use App\Http\Requests\Admin\EDU\Course\CourseUpdateRequest;
use App\Http\Resources\Admin\EDU\Course\CourseResource;
use App\Interfaces\AppInterface;
use App\Interfaces\PermissionInterface;
use App\Models\EDU\Course\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProgrammeController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->addMetaTitleSection('EDU');
        $this->addMetaTitleSection('Programmes');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::CREATE_EDU_PROGRAM)
        )->only(['create', 'store']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::DELETE_EDU_PROGRAM)
        )->only('destroy');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::EDIT_EDU_PROGRAM)
        )->only(['edit', 'update']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::VIEW_EDU_PROGRAM)
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

    public function index(CourseIndexRequest $request) : Response
    {
        $search_options = $request->validated();

        $this->shareMeta();

        return Inertia::render('admin/edu/course/Index', [
            'courses' => function () use ($search_options) {
                return app(CourseQueryAction::class)
                    ->handle($search_options)
                    ->paginate(AppInterface::getSearchPaginationParam($search_options));
            },
            'searchOptions' => $search_options
        ]);
    }

    public function store(CourseStoreRequest $request) : RedirectResponse
    {
        $course = app(CourseStoreAction::class)->handle($request->validated());

        return Redirect::to(route('admin.edu.course.edit', $course))
            ->with('success', 'Created');
    }

    public function update(CourseUpdateRequest $request, Course $course) : RedirectResponse
    {
        $course = app(CourseUpdateAction::class)->handle($course, $request->validated());

        return Redirect::to(route('admin.edu.course.edit', $course))
            ->with('success', 'Updated');
    }
}
