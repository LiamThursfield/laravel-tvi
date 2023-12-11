<?php

namespace App\Http\Controllers\Admin\EDU\Webinar;

use App\Actions\EDU\Course\CourseQueryAction;
use App\Actions\EDU\Webinar\WebinarPublishAction;
use App\Actions\EDU\Webinar\WebinarQueryAction;
use App\Actions\EDU\Webinar\WebinarStoreAction;
use App\Actions\EDU\Webinar\WebinarUpdateAction;
use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\EDU\Webinar\WebinarIndexRequest;
use App\Http\Requests\Admin\EDU\Webinar\WebinarStoreRequest;
use App\Http\Requests\Admin\EDU\Webinar\WebinarUpdateRequest;
use App\Http\Resources\Admin\EDU\Webinar\WebinarResource;
use App\Interfaces\AppInterface;
use App\Interfaces\EDU\Webinar\WebinarInterface;
use App\Interfaces\PermissionInterface;
use App\Models\EDU\Course\Course;
use App\Models\EDU\Webinar\Webinar;
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
        $this->addMetaTitleSection('Webinars');

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

        return Inertia::render('admin/edu/webinar/Create', [
            'courses' => $this->getCourses(),
        ]) ;
    }

    public function destroy(Webinar $webinar) : RedirectResponse
    {
        $webinar->delete();

        return Redirect::back(303)->with(
            'success',
            'Deleted.'
        );
    }

    public function edit(Webinar $webinar) : Response
    {
        $this->addMetaTitleSection('Edit - ' . $webinar->name)->shareMeta();

        return Inertia::render('admin/edu/webinar/Edit', [
            'webinar' => function () use ($webinar) {
                WebinarResource::withoutWrapping();
                return WebinarResource::make($webinar);
            },
            'statuses' => function () {
                return WebinarInterface::STATUSES_EDIT;
            },
            'courses' => $this->getCourses(),
        ]);
    }

    public function index(WebinarIndexRequest $request) : Response
    {
        $search_options = $request->validated();

        $this->shareMeta();

        return Inertia::render('admin/edu/webinar/Index', [
            'webinars' => function () use ($search_options) {
                return app(WebinarQueryAction::class)
                    ->handle($search_options)
                    ->with(['creator', 'course', 'section'])
                    ->paginate(AppInterface::getSearchPaginationParam($search_options));
            },
            'searchOptions' => $search_options
        ]);
    }

    public function store(WebinarStoreRequest $request) : RedirectResponse
    {
        $webinar = app(WebinarStoreAction::class)->handle($request->validated());

        return Redirect::to(route('admin.edu.webinars.edit', $webinar))
            ->with('success', 'Created');
    }

    public function update(WebinarUpdateRequest $request, Webinar $webinar) : RedirectResponse
    {
        $webinar = app(WebinarUpdateAction::class)->handle($webinar, $request->validated());

        return Redirect::to(route('admin.edu.webinars.edit', $webinar))
            ->with('success', 'Updated');
    }

    public function publish(Webinar $webinar): RedirectResponse
    {
        app(WebinarPublishAction::class)->handle($webinar);

        return Redirect::back(303)->with(
            'success',
            'Published.'
        );
    }

    protected function getCourses()
    {
        return Course::select(['id', 'name'])->with('sections')->get();
    }

    protected function getSections()
    {
        return Course::select(['id', 'name'])->with('sections')->get();
    }
}
