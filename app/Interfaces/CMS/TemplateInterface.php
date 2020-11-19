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

    const ALL_TYPES_LABELLED = [
        self::TYPE_LAYOUT => 'Layout',
        self::TYPE_PAGE => 'Page'
    ];


    // Table/Model Field Helpers
    const FIELD_NAME_MAX_LENGTH = 120;
    const FIELD_SLUG_MAX_LENGTH = self::FIELD_NAME_MAX_LENGTH; // Slug shouldn't be any longer than name
    const FIELD_TYPE_MAX_LENGTH = 50;
}
