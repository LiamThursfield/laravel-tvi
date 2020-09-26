<?php

namespace App\Http\Controllers\AdminApi\FileManager;

use App\Http\Controllers\Controller;

class AbstractFileManagerController extends Controller
{
    /** @var string The file system disk to use for Directory management */
    protected $storage_disk;


    public function __construct()
    {
        // TODO: Allow this to be defined via user.
        $this->storage_disk = 'file_manager';
    }

}
