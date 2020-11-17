<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Http\Controllers\AdminController;
use App\Interfaces\PermissionInterface;
use App\Models\CMS\Template;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class TemplateController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->addMetaTitleSection('CMS');
        $this->addMetaTitleSection('Templates');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::CREATE_CMS)
        )->only(['create', 'store']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::DELETE_CMS)
        )->only('destroy');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::EDIT_CMS)
        )->only(['edit', 'update']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::VIEW_CMS)
        )->only('index');
    }

    public function create()
    {
        // Stub
    }

    public function destroy(Request $request, Template  $template)
    {
        $template->delete();

        return Redirect::back(303)->with(
            'success',
            'Template deleted.'
        );
    }

    public function edit(Template $template)
    {
        // Stub
    }

    public function index(Request $request)
    {
        // Stub
    }

    public function store(Request $request)
    {
        // Stub
    }

    public function update(Request $request, Template $template)
    {
        // Stub
    }
}
