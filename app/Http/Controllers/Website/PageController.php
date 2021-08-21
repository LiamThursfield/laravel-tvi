<?php

namespace App\Http\Controllers\Website;

use App\Actions\CMS\Page\PageQueryAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Web\CMS\FullPageResource;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    public function show(Request $request): Response
    {
        if (!config('tvi.web.enabled')) {
            abort(404);
        }

        $search_options = [
            'page_url'  => $request->getPathInfo(),
            'with'      => [
                'content',
                'layout',
                'layout.content',
                'layout.content.templateField',
                'metadata',
                'template',
                'url',
            ]
        ];

        $page = app(PageQueryAction::class)
            ->handle($search_options)
            ->firstOrFail();

        return Inertia::render('website/page/Show', [
            'page' => function () use ($page) {
                return FullPageResource::make($page);
            }
        ]);
    }
}
