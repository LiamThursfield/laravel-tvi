<?php

namespace App\Http\Controllers\Admin\CRM;

use App\Actions\CRM\Form\FormQueryAction;
use App\Actions\CRM\Form\FormStoreAction;
use App\Actions\CRM\Form\FormUpdateAction;
use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\CRM\Form\FormIndexRequest;
use App\Http\Requests\Admin\CRM\Form\FormStoreRequest;
use App\Http\Requests\Admin\CRM\Form\FormUpdateRequest;
use App\Http\Resources\Admin\CRM\FormResource;
use App\Interfaces\AppInterface;
use App\Interfaces\CRM\FormFieldInterface;
use App\Interfaces\PermissionInterface;
use App\Models\CRM\Form;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class FormController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->addMetaTitleSection('CRM');
        $this->addMetaTitleSection('Forms');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::CREATE_CRM_FORMS)
        )->only(['create', 'store']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::DELETE_CRM_FORMS)
        )->only('destroy');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::EDIT_CRM_FORMS)
        )->only(['edit', 'update']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::VIEW_CRM_FORMS)
        )->only('index');
    }

    public function create() : Response
    {
        $this->addMetaTitleSection('Create')->shareMeta();
        return Inertia::render('admin/crm/form/Create', [
            'crmFormFieldTypes' => function () {
                return FormFieldInterface::getAllCrmTypesLabelled();
            },
            'formFieldSettings' => function () {
                return FormFieldInterface::TYPE_SETTINGS;
            },
            'standardFormFieldTypes' => function () {
                return FormFieldInterface::getAllStandardTypesLabelled();
            }
        ]);
    }

    public function destroy(Form $form) : RedirectResponse
    {
        $form->delete();

        return Redirect::back(303)->with(
            'success',
            'Form deleted.'
        );
    }

    public function edit(Form $form) : Response
    {
        $this->addMetaTitleSection('Edit - ' . $form->name)->shareMeta();
        
        return Inertia::render('admin/crm/form/Edit', [
            'crmFormFieldTypes' => function () {
                return FormFieldInterface::getAllCrmTypesLabelled();
            },
            'form' => function () use ($form) {
                if (!$form->relationLoaded('formFields')) {
                    $form->load('formFields');
                }

                FormResource::withoutWrapping();
                return FormResource::make($form);
            },
            'formFieldSettings' => function () {
                return FormFieldInterface::TYPE_SETTINGS;
            },
            'standardFormFieldTypes' => function () {
                return FormFieldInterface::getAllStandardTypesLabelled();
            },
        ]);
    }

    public function index(FormIndexRequest $request) : Response
    {
        $search_options = $request->validated();

        $this->shareMeta();
        return Inertia::render('admin/crm/form/Index', [
            'searchOptions' => $search_options,
            'forms' => function () use ($search_options) {
                return app(FormQueryAction::class)->handle($search_options)
                    ->paginate(AppInterface::getSearchPaginationParam($search_options));
            }
        ]);
    }

    public function store(FormStoreRequest $request) : RedirectResponse
    {
        $form = app(FormStoreAction::class)->handle($request->validated());
        return Redirect::to(route('admin.crm.forms.edit', $form))
            ->with('success', 'Form created.');
    }

    public function update(FormUpdateRequest $request, Form $form) : RedirectResponse
    {
        app(FormUpdateAction::class)->handle($form, $request->validated());
        return Redirect::to(route('admin.crm.forms.edit', $form))
            ->with('success', 'Form updated.');
    }
}
