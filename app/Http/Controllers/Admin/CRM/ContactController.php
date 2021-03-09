<?php

namespace App\Http\Controllers\Admin\CRM;

use App\Actions\CRM\Contact\ContactQueryAction;
use App\Actions\CRM\Contact\ContactStoreAction;
use App\Actions\CRM\Contact\ContactUpdateAction;
use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\CRM\Contact\ContactIndexRequest;
use App\Http\Requests\Admin\CRM\Contact\ContactStoreRequest;
use App\Http\Requests\Admin\CRM\Contact\ContactUpdateRequest;
use App\Http\Resources\Admin\CRM\ContactResource;
use App\Interfaces\AppInterface;
use App\Interfaces\PermissionInterface;
use App\Models\CRM\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ContactController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->addMetaTitleSection('CRM');
        $this->addMetaTitleSection('Contacts');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::CREATE_CRM_CONTACTS)
        )->only(['create', 'store']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::DELETE_CRM_CONTACTS)
        )->only('destroy');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::EDIT_CRM_CONTACTS)
        )->only(['edit', 'update']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::VIEW_CRM_CONTACTS)
        )->only('index');
    }

    public function create() : Response
    {
        $this->addMetaTitleSection('Create')->shareMeta();
        return Inertia::render('admin/crm/contact/Create');
    }

    public function destroy(Contact $contact) : RedirectResponse
    {
        $contact->delete();

        return Redirect::back(303)->with(
            'success',
            'Contact deleted.'
        );
    }

    public function edit(Contact $contact) : Response
    {
        $this->addMetaTitleSection('Edit - ' . $contact->name)->shareMeta();
        return Inertia::render('admin/crm/contact/Edit', [
            'contact' => function () use ($contact) {
                ContactResource::withoutWrapping();
                return ContactResource::make($contact);
            }
        ]);
    }

    public function index(ContactIndexRequest $request) : Response
    {
        $search_options = $request->validated();

        $this->shareMeta();
        return Inertia::render('admin/crm/contact/Index', [
            'searchOptions' => $search_options,
            'contacts' => function () use ($search_options) {
                return app(ContactQueryAction::class)->handle($search_options)
                    ->paginate(AppInterface::getSearchPaginationParam($search_options));
            }
        ]);
    }

    public function store(ContactStoreRequest $request) : RedirectResponse
    {
        $user = app(ContactStoreAction::class)->handle($request->validated());
        return Redirect::to(route('admin.crm.contacts.edit', $user))
            ->with('success', 'Contact created.');
    }

    public function update(ContactUpdateRequest $request, Contact $contact) : RedirectResponse
    {
        app(ContactUpdateAction::class)->handle($contact, $request->validated());
        return Redirect::to(route('admin.crm.contacts.edit', $contact))
            ->with('success', 'Contact updated.');
    }
}
