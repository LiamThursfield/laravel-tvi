<?php

namespace App\Actions\EDU\Purchase;

use App\Actions\AbstractQueryAction;
use App\Models\EDU\Announcement\Announcement;
use App\Models\EDU\Purchase\Purchase;
use Illuminate\Database\Eloquent\Builder;

class PurchaseQueryAction extends AbstractQueryAction
{
    protected array $searchable_fields_likes = [
        'title' => 'payment_status',
    ];

    protected string $order_by = 'created_at';

    protected function getQueryBuilder(): Builder
    {
        return Purchase::query();
    }
}
