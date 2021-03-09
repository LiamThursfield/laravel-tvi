<?php

namespace App\Http\Controllers\AdminApi\FileManager;

use App\Http\Requests\Admin\FileManager\FileManagerDirectoryStoreRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileManagerDirectoryController extends AbstractFileManagerController
{
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
        if (!config('tvi.file_manager.uploads.enabled')) {
            abort(403, 'Directory Creation/Uploads are disabled.');
        }

        $directory = $request->get('directory');
        Storage::disk($this->storage_disk)->makeDirectory($directory);

        return response()->json();
    }
}
