<?php

namespace App\Actions\CMS\Page;

use App\Models\CMS\Page;
use App\Models\CMS\Url;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class PageQueryAction
{
    protected string $order_by          = 'url_full';
    protected string $order_direction   = 'asc';


    public function handle(array $search_options = []) : Builder
    {
        $query = Page::query();

        if (Arr::get($search_options, 'page_name')) {
            $query->where(
                'name',
                'like',
                '%' . Arr::get($search_options, 'page_name') . '%'
            );
        }

        if (Arr::get($search_options, 'page_slug')) {
            $query->where(
                'slug',
                'like',
                '%' . Arr::get($search_options, 'page_slug') . '%'
            );
        }

        if (Arr::get($search_options, 'layout_id')) {
            $query->where('layout_id', Arr::get($search_options, 'layout_id'));
        }

        if (Arr::get($search_options, 'page_id')) {
            $query->where('page_id', Arr::get($search_options, 'page_id'));
        }


        if (Arr::get($search_options, 'template_id')) {
            $query->where('template_id', Arr::get($search_options, 'template_id'));
        }

        $order_by = Arr::get($search_options, 'order_by', $this->order_by);
        $order_direction = Arr::get($search_options, 'order_direction', $this->order_direction);

        if ($order_by === 'url_full') {
            $ordered_ids = Url::where('urlable_type', '=', Page::class)
                ->orderBy('url_full',  $order_direction)
                ->pluck('urlable_id')
                ->implode(',');

            $query->orderByRaw('FIELD (id, ' . $ordered_ids . ')');
        } else {
            $query->orderBy($this->order_by, $this->order_direction);
        }

        if (Arr::get($search_options, 'with')) {
            $query->with(Arr::get($search_options, 'with'));
        }

        return $query;
    }
}
