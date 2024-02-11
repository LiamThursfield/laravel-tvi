<?php

namespace App\Actions\EDU\Webinar;

use App\Actions\AbstractQueryAction;
use App\Models\EDU\Webinar\Webinar;
use Illuminate\Database\Eloquent\Builder;

class WebinarQueryAction extends AbstractQueryAction
{
    protected array $searchable_fields_likes = [
        'name' => 'lecture_name',
        'slug' => 'lecture_slug',
    ];

    protected string $order_by = 'name';

    protected function getQueryBuilder(): Builder
    {
        return Webinar::query();
    }
}
