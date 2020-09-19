<?php

namespace App\Http\Controllers\AdminApi\FileManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileManagerDirectoryController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $directories = collect(Storage::disk('file_manager')->directories($request->get('directory')))
            ->map(function($directory) {
                $label = explode('/', $directory);
                $label = $label[count($label) - 1];

                return compact('directory', 'label');
            });

        return response()->json(compact('directories'));
    }
}
