<?php

namespace App\Actions\CMS\Template;

use App\Actions\AbstractQueryAction;
use App\Models\CMS\Template;
use Illuminate\Database\Eloquent\Builder;

class TemplateQueryAction extends AbstractQueryAction
{
    protected array $searchable_fields_equals = [
        'type' => 'template_type',
    ];

    protected array $searchable_fields_likes = [
        'name' => 'template_name',
        'slug' => 'template_slug',
    ];

    protected string $order_by = 'name';


    protected function getQueryBuilder(): Builder
    {
        return Template::query();
    }
}
