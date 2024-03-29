<?php

namespace App\Actions\EDU\Lecture;

use App\Actions\AbstractQueryAction;
use App\Models\EDU\Lecture\Lecture;
use Illuminate\Database\Eloquent\Builder;

class LectureQueryAction extends AbstractQueryAction
{
    protected array $searchable_fields_likes = [
        'title' => 'lecture_title',
        'slug' => 'lecture_slug',
    ];

    protected string $order_by = 'title';

    protected function getQueryBuilder(): Builder
    {
        return Lecture::query();
    }
}
