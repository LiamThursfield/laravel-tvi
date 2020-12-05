<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Actions\CMS\Template\TemplateQueryAction;
use App\Actions\CMS\Template\TemplateStoreAction;
use App\Actions\CMS\Template\TemplateUpdateAction;
use App\Http\Controllers\AdminCMSController;
use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\CMS\Template\TemplateIndexRequest;
use App\Http\Requests\Admin\CMS\Template\TemplateStoreRequest;
use App\Http\Requests\Admin\CMS\Template\TemplateUpdateRequest;
use App\Http\Resources\Admin\CMS\TemplateResource;
use App\Interfaces\CMS\TemplateFieldInterface;
use App\Interfaces\CMS\TemplateInterface;
use App\Interfaces\PermissionInterface;
use App\Models\CMS\Template;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class TemplateController extends AdminCMSController
{

    public function __construct()
    {
        parent::__construct();
        $this->addMetaTitleSection('Templates');
    }

    public function create()
    {
        $this->addMetaTitleSection('Create')->shareMeta();
        return Inertia::render('admin/cms/template/Create', [
            'template_field_settings' => function() {
                return TemplateFieldInterface::SETTINGS;
            },
            'template_field_types' => function () {
                return TemplateFieldInterface::ALL_TYPES_LABELLED;
            },
            'template_types' => function () {
                return TemplateInterface::ALL_TYPES_LABELLED;
            }
        ]);
    }

    public function destroy(Request $request, Template  $template)
    {
        $template->delete();

        return Redirect::back(303)->with(
            'success',
            'Template deleted.'
        );
    }

    public function edit(Template $template)
    {
        $this->addMetaTitleSection('Edit - ' . $template->name)->shareMeta();
        return Inertia::render('admin/cms/template/Edit', [
            'template' => function () use ($template) {
                if (!$template->relationLoaded('templateFields')) {
                    $template->load('templateFields');
                }

                TemplateResource::withoutWrapping();
                return TemplateResource::make($template);
            },
            'template_field_settings' => function() {
                return TemplateFieldInterface::SETTINGS;
            },
            'template_field_types' => function () {
                return TemplateFieldInterface::ALL_TYPES_LABELLED;
            },
            'template_types' => function () {
                return TemplateInterface::ALL_TYPES_LABELLED;
            }
        ]);
    }

    public function index(TemplateIndexRequest $request)
    {
        $search_options = $request->validated();
        $search_options['per_page'] = Arr::get($search_options, 'per_page', 15);

        $this->shareMeta();
        return Inertia::render('admin/cms/template/Index', [
            'search_options' => $search_options,
            'templates' => function () use ($search_options) {
                return app(TemplateQueryAction::class)
                    ->handle($search_options)
                    ->paginate(Arr::get($search_options, 'per_page', 15));
            },
            'template_types' => function () {
                return TemplateInterface::ALL_TYPES_LABELLED;
            }
        ]);
    }

    public function store(TemplateStoreRequest $request)
    {
        $template = app(TemplateStoreAction::class)->handle($request->validated());
        return Redirect::to(route('admin.cms.templates.edit', $template))
            ->with('success', 'Template created.');
    }

    public function update(TemplateUpdateRequest $request, Template $template)
    {
        $template = app(TemplateUpdateAction::class)->handle($template, $request->validated());
        return Redirect::to(route('admin.cms.templates.edit', $template))
            ->with('success', 'Template updated.');
    }
}
