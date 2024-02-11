<?php

namespace App\Actions\EDU\Announcement;

use App\Actions\AbstractQueryAction;
use App\Models\EDU\Announcement\Announcement;
use Illuminate\Database\Eloquent\Builder;

class AnnouncementQueryAction extends AbstractQueryAction
{
    protected array $searchable_fields_likes = [
        'title' => 'announcement_title',
        'slug' => 'announcement_slug',
    ];

    protected string $order_by = 'title';

    protected function getQueryBuilder(): Builder
    {
        return Announcement::query();
    }
}
