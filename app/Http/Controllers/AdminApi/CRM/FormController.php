<?php

namespace App\Http\Controllers\AdminApi\CRM;

use App\Actions\CRM\Form\FormQueryAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CRM\Form\FormIndexRequest;
use App\Http\Resources\Admin\CRM\FormResource;
use App\Interfaces\PermissionInterface;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FormController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::VIEW_CRM_FORMS)
        )->only('show');
    }

    public function index(FormIndexRequest $request) : ResourceCollection
    {
        return FormResource::collection(
            app(FormQueryAction::class)->handle($request->validated())->get()
        );
    }
}
