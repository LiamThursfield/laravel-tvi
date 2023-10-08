<?php

namespace App\Http\Controllers\Admin\EDU\Label;

use App\Actions\EDU\Label\LabelQueryAction;
use App\Actions\EDU\Label\LabelStoreAction;
use App\Actions\EDU\Label\LabelUpdateAction;
use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\EDU\Label\LabelIndexRequest;
use App\Http\Requests\Admin\EDU\Label\LabelStoreRequest;
use App\Http\Requests\Admin\EDU\Label\LabelUpdateRequest;
use App\Http\Resources\Admin\EDU\Label\LabelResource;
use App\Interfaces\AppInterface;
use App\Interfaces\PermissionInterface;
use App\Models\EDU\Label\Label;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class LabelController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->addMetaTitleSection('EDU');
        $this->addMetaTitleSection('Labels');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::CREATE_EDU_LABELS)
        )->only(['create', 'store']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::DELETE_EDU_LABELS)
        )->only('destroy');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::EDIT_EDU_LABELS)
        )->only(['edit', 'update']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::VIEW_EDU_LABELS)
        )->only('index');
    }

    public function create(): Response
    {
        $this->addMetaTitleSection('Create')->shareMeta();

        return Inertia::render('admin/edu/label/Create', []);
    }

    public function destroy(Label $label): RedirectResponse
    {
        $label->delete();

        return Redirect::back(303)->with(
            'success',
            'Deleted.'
        );
    }

    public function edit(Label $label): Response
    {
        $this->addMetaTitleSection('Edit - ' . $label->name)->shareMeta();

        return Inertia::render('admin/edu/label/Edit', [
            'label' => function () use ($label) {
                LabelResource::withoutWrapping();
                return LabelResource::make($label);
            }
        ]);
    }

    public function index(LabelIndexRequest $request): Response
    {
        $search_options = $request->validated();

        $this->shareMeta();

        return Inertia::render('admin/edu/label/Index', [
            'labels' => function () use ($search_options) {
                return app(LabelQueryAction::class)
                    ->handle($search_options)
                    ->paginate(AppInterface::getSearchPaginationParam($search_options));
            },
            'searchOptions' => $search_options
        ]);
    }

    public function store(LabelStoreRequest $request): RedirectResponse
    {
        $label = app(LabelStoreAction::class)->handle($request->validated());

        return Redirect::to(route('admin.edu.labels.edit', $label))
            ->with('success', 'Created');
    }

    public function update(LabelUpdateRequest $request, Label $label): RedirectResponse
    {
        $label = app(LabelUpdateAction::class)->handle($label, $request->validated());

        return Redirect::to(route('admin.edu.labels.edit', $label))
            ->with('success', 'Updated');
    }
}
