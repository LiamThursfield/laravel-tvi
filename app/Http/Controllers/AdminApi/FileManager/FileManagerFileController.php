<?php

namespace App\Http\Controllers\AdminApi\FileManager;

use App\Actions\FileManager\FileManagerFileStoreAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileManagerFileController extends AbstractFileManagerController
{
    /**
     * Get a list of files based on the (optional) base directory
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $files = collect(Storage::disk($this->storage_disk)->files($request->get('directory')))
            ->map(function($file) {
                $meta = Storage::disk($this->storage_disk)->getMetadata($file);
                $url = Storage::disk($this->storage_disk)->url($file);

                return compact('meta', 'url');
            });

        return response()->json(compact('files'));
    }

    public function store(Request $request)
    {
        if (!config('tvi.file_manager.uploads.enabled')) {
            abort(403, 'Uploads are disabled.');
        }

        $directory = $request->get('directory', "");
        $file = $request->file('file');

        $action = new FileManagerFileStoreAction($this->storage_disk);
        return $action->handle($directory, $file);
    }
}
