<?php

namespace App\Actions\EDU\Label;

use App\Actions\AbstractQueryAction;
use App\Models\EDU\Label\Label;
use Illuminate\Database\Eloquent\Builder;

class LabelQueryAction extends AbstractQueryAction
{
    protected array $searchable_fields_likes = [
        'name' => 'label_name',
        'slug' => 'label_slug',
    ];

    protected string $order_by = 'name';

    protected function getQueryBuilder(): Builder
    {
        return Label::query();
    }
}
