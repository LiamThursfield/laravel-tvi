<?php

namespace App\Actions\CMS\Page;

use App\Actions\AbstractQueryAction;
use App\Models\CMS\Page;
use App\Models\CMS\Url;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class PageQueryAction extends AbstractQueryAction
{
    protected array $searchable_fields_equals = [
        'layout_id'     => 'layout_id',
        'page_id'       => 'page_id',
        'template_id'   => 'template_id',
    ];

    protected array $searchable_fields_likes = [
        'name' => 'page_name',
        'slug' => 'page_slug',
    ];

    protected string $order_by = 'url_full';

    protected function addCustomSearchOptions()
    {
        if (Arr::get($this->search_options, 'page_url')) {
            $this->query->whereHas('url', function (Builder $query) {
                $url = Arr::get($this->search_options, 'page_url');
                if (!Str::startsWith($url, '/')) {
                    $url = '/' . $url;
                }

                $query->where('url_full', $url);
            });
        }

        if (Arr::get($this->search_options, 'is_active')) {
            $this->query->whereHas('url', function (Builder $query) {
                $query->where('is_enabled', 1);

                $query->where(function (Builder $subQ) {
                    $subQ->whereNull('published_at')
                        ->orWhere('published_at', '<=', now());
                });
                $query->where(function (Builder $subQ) {
                    $subQ->whereNull('expired_at')
                        ->orWhere('expired_at', '>=', now());
                });

            });
        }
    }

    protected function addOrderOptions()
    {
        $order_by = Arr::get($this->search_options, 'order_by', $this->order_by);
        $order_direction = Arr::get($this->search_options, 'order_direction', $this->order_direction);

        if ($order_by === 'url_full') {
            $ordered_ids = Url::where('urlable_type', '=', Page::class)
                ->orderBy('url_full',  $order_direction)
                ->pluck('urlable_id')
                ->implode(',');

            $this->query->orderByRaw('FIELD (id, ' . $ordered_ids . ')');
        } else {
            $this->query->orderBy($order_by, $order_direction);
        }
    }


    protected function getQueryBuilder(): Builder
    {
        return Page::query();
    }
}
