<?php

namespace App\Actions\CMS\Redirect;

use App\Actions\AbstractQueryAction;
use App\Models\CMS\Redirect;
use App\Models\CMS\Template;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class RedirectQueryAction extends AbstractQueryAction
{
    protected array $searchable_fields_equals = [
        'is_enabled'    => 'redirect_is_enabled',
        'is_permanent'  => 'redirect_is_permanent'
    ];

    protected array $searchable_fields_likes = [
        'url_from'  => 'redirect_url_from',
        'url_to'    => 'redirect_url_to',
    ];

    protected string $order_by = 'url_from';


    protected function getQueryBuilder(): Builder
    {
        return Redirect::query();
    }
}
