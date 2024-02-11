<?php

namespace App\Interfaces\EDU\Announcement;

class AnnouncementInterface
{
    public const STATUS_DRAFT = 'DRAFT';

    public const STATUS_FINISHED = 'FINISHED';

    public const STATUS_PUBLISHED = 'PUBLISHED';

    public const STATUSES = [
        self::STATUS_DRAFT => 'Draft',
        self::STATUS_FINISHED => 'Finished',
        self::STATUS_PUBLISHED => 'Published',
    ];
}
