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

    protected function addCustomSearchOptions(): void
    {
        if (Arr::get($this->search_options, 'is_purchasable')) {
            $this->isPurchasable();
        }
    }

    protected function isPurchasable(): void
    {
        $this->query->isPurchasable();
    }

    protected function getQueryBuilder(): Builder
    {
        return Course::query();
    }
}
