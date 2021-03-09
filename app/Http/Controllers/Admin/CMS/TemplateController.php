<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Actions\CMS\Template\TemplateQueryAction;
use App\Actions\CMS\Template\TemplateStoreAction;
use App\Actions\CMS\Template\TemplateUpdateAction;
use App\Http\Controllers\AdminCMSAdvancedController;
use App\Http\Requests\Admin\CMS\Template\TemplateIndexRequest;
use App\Http\Requests\Admin\CMS\Template\TemplateStoreRequest;
use App\Http\Requests\Admin\CMS\Template\TemplateUpdateRequest;
use App\Http\Resources\Admin\CMS\TemplateResource;
use App\Interfaces\AppInterface;
use App\Interfaces\CMS\TemplateFieldInterface;
use App\Interfaces\CMS\TemplateInterface;
use App\Models\CMS\Template;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response;

class TemplateController extends AdminCMSAdvancedController
{

    public function __construct()
    {
        parent::__construct();
        $this->addMetaTitleSection('Templates');
    }

    public function create() : Response
    {
        $this->addMetaTitleSection('Create')->shareMeta();
        return Inertia::render('admin/cms/template/Create', [
            'repeaterTemplateFieldTypes' => function () {
                return TemplateFieldInterface::getAllRepeaterTypesLabelled();
            },
            'templateFieldSettings' => function () {
                return TemplateFieldInterface::SETTINGS;
            },
            'templateFieldTypes' => function () {
                return TemplateFieldInterface::ALL_TYPES_LABELLED;
            },
            'templateTypes' => function () {
                return TemplateInterface::ALL_TYPES_LABELLED;
            }
        ]);
    }

    public function destroy(Request $request, Template  $template) : RedirectResponse
    {
        $template->delete();

        return Redirect::back(303)->with(
            'success',
            'Template deleted.'
        );
    }

    public function edit(Template $template) : Response
    {
        $this->addMetaTitleSection('Edit - ' . $template->name)->shareMeta();
        return Inertia::render('admin/cms/template/Edit', [
            'repeaterTemplateFieldTypes' => function () {
                return TemplateFieldInterface::getAllRepeaterTypesLabelled();
            },
            'template' => function () use ($template) {
                if (!$template->relationLoaded('templateFields')) {
                    $template->load('templateFields');
                }

                TemplateResource::withoutWrapping();
                return TemplateResource::make($template);
            },
            'templateFieldSettings' => function() {
                return TemplateFieldInterface::SETTINGS;
            },
            'templateFieldTypes' => function () {
                return TemplateFieldInterface::ALL_TYPES_LABELLED;
            },
            'templateTypes' => function () {
                return TemplateInterface::ALL_TYPES_LABELLED;
            }
        ]);
    }

    public function index(TemplateIndexRequest $request) : Response
    {
        $search_options = $request->validated();

        $this->shareMeta();
        return Inertia::render('admin/cms/template/Index', [
            'searchOptions' => $search_options,
            'templates' => function () use ($search_options) {
                return app(TemplateQueryAction::class)
                    ->handle($search_options)
                    ->paginate(AppInterface::getSearchPaginationParam($search_options));
            },
            'templateTypes' => function () {
                return TemplateInterface::ALL_TYPES_LABELLED;
            }
        ]);
    }

    public function store(TemplateStoreRequest $request) : RedirectResponse
    {
        $template = app(TemplateStoreAction::class)->handle($request->validated());
        return Redirect::to(route('admin.cms.templates.edit', $template))
            ->with('success', 'Template created.');
    }

    public function update(TemplateUpdateRequest $request, Template $template) : RedirectResponse
    {
        $template = app(TemplateUpdateAction::class)->handle($template, $request->validated());
        return Redirect::to(route('admin.cms.templates.edit', $template))
            ->with('success', 'Template updated.');
    }
}
