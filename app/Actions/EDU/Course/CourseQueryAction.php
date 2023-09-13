<?php

namespace App\Actions\EDU\Course;

use App\Actions\AbstractQueryAction;
use App\Models\EDU\Course\Course;
use Illuminate\Database\Eloquent\Builder;

class CourseQueryAction extends AbstractQueryAction
{
    protected array $searchable_fields_likes = [
        'name' => 'course_name',
        'slug' => 'course_slug',
    ];

    protected string $order_by = 'name';

    protected function getQueryBuilder(): Builder
    {

        return Course::query();
    }
}
