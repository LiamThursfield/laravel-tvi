<?php

namespace App\Http\Controllers\AdminApi\CMS;

use App\Actions\CMS\Template\TemplateQueryAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CMS\Template\TemplateIndexRequest;
use App\Http\Resources\Admin\CMS\TemplateResource;
use App\Interfaces\PermissionInterface;
use App\Models\CMS\Template;

class TemplateController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::VIEW_CMS_ADVANCED)
        )->only(['index', 'show']);
    }

    public function index(TemplateIndexRequest $request)
    {
        return TemplateResource::collection(
            app(TemplateQueryAction::class)->handle($request->validated())->get()
        );
    }

    public function show(Template $template) : TemplateResource
    {
        if (!$template->relationLoaded('templateFields')) {
            $template->load('templateFields');
        }

        return TemplateResource::make($template);
    }
}
