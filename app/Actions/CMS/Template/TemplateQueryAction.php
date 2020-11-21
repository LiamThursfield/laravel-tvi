<?php

namespace App\Actions\CMS\Template;

use App\Models\CMS\Template;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class TemplateQueryAction
{
    protected string $order_by          = 'name';
    protected string $order_direction   = 'asc';


    /**
     * @param array $search_options
     * @return Builder
     */
    public function handle(array $search_options = []) {
        $query = Template::query();

        if (Arr::get($search_options, 'template_name')) {
            $query->where(
                'name',
                'like',
                '%' . Arr::get($search_options, 'template_name') . '%'
            );
        }

        if (Arr::get($search_options, 'template_slug')) {
            $query->where(
                'slug',
                'like',
                '%' . Arr::get($search_options, 'template_slug') . '%'
            );
        }

        if (Arr::get($search_options, 'template_type')) {
            $query->where('type', Arr::get($search_options, 'template_type'));
        }

        $query->orderBy(
            Arr::get($search_options, 'order_by', $this->order_by),
            Arr::get($search_options, 'order_direction', $this->order_direction),
        );

        return $query;
    }
}
