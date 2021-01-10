<?php

namespace App\Traits\CMS;

use App\Models\CMS\Url;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Builder;

trait HasUrl
{

    public function url() : MorphOne
    {
        return $this->morphOne(Url::class, 'urlable');
    }

    public function scopeWithoutSelfOrChildUrls(Builder $query, string $url_full) : Builder
    {
        if (!$url_full || $url_full === '/') {
            return $query;
        }

        return $query->whereHas(
            'url',
            function ($q) use ($url_full) {
                $q->where('url_full', '<>', $url_full)
                    ->where('url_full', 'NOT LIKE', $url_full . '/%');
            }
        );
    }

    public function scopeWithoutHomeUrl(Builder $query) : Builder
    {
        return $query->whereHas(
            'url',
            function ($q) {
                $q->where('url_full', '<>', '/');
            }
        );
    }

    public function scopeWithOrderedUrl(Builder $query, String $order_direction = 'asc') : Builder
    {
        $ordered_ids = Url::where('urlable_type', '=', self::class)
            ->orderBy('url_full',  $order_direction)
            ->pluck('urlable_id')
            ->implode(',');

        if (!$ordered_ids) {
            return $query;
        }

        return $query->whereHas('url')
            ->with('url')
            ->orderByRaw('FIELD (id, ' . $ordered_ids . ')');
    }
}
