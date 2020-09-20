<?php

namespace App\Http\Controllers\AdminApi\FileManager;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileManager\FileManagerDirectoryStoreRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileManagerDirectoryController extends Controller
{
    /** @var string The file system disk to use for Directory management */
    protected $storage_disk;


    public function __construct()
    {
        // TODO: Allow this to be defined via user.
        $this->storage_disk = 'file_manager';
    }


    /**
     * Get a list of directories based on the (optional) base directory
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $directories = collect(Storage::disk($this->storage_disk)->directories($request->get('directory')))
            ->map(function($directory) {
                $label = explode('/', $directory);
                $label = $label[count($label) - 1];

                return compact('directory', 'label');
            });

        return response()->json(compact('directories'));
    }


    /**
     * Create a new directory
     *
     * @param FileManagerDirectoryStoreRequest $request
     * @return JsonResponse
     */
    public function store(FileManagerDirectoryStoreRequest $request)
    {
        $directory = $request->get('directory');
        Storage::disk($this->storage_disk)->makeDirectory($directory);

        return response()->json();
    }
}
