<?php

namespace App\Http\Controllers\Admin\EDU\Course;

use App\Actions\EDU\Course\CoursePublishAction;
use App\Actions\EDU\Course\CourseQueryAction;
use App\Actions\EDU\Course\CourseStoreAction;
use App\Actions\EDU\Course\CourseUpdateAction;
use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\EDU\Course\CourseIndexRequest;
use App\Http\Requests\Admin\EDU\Course\CourseStoreRequest;
use App\Http\Requests\Admin\EDU\Course\CourseUpdateRequest;
use App\Http\Resources\Admin\EDU\Course\CourseResource;
use App\Http\Resources\Web\EDU\CourseShowResource;
use App\Interfaces\AppInterface;
use App\Interfaces\EDU\Course\CourseInterface;
use App\Interfaces\EDU\Course\CoursePurchaseInterface;
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
            PermissionInterface::getMiddlewareString(PermissionInterface::CREATE_EDU_COURSES)
        )->only(['create', 'store']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::DELETE_EDU_COURSES)
        )->only('destroy');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::EDIT_EDU_COURSES)
        )->only(['edit', 'update']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::VIEW_EDU_COURSES)
        )->only('index');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::PUBLISH_EDU_COURSES)
        )->only('publish');
    }

    public function create(): Response
    {
        $this->addMetaTitleSection('Create')->shareMeta();

        return Inertia::render('admin/edu/course/Create', [
                'currencies' => function () {
                    return CoursePurchaseInterface::CURRENCIES;
                }
        ]);
    }

    public function destroy(Course $course): RedirectResponse
    {
        $course->delete();

        return Redirect::back(303)->with(
            'success',
            'Deleted.'
        );
    }

    public function edit(Course $course): Response
    {
        $this->addMetaTitleSection('Edit - ' . $course->name)->shareMeta();
        $course->load('sections');

        return Inertia::render('admin/edu/course/Edit', [
            'course' => function () use ($course) {
                CourseResource::withoutWrapping();
                return CourseResource::make($course);
            },
            'currencies' => function () {
                return CoursePurchaseInterface::CURRENCIES;
            },
            'statuses' => function () {
                return CourseInterface::STATUSES_EDIT;
            }
        ]);
    }

    public function index(CourseIndexRequest $request): Response
    {
        $search_options = $request->validated();

        $this->shareMeta();

        return Inertia::render('admin/edu/course/Index', [
            'courses' => function () use ($search_options) {
                return app(CourseQueryAction::class)
                    ->handle($search_options)
                    ->with('creator')
                    ->paginate(AppInterface::getSearchPaginationParam($search_options));
            },
            'searchOptions' => $search_options
        ]);
    }

    public function store(CourseStoreRequest $request): RedirectResponse
    {
        $course = app(CourseStoreAction::class)->handle($request->validated());

        return Redirect::to(route('admin.edu.courses.edit', $course))
            ->with('success', 'Created');
    }

    public function update(CourseUpdateRequest $request, Course $course): RedirectResponse
    {
        $course = app(CourseUpdateAction::class)->handle($course, $request->validated());

        return Redirect::to(route('admin.edu.courses.edit', $course))
            ->with('success', 'Updated');
    }

    public function preview(Course $course): Response
    {
        return Inertia::render('website/edu/course/Show', [
            'course' => function () use ($course) {
                $course->load([
                    'instalmentPlans',
                    'sections',
                    'creator'
                ]);

                CourseShowResource::withoutWrapping();
                return CourseShowResource::make($course);
            }
        ]);
    }

    public function publish(Course $course): RedirectResponse
    {
        app(CoursePublishAction::class)->handle($course);

        return Redirect::back(303)->with(
            'success',
            'Published.'
        );
    }
}
