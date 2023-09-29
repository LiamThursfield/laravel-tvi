<?php

namespace App\Http\Controllers\Admin\EDU\Programme;

use App\Actions\EDU\Programme\ProgrammeQueryAction;
use App\Actions\EDU\Programme\ProgrammeStoreAction;
use App\Actions\EDU\Programme\ProgrammeUpdateAction;
use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\EDU\Programme\ProgrammeIndexRequest;
use App\Http\Requests\Admin\EDU\Programme\ProgrammeStoreRequest;
use App\Http\Requests\Admin\EDU\Programme\ProgrammeUpdateRequest;
use App\Http\Resources\Admin\EDU\Programme\ProgrammeResource;
use App\Interfaces\AppInterface;
use App\Interfaces\PermissionInterface;
use App\Models\EDU\Programme\Programme;
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
            PermissionInterface::getMiddlewareString(PermissionInterface::CREATE_EDU_PROGRAMMES)
        )->only(['create', 'store']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::DELETE_EDU_PROGRAMMES)
        )->only('destroy');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::EDIT_EDU_PROGRAMMES)
        )->only(['edit', 'update']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::VIEW_EDU_PROGRAMMES)
        )->only('index');
    }

    public function create(): Response
    {
        $this->addMetaTitleSection('Create')->shareMeta();

        return Inertia::render('admin/edu/programme/Create', []);
    }

    public function destroy(Programme $programme): RedirectResponse
    {
        $programme->delete();

        return Redirect::back(303)->with(
            'success',
            'Deleted.'
        );
    }

    public function edit(Programme $programme): Response
    {
        $this->addMetaTitleSection('Edit - ' . $programme->name)->shareMeta();

        return Inertia::render('admin/edu/programme/Edit', [
            'programme' => function () use ($programme) {
                ProgrammeResource::withoutWrapping();
                return ProgrammeResource::make($programme);
            }
        ]);
    }

    public function index(ProgrammeIndexRequest $request): Response
    {
        $search_options = $request->validated();

        $this->shareMeta();

        return Inertia::render('admin/edu/programme/Index', [
            'programmes' => function () use ($search_options) {
                return app(ProgrammeQueryAction::class)
                    ->handle($search_options)
                    ->paginate(AppInterface::getSearchPaginationParam($search_options));
            },
            'searchOptions' => $search_options
        ]);
    }

    public function store(ProgrammeStoreRequest $request): RedirectResponse
    {
        $programme = app(ProgrammeStoreAction::class)->handle($request->validated());

        return Redirect::to(route('admin.edu.programme.edit', $programme))
            ->with('success', 'Created');
    }

    public function update(ProgrammeUpdateRequest $request, Programme $programme): RedirectResponse
    {
        $programme = app(ProgrammeUpdateAction::class)->handle($programme, $request->validated());

        return Redirect::to(route('admin.edu.programme.edit', $programme))
            ->with('success', 'Updated');
    }
}
