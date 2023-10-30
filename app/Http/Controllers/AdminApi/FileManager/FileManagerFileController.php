<?php

namespace App\Http\Controllers\AdminApi\FileManager;

use App\Actions\FileManager\FileManagerFileStoreAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\StorageAttributes;

class FileManagerFileController extends AbstractFileManagerController
{
    /**
     * Get a list of files based on the (optional) base directory
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $files = collect(Storage::disk($this->storage_disk)
            ->listContents($request->get('directory'))
            ->filter(fn (StorageAttributes $attributes) => $attributes->isFile())
            ->map(function (StorageAttributes $attributes)  {
                $meta = $this->getFileMetadata($attributes);
                // Get presigned url available for 5 minutes
                $url = Storage::disk($this->storage_disk)->temporaryUrl(
                    $attributes->path(), Carbon::now()->addMinutes(5)
                );
                return compact('meta', 'url');
            }));

        return response()->json(compact('files'));
    }

    public function store(Request $request)
    {
        if (!config('sigi.file_manager.uploads.enabled')) {
            abort(403, 'Uploads are disabled.');
        }

        $directory = $request->get('directory', "");
        $file = $request->file('file');

        $action = new FileManagerFileStoreAction($this->storage_disk);
        return $action->handle($directory, $file);
    }


    /**
     * Replaces getMetadata from Flysystem v1
     */
    protected function getFileMetadata(StorageAttributes $attribute): array
    {
        $basename = basename($attribute->path());

        $extension = explode('.', $basename);
        if (count($extension) > 1) {
            $extension = $extension[count($extension) - 1];
        } else {
            $extension = null;
        }

        // If there is an extension, remove it for the filename
        $filename = $extension ?
            basename($basename, '.' . $extension) :
            $basename;


        return [
            'basename'  => $basename,
            'etag'      => Arr::get($attribute->extraMetadata(), 'ETag'),
            'extension' => $extension,
            'filename'  => $filename,
            'mimetype'  => Storage::disk($this->storage_disk)->mimeType($attribute->path()), // Unfortunately $attribute->mimeType is null
            'path'      => $attribute->path(),
            'size'      => $attribute->fileSize() ?? null,
            'timestamp' => $attribute->lastModified(),
        ];
    }
}
