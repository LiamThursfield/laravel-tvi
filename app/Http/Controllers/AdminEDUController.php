<?php

namespace App\Http\Controllers;

use App\Interfaces\PermissionInterface;

class AdminEDUController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->addMetaTitleSection('EDU');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::CREATE_EDU_COURSES)
        )->only(['create', 'store']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::DELETE_EDU_COURSES)
        )->only('destroy');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::EDIT_EDU_COURSES)
        )->only(['edit', 'update']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::VIEW_EDU_COURSES)
        )->only(['index', 'show']);
    }
}
