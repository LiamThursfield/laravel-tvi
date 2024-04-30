<?php

namespace App\Actions\EDU\Course\Purchase;

use App\Actions\AbstractQueryAction;
use App\Models\EDU\Course\CoursePurchase;
use Illuminate\Database\Eloquent\Builder;

class CoursePurchaseQueryAction extends AbstractQueryAction
{
    protected array $searchable_fields_likes = [
        'email_address' => 'course_purchase_email_address',
    ];

    protected array $searchable_fields_equals = [
        'course_id' => 'course_purchase_course_id',
        'status'    => 'course_purchase_status',
        'type'      => 'course_purchase_type',
        'user_id'   => 'course_purchase_user_id',
    ];

    protected string $order_by = 'id';

    protected string $order_direction = 'desc';

    protected function getQueryBuilder(): Builder
    {
        return CoursePurchase::query();
    }
}
