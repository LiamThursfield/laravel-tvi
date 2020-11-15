<?php

namespace App\Interfaces\CMS;

class TemplateInterface
{
    // Template Types
    const TYPE_LAYOUT   = 'layout';
    const TYPE_PAGE     = 'page';

    const ALL_TYPES = [
        self::TYPE_LAYOUT,
        self::TYPE_PAGE,
    ];


    // Table/Model Field Helpers
    const FIELD_NAME_MAX_LENGTH = 120;
    const FIELD_TYPE_MAX_LENGTH = 50;
}
