<?php

namespace App\Http\Controllers\Website;

use App\Actions\CMS\Page\PageQueryAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Web\CMS\FullPageResource;
use App\Models\Settings\ThemeSettings;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    public function show(Request $request): Response
    {
        if (!config('sigi.web.enabled')) {
            abort(404);
        }

        $search_options = [
            'is_active' => true,
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

        try {
            $page = app(PageQueryAction::class)
                ->handle($search_options)
                ->firstOrFail();
        } catch (\Exception $e) {
            abort(404);
        }

        $page->logo_url = app(ThemeSettings::class)->getLogoUrl();

        return Inertia::render('website/page/Show', [
            'page' => function () use ($page) {
                return FullPageResource::make($page);
            }
        ]);
    }
}
