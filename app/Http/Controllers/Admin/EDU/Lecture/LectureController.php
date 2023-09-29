<?php

namespace App\Http\Controllers\Admin\EDU\Lecture;

use App\Actions\EDU\Section\SectionQueryAction;
use App\Actions\EDU\Section\SectionStoreAction;
use App\Actions\EDU\Section\SectionUpdateAction;
use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\EDU\Section\SectionIndexRequest;
use App\Http\Requests\Admin\EDU\Section\SectionStoreRequest;
use App\Http\Requests\Admin\EDU\Section\SectionUpdateRequest;
use App\Http\Resources\Admin\EDU\Lecture\LectureResource;
use App\Interfaces\AppInterface;
use App\Interfaces\PermissionInterface;
use App\Models\EDU\Section\Section;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class LectureController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->addMetaTitleSection('EDU');
        $this->addMetaTitleSection('Lectures');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::CREATE_EDU_LECTURES)
        )->only(['create', 'store']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::DELETE_EDU_LECTURES)
        )->only('destroy');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::EDIT_EDU_LECTURES)
        )->only(['edit', 'update']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::VIEW_EDU_LECTURES)
        )->only('index');
    }

    public function create() : Response
    {
        $this->addMetaTitleSection('Create')->shareMeta();

        return Inertia::render('admin/edu/lecture/Create') ;
    }

    public function destroy(Section $lecture) : RedirectResponse
    {
        $lecture->delete();

        return Redirect::back(303)->with(
            'success',
            'Deleted.'
        );
    }

    public function edit(Section $lecture) : Response
    {
        $this->addMetaTitleSection('Edit - ' . $lecture->title)->shareMeta();

        return Inertia::render('admin/edu/lecture/Edit', [
            'lecture' => function () use ($lecture) {
                LectureResource::withoutWrapping();
                return LectureResource::make($lecture);
            }
        ]);
    }

    public function index(SectionIndexRequest $request) : Response
    {
        $search_options = $request->validated();

        $this->shareMeta();

        return Inertia::render('admin/edu/lecture/Index', [
            'lectures' => function () use ($search_options) {
                return app(SectionQueryAction::class)
                    ->handle($search_options)
                    ->paginate(AppInterface::getSearchPaginationParam($search_options));
            },
            'searchOptions' => $search_options
        ]);
    }

    public function store(SectionStoreRequest $request) : RedirectResponse
    {
        $lecture = app(SectionStoreAction::class)->handle($request->validated());

        return Redirect::to(route('admin.edu.lectures.edit', $lecture))
            ->with('success', 'Created');
    }

    public function update(SectionUpdateRequest $request, Section $lecture) : RedirectResponse
    {
        $lecture = app(SectionUpdateAction::class)->handle($lecture, $request->validated());

        return Redirect::to(route('admin.edu.lectures.edit', $lecture))
            ->with('success', 'Updated');
    }
}
