<?php

namespace App\Http\Controllers\AdminApi\CRM;

use App\Actions\CRM\OrganisationUnit\OrganisationUnitQueryAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CRM\OrganisationUnit\OrganisationUnitIndexRequest;
use App\Http\Resources\Admin\CRM\OrganisationUnitResource;
use App\Interfaces\PermissionInterface;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrganisationUnitController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::VIEW_CRM_ORGANISATION_UNITS)
        )->only('show');
    }

    public function index(OrganisationUnitIndexRequest $request) : ResourceCollection
    {
        return OrganisationUnitResource::collection(
            app(OrganisationUnitQueryAction::class)->handle($request->validated())->get()
        );
    }
}
