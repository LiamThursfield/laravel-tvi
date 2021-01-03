<?php

namespace App\Interfaces;

use Illuminate\Support\Arr;

class AppInterface
{
    // Default search params
    const SEARCH_PAGINATION_DEFAULT = 15;
    const SEARCH_PAGINATION_KEY     = 'per_page';

    public static function getSearchPaginationParam(
        array $search_options, ?string $pagination_key = null, ?int $pagination_default = null
    ) : int
    {
        if (is_null($pagination_key)) {
            $pagination_key = self::SEARCH_PAGINATION_KEY;
        }

        if (is_null($pagination_default)) {
            $pagination_default = self::SEARCH_PAGINATION_DEFAULT;
        }

        return Arr::get(
            $search_options,
            $pagination_key,
            $pagination_default
        );
    }

}
