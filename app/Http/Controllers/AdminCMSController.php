<?php

namespace App\Http\Controllers;

use App\Interfaces\PermissionInterface;
use App\Traits\Admin\InertiaMeta;

class AdminCMSController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->addMetaTitleSection('CMS');

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
        )->only(['index', 'show']);
    }
}
