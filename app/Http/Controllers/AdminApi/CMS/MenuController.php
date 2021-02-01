<?php

namespace App\Http\Controllers\AdminApi\CMS;

use App\Actions\CMS\Menu\MenuQueryAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CMS\Menu\MenuIndexRequest;
use App\Http\Resources\Admin\CMS\MenuResource;
use App\Http\Resources\Admin\CMS\TemplateResource;
use App\Interfaces\PermissionInterface;
use App\Models\CMS\Template;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::VIEW_CMS)
        )->only('show');
    }

    public function index(MenuIndexRequest $request) : ResourceCollection
    {
        return MenuResource::collection(
            app(MenuQueryAction::class)->handle($request->validated())->get()
        );
    }
}
