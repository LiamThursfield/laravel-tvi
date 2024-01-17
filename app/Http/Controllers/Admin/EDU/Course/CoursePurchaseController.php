<?php

namespace App\Http\Controllers\Admin\EDU\Course;

use App\Actions\EDU\Course\Purchase\CoursePurchaseQueryAction;
use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\EDU\Course\CoursePurchaseIndexRequest;
use App\Http\Resources\Admin\EDU\Course\CoursePurchaseResource;
use App\Interfaces\AppInterface;
use App\Interfaces\EDU\Course\CoursePurchaseInterface;
use App\Interfaces\PermissionInterface;
use App\Models\EDU\Course\CoursePurchase;
use Illuminate\Support\Arr;
use Inertia\Inertia;
use Inertia\Response;

class CoursePurchaseController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->addMetaTitleSection('EDU');
        $this->addMetaTitleSection('Course Purchases');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::VIEW_EDU_COURSE_PURCHASES)
        )->only(['index', 'show']);
    }

    public function index(CoursePurchaseIndexRequest $request): Response
    {
        $search_options = $request->validated();

        $this->shareMeta();

        return Inertia::render('admin/edu/course/purchase/Index', [
            'purchases' => function () use ($search_options) {
                return app(CoursePurchaseQueryAction::class)
                    ->handle($search_options)
                    ->with(['course', 'user'])
                    ->paginate(AppInterface::getSearchPaginationParam($search_options));
            },
            'searchOptions' => $search_options,
            'statuses' => Arr::only(
                CoursePurchaseInterface::PAYMENT_STATUSES,
                CoursePurchaseInterface::PAYMENT_STATUSES_FOR_PURCHASES
            ),
            'types' => CoursePurchaseInterface::PURCHASE_TYPES,
        ]);
    }

    public function show(CoursePurchase $coursePurchase): Response
    {
        $this->addMetaTitleSection('View')->shareMeta();

        return Inertia::render('admin/edu/course/purchase/Show', [
            'paymentStatuses' => Arr::only(
                CoursePurchaseInterface::PAYMENT_STATUSES,
                CoursePurchaseInterface::PAYMENT_STATUSES_FOR_PAYMENTS
            ),
            'purchase' => function () use ($coursePurchase) {
                $coursePurchase->load([
                    'course',
                    'instalmentPlan',
                    'purchasePayments',
                    'user',
                ]);

                CoursePurchaseResource::withoutWrapping();
                return CoursePurchaseResource::make($coursePurchase);
            },
            'statuses' => Arr::only(
                CoursePurchaseInterface::PAYMENT_STATUSES,
                CoursePurchaseInterface::PAYMENT_STATUSES_FOR_PURCHASES
            ),
            'types' => CoursePurchaseInterface::PURCHASE_TYPES,
        ]);
    }

}
