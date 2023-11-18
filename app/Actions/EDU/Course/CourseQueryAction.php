<?php

namespace App\Actions\EDU\Course;

use App\Actions\AbstractQueryAction;
use App\Interfaces\EDU\Course\CourseInterface;
use App\Models\EDU\Course\Course;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class CourseQueryAction extends AbstractQueryAction
{
    protected array $searchable_fields_likes = [
        'name' => 'course_name',
        'slug' => 'course_slug',
    ];

    protected string $order_by = 'name';

    protected function addCustomSearchOptions()
    {
        if (Arr::get($this->search_options, 'is_purchasable')) {
            $this->isPurchasable();
        }
    }

    protected function isPurchasable()
    {
        $this->query->where('status', CourseInterface::STATUS_PUBLISHED)
            ->where('available_from', '<=', now())
            ->where(function(Builder $query) {
                $query->whereNull('available_to')
                    ->orWhere('available_to', '>', now());
            });
    }

    protected function getQueryBuilder(): Builder
    {
        return Course::query();
    }
}
