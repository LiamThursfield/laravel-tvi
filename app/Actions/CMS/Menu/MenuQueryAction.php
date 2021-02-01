<?php

namespace App\Actions\CMS\Menu;

use App\Models\CMS\Menu;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class MenuQueryAction
{
    protected string $order_by          = 'name';
    protected string $order_direction   = 'asc';


    public function handle(array $search_options = []) : Builder
    {
        $query = Menu::query();

        if (Arr::get($search_options, 'menu_name')) {
            $query->where(
                'name',
                'like',
                '%' . Arr::get($search_options, 'menu_name') . '%'
            );
        }

        if (Arr::get($search_options, 'menu_slug')) {
            $query->where(
                'slug',
                'like',
                '%' . Arr::get($search_options, 'menu_slug') . '%'
            );
        }

        $query->orderBy(
            Arr::get($search_options, 'order_by', $this->order_by),
            Arr::get($search_options, 'order_direction', $this->order_direction),
        );

        if (Arr::get($search_options, 'with')) {
            $query->with(Arr::get($search_options, 'with'));
        }

        return $query;
    }
}
