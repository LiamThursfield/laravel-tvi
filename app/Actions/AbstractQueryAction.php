<?php

namespace App\Actions;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

abstract class AbstractQueryAction
{
    protected Builder $query;
    protected array $search_options;

    // Default search params
    protected array $searchable_fields_equals = [];
    protected array $searchable_fields_likes  = [];

    // Default order params
    protected string $order_by          = 'id';
    protected string $order_direction   = 'asc';



    public function handle(array $search_options = []) : Builder
    {
        $this->search_options = $search_options;
        $this->query = $this->getQueryBuilder();

        $this->addStandardSearchOptions();
        $this->addCustomSearchOptions();

        $this->addOrderOptions();

        $this->addRelationships();

        return $this->query;
    }


    protected function addCustomSearchOptions() {}


    protected function addOrderOptions()
    {
        $order_by = Arr::get($this->search_options, 'order_by', $this->order_by);
        $order_direction = Arr::get($this->search_options, 'order_direction', $this->order_direction);

        $this->query->orderBy($order_by, $order_direction);
    }


    protected function addRelationships()
    {
        if (Arr::get($this->search_options, 'with')) {
            $this->query->with(Arr::get($this->search_options, 'with'));
        }

        if (Arr::get($this->search_options, 'with_count')) {
            $this->query->withCount(Arr::get($this->search_options, 'with_count'));
        }
    }


    protected function addStandardSearchOptions()
    {
        foreach ($this->searchable_fields_equals as $field => $value) {
            if ($this->isSearchOptionsValueSet($value)) {
                $this->query->where($field, Arr::get($this->search_options, $value));
            }
        }

        foreach ($this->searchable_fields_likes as $field => $value) {
            if ($this->isSearchOptionsValueSet($value)) {
                $this->query->where(
                    $field,
                    'like',
                    '%' . Arr::get($this->search_options, $value) . '%'
                );
            }
        }
    }

    /**
     * A value is classified as "set" if it isn't null or and empty string
     * i.e. is a non-empty string, a number, or a boolean
     */
    protected function isSearchOptionsValueSet(mixed $value): bool
    {
        return (
            Arr::get($this->search_options, $value) ||
            strlen(Arr::get($this->search_options, $value)) ||
            is_bool(Arr::get($this->search_options, $value))
        );
    }


    abstract protected function getQueryBuilder() : Builder;
}
