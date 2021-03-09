<?php

namespace App\Http\Controllers\Admin\CRM;

use App\Actions\CRM\FormSubmission\FormSubmissionQueryAction;
use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\CRM\FormSubmission\FormSubmissionIndexRequest;
use App\Http\Resources\Admin\CRM\FormSubmissionResource;
use App\Interfaces\AppInterface;
use App\Interfaces\PermissionInterface;
use App\Models\CRM\Form;
use App\Models\CRM\FormSubmission;
use Illuminate\Support\Arr;
use Inertia\Inertia;
use Inertia\Response;

class FormSubmissionController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->addMetaTitleSection('CRM');
        $this->addMetaTitleSection('Form Submissions');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::VIEW_CRM_FORM_SUBMISSIONS)
        )->only(['index', 'show']);
    }

    public function index(FormSubmissionIndexRequest $request) : Response
    {
        $search_options = $request->validated();
        $search_options['with'] = [
            'contact',
            'form'
        ];

        $this->shareMeta();
        return Inertia::render('admin/crm/form_submission/Index', [
            'searchOptions' => Arr::except($search_options, 'with'),
            'formSubmissions' => function () use ($search_options) {
                return app(FormSubmissionQueryAction::class)->handle($search_options)
                    ->paginate(AppInterface::getSearchPaginationParam($search_options));
            },
            'forms' => function () {
                return Form::orderBy('name', 'asc')->get()->keyBy('id');
            }
        ]);
    }

    public function show(FormSubmission $formSubmission) : Response
    {
        $this->addMetaTitleSection('View')->shareMeta();

        return Inertia::render('admin/crm/form_submission/Show', [
            'formSubmission' => function () use ($formSubmission) {
                $formSubmission->load([
                    'contact',
                    'form',
                    'form.formFields',
                ]);

                FormSubmissionResource::withoutWrapping();
                return FormSubmissionResource::make($formSubmission);
            }
        ]);
    }
}
