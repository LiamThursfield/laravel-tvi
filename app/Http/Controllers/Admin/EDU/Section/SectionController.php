<?php

namespace App\Http\Controllers\Admin\EDU\Section;

use App\Actions\EDU\Section\SectionQueryAction;
use App\Actions\EDU\Section\SectionStoreAction;
use App\Actions\EDU\Section\SectionUpdateAction;
use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\EDU\Section\SectionIndexRequest;
use App\Http\Requests\Admin\EDU\Section\SectionStoreRequest;
use App\Http\Requests\Admin\EDU\Section\SectionUpdateRequest;
use App\Http\Resources\Admin\EDU\Section\SectionResource;
use App\Interfaces\AppInterface;
use App\Interfaces\PermissionInterface;
use App\Models\EDU\Section\Section;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class SectionController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->addMetaTitleSection('EDU');
        $this->addMetaTitleSection('Sections');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::CREATE_EDU_SECTIONS)
        )->only(['create', 'store']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::DELETE_EDU_SECTIONS)
        )->only('destroy');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::EDIT_EDU_SECTIONS)
        )->only(['edit', 'update']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::VIEW_EDU_SECTIONS)
        )->only('index');
    }

    public function create() : Response
    {
        $this->addMetaTitleSection('Create')->shareMeta();

        return Inertia::render('admin/edu/section/Create') ;
    }

    public function destroy(Section $section) : RedirectResponse
    {
        $section->delete();

        return Redirect::back(303)->with(
            'success',
            'Deleted.'
        );
    }

    public function edit(Section $section) : Response
    {
        $this->addMetaTitleSection('Edit - ' . $section->name)->shareMeta();

        return Inertia::render('admin/edu/section/Edit', [
            'section' => function () use ($section) {
                SectionResource::withoutWrapping();
                return SectionResource::make($section);
            }
        ]);
    }

    public function index(SectionIndexRequest $request) : Response
    {
        $search_options = $request->validated();

        $this->shareMeta();

        return Inertia::render('admin/edu/section/Index', [
            'sections' => function () use ($search_options) {
                return app(SectionQueryAction::class)
                    ->handle($search_options)
                    ->paginate(AppInterface::getSearchPaginationParam($search_options));
            },
            'searchOptions' => $search_options
        ]);
    }

    public function store(SectionStoreRequest $request) : RedirectResponse
    {
        $section = app(SectionStoreAction::class)->handle($request->validated());

        return Redirect::to(route('admin.edu.sections.edit', $section))
            ->with('success', 'Created');
    }

    public function update(SectionUpdateRequest $request, Section $section) : RedirectResponse
    {
        $section = app(SectionUpdateAction::class)->handle($section, $request->validated());

        return Redirect::to(route('admin.edu.sections.edit', $section))
            ->with('success', 'Updated');
    }
}
