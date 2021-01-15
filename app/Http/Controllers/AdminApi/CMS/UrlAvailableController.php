<?php

namespace App\Http\Controllers\AdminApi\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminApi\CMS\URL\UrlAvailableRequest;
use App\Interfaces\PermissionInterface;
use App\Models\CMS\Url;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

class UrlAvailableController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::VIEW_CMS)
        )->only('handle');
    }

    public function handle(UrlAvailableRequest $request) : JsonResponse
    {
        $request_data = $request->validated();

        $url = Arr::get($request_data, 'url');
        if ($url !== '/') {
            $url = rtrim($url, '/');
        }

        $query = Url::where('url_full', $url);
        if (Arr::get($request_data, 'url_id')) {
            $query->where('id', '<>', Arr::get($request_data, 'url_id'));
        }

        return response()->json(
            $query->count() < 1
        );
    }
}
