<?php

namespace App\Actions\EDU\Section;

use App\Actions\AbstractQueryAction;
use App\Models\EDU\Section\Section;
use Illuminate\Database\Eloquent\Builder;

class SectionQueryAction extends AbstractQueryAction
{
    protected array $searchable_fields_likes = [
        'title' => 'section_title',
        'slug' => 'section_slug',
    ];

    protected string $order_by = 'title';

    protected function getQueryBuilder(): Builder
    {
        return Section::query();
    }
}
