<?php

namespace App\Interfaces\EDU\Course;

class CourseInterface
{
    public const STATUS_DRAFT = 'DRAFT';

    public const STATUS_CANCELLED = 'CANCELLED';

    public const STATUS_COMPLETED = 'COMPLETED';

    public const STATUS_IN_PROGRESS = 'IN_PROGRESS';

    public const STATUS_PUBLISHED = 'PUBLISHED';

    public const STATUSES = [
        self::STATUS_DRAFT => 'Draft',
        self::STATUS_CANCELLED => 'Cancelled',
        self::STATUS_COMPLETED => 'Completed',
        self::STATUS_IN_PROGRESS => 'In Progress',
        self::STATUS_PUBLISHED => 'Published',
    ];
}
