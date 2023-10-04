<?php

namespace App\Http\Controllers\Admin\EDU\Lecture;

use App\Actions\EDU\Lecture\LectureQueryAction;
use App\Actions\EDU\Lecture\LectureStoreAction;
use App\Actions\EDU\Lecture\LectureUpdateAction;
use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\EDU\Lecture\LectureIndexRequest;
use App\Http\Requests\Admin\EDU\Lecture\LectureStoreRequest;
use App\Http\Requests\Admin\EDU\Lecture\LectureUpdateRequest;
use App\Http\Resources\Admin\EDU\Lecture\LectureResource;
use App\Interfaces\AppInterface;
use App\Interfaces\PermissionInterface;
use App\Models\EDU\Lecture\Lecture;
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

    public function destroy(Lecture $lecture) : RedirectResponse
    {
        $lecture->delete();

        return Redirect::back(303)->with(
            'success',
            'Deleted.'
        );
    }

    public function edit(Lecture $lecture) : Response
    {
        $this->addMetaTitleSection('Edit - ' . $lecture->title)->shareMeta();

        return Inertia::render('admin/edu/lecture/Edit', [
            'lecture' => function () use ($lecture) {
                LectureResource::withoutWrapping();
                return LectureResource::make($lecture);
            }
        ]);
    }

    public function index(LectureIndexRequest $request) : Response
    {
        $search_options = $request->validated();

        $this->shareMeta();

        return Inertia::render('admin/edu/lecture/Index', [
            'lectures' => function () use ($search_options) {
                return app(LectureQueryAction::class)
                    ->handle($search_options)
                    ->paginate(AppInterface::getSearchPaginationParam($search_options));
            },
            'searchOptions' => $search_options
        ]);
    }

    public function store(LectureStoreRequest $request) : RedirectResponse
    {
        $lecture = app(LectureStoreAction::class)->handle($request->validated());

        return Redirect::to(route('admin.edu.lectures.edit', $lecture))
            ->with('success', 'Created');
    }

    public function update(LectureUpdateRequest $request, Lecture $lecture) : RedirectResponse
    {
        $lecture = app(LectureUpdateAction::class)->handle($lecture, $request->validated());

        return Redirect::to(route('admin.edu.lectures.edit', $lecture))
            ->with('success', 'Updated');
    }
}
