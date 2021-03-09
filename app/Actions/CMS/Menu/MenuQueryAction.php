<?php

namespace App\Actions\CMS\Menu;

use App\Actions\AbstractQueryAction;
use App\Models\CMS\Menu;
use Illuminate\Database\Eloquent\Builder;

class MenuQueryAction extends AbstractQueryAction
{
    protected array $searchable_fields_likes = [
        'name' => 'menu_name',
        'slug' => 'menu_slug',
    ];

    protected string $order_by = 'name';

    protected function getQueryBuilder(): Builder
    {
        return Menu::query();
    }
}
