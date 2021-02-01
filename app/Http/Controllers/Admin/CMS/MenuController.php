<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Actions\CMS\Menu\MenuQueryAction;
use App\Actions\CMS\Menu\MenuStoreAction;
use App\Actions\CMS\Menu\MenuUpdateAction;
use App\Http\Controllers\AdminCMSController;
use App\Http\Requests\Admin\CMS\Menu\MenuIndexRequest;
use App\Http\Requests\Admin\CMS\Menu\MenuStoreRequest;
use App\Http\Requests\Admin\CMS\Menu\MenuUpdateRequest;
use App\Http\Resources\Admin\CMS\MenuResource;
use App\Interfaces\AppInterface;
use App\Models\CMS\Menu;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class MenuController extends AdminCMSController
{

    public function __construct()
    {
        parent::__construct();
        $this->addMetaTitleSection('Menus');
    }

    public function create() : Response
    {
        $this->addMetaTitleSection('Create')->shareMeta();
        return Inertia::render('admin/cms/menu/Create', [

        ]) ;
    }

    public function destroy(Menu $menu) : RedirectResponse
    {
        $menu->delete();

        return Redirect::back(303)->with(
            'success',
            'Menu Deleted.'
        );
    }

    public function edit(Menu $menu) : Response
    {
        $this->addMetaTitleSection('Edit - ' . $menu->name)->shareMeta();
        return Inertia::render('admin/cms/menu/Edit', [
            'menu' => function () use ($menu) {
                MenuResource::withoutWrapping();
                return MenuResource::make($menu);
            }
        ]);
    }

    public function index(MenuIndexRequest $request) : Response
    {
        $search_options = $request->validated();

        $this->shareMeta();
        return Inertia::render('admin/cms/menu/Index', [
            'menus' => function () use ($search_options) {
                return app(MenuQueryAction::class)
                    ->handle($search_options)
                    ->paginate(AppInterface::getSearchPaginationParam($search_options));
            },
            'searchOptions' => $search_options
        ]);
    }

    public function store(MenuStoreRequest $request) : RedirectResponse
    {
        $menu = app(MenuStoreAction::class)->handle($request->validated());
        return Redirect::to(route('admin.cms.menus.edit', $menu))
            ->with('success', 'Menu Created');
    }

    public function update(MenuUpdateRequest $request, Menu $menu) : RedirectResponse
    {
        $menu = app(MenuUpdateAction::class)->handle($menu, $request->validated());
        return Redirect::to(route('admin.cms.menus.edit', $menu))
            ->with('success', 'Menu Updated');
    }
}
