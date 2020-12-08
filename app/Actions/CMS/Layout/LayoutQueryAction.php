<?php

namespace App\Actions\CMS\Layout;

use App\Models\CMS\Layout;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class LayoutQueryAction
{
    protected string $order_by          = 'name';
    protected string $order_direction   = 'asc';


    public function handle(array $search_options = []) : Builder
    {
        $query = Layout::query();

        if (Arr::get($search_options, 'layout_name')) {
            $query->where(
                'name',
                'like',
                '%' . Arr::get($search_options, 'layout_name') . '%'
            );
        }

        if (Arr::get($search_options, 'layout_slug')) {
            $query->where(
                'slug',
                'like',
                '%' . Arr::get($search_options, 'layout_slug') . '%'
            );
        }

        if (Arr::get($search_options, 'template_id')) {
            $query->where('template_id', Arr::get($search_options, 'template_id'));
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
