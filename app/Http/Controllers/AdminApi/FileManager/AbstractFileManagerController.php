<?php

namespace App\Http\Controllers\AdminApi\FileManager;

use App\Http\Controllers\Controller;
use App\Interfaces\PermissionInterface;

class AbstractFileManagerController extends Controller
{
    /** @var string The file system disk to use for Directory management */
    protected $storage_disk;


    public function __construct()
    {
        // TODO: Allow this to be defined via user.
        $this->storage_disk = 'file_manager';

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::VIEW_FILE_MANAGER)
        )->only('index');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::EDIT_FILE_MANAGER)
        )->only('store');
    }

}
