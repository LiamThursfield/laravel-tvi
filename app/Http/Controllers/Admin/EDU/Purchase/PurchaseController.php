<?php

namespace App\Http\Controllers\Admin\EDU\Purchase;

use App\Actions\EDU\Purchase\PurchaseQueryAction;
use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\EDU\Purchase\PurchaseIndexRequest;
use App\Http\Requests\Admin\EDU\Purchase\PurchaseUpdateRequest;
use App\Http\Resources\Admin\EDU\Purchase\PurchaseResource;
use App\Interfaces\AppInterface;
use App\Interfaces\EDU\Purchase\PurchaseInterface;
use App\Interfaces\PermissionInterface;
use App\Models\EDU\Purchase\Purchase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class PurchaseController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->addMetaTitleSection('EDU');
        $this->addMetaTitleSection('Purchases');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::CREATE_EDU_PURCHASES)
        )->only(['create', 'store']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::DELETE_EDU_PURCHASES)
        )->only('destroy');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::EDIT_EDU_PURCHASES)
        )->only(['edit', 'update']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::VIEW_EDU_PURCHASES)
        )->only('index');
    }

    public function destroy(Purchase $purchase) : RedirectResponse
    {
        $purchase->delete();

        return Redirect::back(303)->with(
            'success',
            'Deleted.'
        );
    }

    public function edit(Purchase $purchase) : Response
    {
        $this->addMetaTitleSection('Edit - ' . $purchase->title)->shareMeta();

        return Inertia::render('admin/edu/purchase/Edit', [
            'purchase' => function () use ($purchase) {
                PurchaseResource::withoutWrapping();
                return PurchaseResource::make($purchase);
            },
        ]);
    }

    public function index(PurchaseIndexRequest $request) : Response
    {
        $search_options = $request->validated();

        $this->shareMeta();

        $data = app(PurchaseQueryAction::class)
            ->handle($search_options)
            ->with(['user', 'purchaseItems', 'purchaseItems.course'])
            ->paginate(AppInterface::getSearchPaginationParam($search_options));

        return Inertia::render('admin/edu/purchase/Index', [
            'purchases' => $data,
            'searchOptions' => $search_options,
            'statuses' => PurchaseInterface::PAYMENT_STATUSES,
        ]);
    }

    public function update(PurchaseUpdateRequest $request, Purchase $purchase)
    {
//        $purchase = app(AnnouncementUpdateAction::class)->handle($purchase, $request->validated());
//
//        return Redirect::to(route('admin.edu.purchases.edit', $purchase))
//            ->with('success', 'Updated');
        return;
    }
}
