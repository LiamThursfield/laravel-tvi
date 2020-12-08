<?php

namespace App\Interfaces\CMS;

class CMSInterface
{
    // Table/Model field helpers
    const FIELD_NAME_MAX_LENGTH = 120;
    const FIELD_SLUG_MAX_LENGTH = self::FIELD_NAME_MAX_LENGTH; // Slug shouldn't be any longer than name
}
