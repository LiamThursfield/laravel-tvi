<?php

namespace App\Http\Controllers\Admin\CRM;

use App\Actions\CRM\OrganisationUnit\OrganisationUnitQueryAction;
use App\Actions\CRM\OrganisationUnit\OrganisationUnitStoreAction;
use App\Actions\CRM\OrganisationUnit\OrganisationUnitUpdateAction;
use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\CRM\OrganisationUnit\OrganisationUnitIndexRequest;
use App\Http\Requests\Admin\CRM\OrganisationUnit\OrganisationUnitStoreRequest;
use App\Http\Requests\Admin\CRM\OrganisationUnit\OrganisationUnitUpdateRequest;
use App\Http\Resources\Admin\CRM\OrganisationUnitResource;
use App\Interfaces\AppInterface;
use App\Interfaces\CRM\OrganisationUnitInterface;
use App\Interfaces\PermissionInterface;
use App\Models\CRM\OrganisationUnit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class OrganisationUnitController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->addMetaTitleSection('CRM');
        $this->addMetaTitleSection('Organisation Units');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::CREATE_CRM_ORGANISATION_UNITS)
        )->only(['create', 'store']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::DELETE_CRM_ORGANISATION_UNITS)
        )->only('destroy');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::EDIT_CRM_ORGANISATION_UNITS)
        )->only(['edit', 'update']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::VIEW_CRM_ORGANISATION_UNITS)
        )->only('index');
    }

    public function create() : Response
    {
        $this->addMetaTitleSection('Create')->shareMeta();
        return Inertia::render('admin/crm/organisation_unit/Create', [
            'types' => function () {
                return OrganisationUnitInterface::TYPE_LABELS;
            }
        ]);
    }

    public function destroy(OrganisationUnit $organisationUnit) : RedirectResponse
    {
        $organisationUnit->delete();

        return Redirect::back(303)->with(
            'success',
            'Organisation Unit deleted.'
        );
    }

    public function edit(OrganisationUnit $organisationUnit) : Response
    {
        $this->addMetaTitleSection('Edit - ' . $organisationUnit->name)->shareMeta();
        return Inertia::render('admin/crm/organisation_unit/Edit', [
            'organisationUnit' => function () use ($organisationUnit) {
                OrganisationUnitResource::withoutWrapping();
                return OrganisationUnitResource::make($organisationUnit);
            },
            'types' => function () {
                return OrganisationUnitInterface::TYPE_LABELS;
            }
        ]);
    }

    public function index(OrganisationUnitIndexRequest $request) : Response
    {
        $search_options = $request->validated();

        $this->shareMeta();
        return Inertia::render('admin/crm/organisation_unit/Index', [
            'searchOptions' => $search_options,
            'organisationUnits' => function () use ($search_options) {
                return app(OrganisationUnitQueryAction::class)->handle($search_options)
                    ->paginate(AppInterface::getSearchPaginationParam($search_options));
            },
            'organisationUnitTypes' => function () {
                return OrganisationUnitInterface::TYPE_LABELS;
            }
        ]);
    }

    public function store(OrganisationUnitStoreRequest $request) : RedirectResponse
    {
        $organisationUnit = app(OrganisationUnitStoreAction::class)->handle($request->validated());
        return Redirect::to(route('admin.crm.organisation-units.edit'. $organisationUnit->id))
            ->with('success', 'Organisation Unit created.');
    }

    public function update(OrganisationUnitUpdateRequest $request, OrganisationUnit $organisationUnit) : RedirectResponse
    {
        app(OrganisationUnitUpdateAction::class)->handle($organisationUnit, $request->validated());
        return Redirect::to(route('admin.crm.organisation-units.edit', $organisationUnit->id))
            ->with('success', 'Organisation Unit updated.');
    }
}
