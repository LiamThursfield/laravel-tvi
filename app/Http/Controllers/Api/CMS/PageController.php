<?php

namespace App\Http\Controllers\Api\CMS;

use App\Actions\CMS\Page\PageQueryAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CMS\PageShowRequest;
use App\Http\Resources\Web\CMS\FullPageResource;
use Illuminate\Http\JsonResponse;

class PageController extends Controller
{
    public function show(PageShowRequest $request)
    {
        $search_options = $request->validated();
        $search_options['with'] = [
            'content',
            'layout',
            'layout.content',
            'layout.content.templateField',
            'metadata',
            'template',
            'url',
        ];

        return new JsonResponse(FullPageResource::make(
            app(PageQueryAction::class)->handle($search_options)->firstOrFail()
        ));
    }
}
