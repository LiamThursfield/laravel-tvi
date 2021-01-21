<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Actions\CMS\Layout\LayoutQueryAction;
use App\Actions\CMS\Layout\LayoutStoreAction;
use App\Actions\CMS\Layout\LayoutUpdateAction;
use App\Http\Controllers\AdminCMSAdvancedController;
use App\Http\Requests\Admin\CMS\Layout\LayoutIndexRequest;
use App\Http\Requests\Admin\CMS\Layout\LayoutStoreRequest;
use App\Http\Requests\Admin\CMS\Layout\LayoutUpdateRequest;
use App\Http\Resources\Admin\CMS\LayoutResource;
use App\Interfaces\AppInterface;
use App\Interfaces\CMS\TemplateInterface;
use App\Models\CMS\Layout;
use App\Models\CMS\Template;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response;

class LayoutController extends AdminCMSAdvancedController
{

    public function __construct()
    {
        parent::__construct();
        $this->addMetaTitleSection('Layouts');
    }

    public function create() : Response
    {
        $this->addMetaTitleSection('Create')->shareMeta();
        return Inertia::render('admin/cms/layout/Create', [
            'templates' => function () {
                return Template::where('type', TemplateInterface::TYPE_LAYOUT)
                    ->orderBy('name', 'asc')
                    ->get()
                    ->keyBy('id');
            },
        ]);
    }

    public function destroy(Request $request, Layout $layout) : RedirectResponse
    {
        $layout->delete();

        return Redirect::back(303)->with(
            'success',
            'Layout deleted.'
        );
    }

    public function edit(Layout $layout) : Response
    {
        $layout->load([
            'content',
            'template',
            'template.templateFields'
        ]);

        $this->addMetaTitleSection('Edit - ' . $layout->name)->shareMeta();
        return Inertia::render('admin/cms/layout/Edit', [
            'layout' => function () use ($layout) {
                LayoutResource::withoutWrapping();
                return LayoutResource::make($layout);
            } ,
            'templates' => function () {
                return Template::where('type', TemplateInterface::TYPE_LAYOUT)
                    ->orderBy('name', 'asc')
                    ->get()
                    ->keyBy('id');
            },
        ]);
    }

    public function index(LayoutIndexRequest $request)
    {
        $search_options = $request->validated();
        $search_options['with'] = ['template'];

        $this->shareMeta();
        return Inertia::render('admin/cms/layout/Index', [
            'layouts' => function () use ($search_options) {
                return app(LayoutQueryAction::class)
                    ->handle($search_options)
                    ->paginate(AppInterface::getSearchPaginationParam($search_options));
            },
            'searchOptions' => $search_options,
            'templates' => function () {
                return Template::where('type', TemplateInterface::TYPE_LAYOUT)
                    ->orderBy('name', 'asc')
                    ->get()
                    ->keyBy('id');
            }
        ]);
    }

    public function store(LayoutStoreRequest $request) : RedirectResponse
    {
        $layout = app(LayoutStoreAction::class)->handle($request->validated());
        return Redirect::to(route('admin.cms.layouts.edit', $layout))
            ->with('success', 'Layout Created');
    }

    public function update(LayoutUpdateRequest $request, Layout $layout) : RedirectResponse
    {
        $layout = app(LayoutUpdateAction::class)->handle($layout, $request->validated());
        return Redirect::to(route('admin.cms.layouts.edit', $layout))
            ->with('success', 'Layout Updated');
    }
}
