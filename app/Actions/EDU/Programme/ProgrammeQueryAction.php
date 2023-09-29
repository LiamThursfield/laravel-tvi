<?php

namespace App\Actions\EDU\Programme;

use App\Actions\AbstractQueryAction;
use App\Models\EDU\Programme\Announcement;
use Illuminate\Database\Eloquent\Builder;

class ProgrammeQueryAction extends AbstractQueryAction
{
    protected array $searchable_fields_likes = [
        'name' => 'programme_name',
        'slug' => 'programme_slug',
    ];

    protected string $order_by = 'name';

    protected function getQueryBuilder(): Builder
    {
        return Announcement::query();
    }
}
