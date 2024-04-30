<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Actions\CMS\Redirect\RedirectQueryAction;
use App\Actions\CMS\Redirect\RedirectStoreAction;
use App\Actions\CMS\Redirect\RedirectUpdateAction;
use App\Http\Controllers\AdminCMSAdvancedController;
use App\Http\Requests\Admin\CMS\Redirect\RedirectIndexRequest;
use App\Http\Requests\Admin\CMS\Redirect\RedirectStoreRequest;
use App\Http\Requests\Admin\CMS\Redirect\RedirectUpdateRequest;
use App\Http\Resources\Admin\CMS\RedirectResource;
use App\Interfaces\AppInterface;
use App\Models\CMS\Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect as LaravelRedirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response;

class RedirectController extends AdminCMSAdvancedController
{

    public function __construct()
    {
        parent::__construct();
        $this->addMetaTitleSection('Redirects');
    }

    public function create() : Response
    {
        $this->addMetaTitleSection('Create')->shareMeta();
        return Inertia::render('admin/cms/redirect/Create');
    }

    public function destroy(Request $request, Redirect $cms_redirect) : RedirectResponse
    {
        $cms_redirect->delete();

        return LaravelRedirect::back(303)->with(
            'success',
            'Redirect deleted.'
        );
    }

    public function edit(Redirect $cms_redirect) : Response
    {
        $this->addMetaTitleSection('Edit Redirect')->shareMeta();
        return Inertia::render('admin/cms/redirect/Edit', [
            'redirect' => function () use ($cms_redirect) {
                RedirectResource::withoutWrapping();
                return RedirectResource::make($cms_redirect);
            },
        ]);
    }

    public function index(RedirectIndexRequest $request) : Response
    {
        $search_options = $request->validated();

        $this->shareMeta();

        return Inertia::render('admin/cms/redirect/Index', [
            'searchOptions' => $search_options,
            'redirects' => function () use ($search_options) {
                return RedirectResource::collection(
                    app(RedirectQueryAction::class)
                        ->handle($search_options)
                        ->paginate(AppInterface::getSearchPaginationParam($search_options))
                );
            },
        ]);
    }

    public function store(RedirectStoreRequest $request): RedirectResponse
    {
        $cms_redirect = app(RedirectStoreAction::class)->handle($request->validated());
        return LaravelRedirect::to(route('admin.cms.redirects.edit', $cms_redirect))
            ->with('success', 'Redirect created.');
    }

    public function update(RedirectUpdateRequest $request, Redirect $cms_redirect): RedirectResponse
    {
        $cms_redirect = app(RedirectUpdateAction::class)->handle($cms_redirect, $request->validated());
        return LaravelRedirect::to(route('admin.cms.redirects.edit', $cms_redirect))
            ->with('success', 'Redirect updated.');
    }
}
