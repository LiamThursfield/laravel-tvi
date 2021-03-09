<?php

namespace App\Actions\CMS\Layout;

use App\Actions\AbstractQueryAction;
use App\Models\CMS\Layout;
use Illuminate\Database\Eloquent\Builder;

class LayoutQueryAction extends AbstractQueryAction
{
    protected array $searchable_fields_equals  = [
        'template_id' => 'template_id',
    ];

    protected array $searchable_fields_likes  = [
        'name' => 'layout_name',
        'slug' => 'layout_slug',
    ];

    protected string $order_by = 'name';


    protected function getQueryBuilder(): Builder
    {
        return Layout::query();
    }

}
