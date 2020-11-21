<?php

namespace App\Interfaces\CMS;

class TemplateFieldInterface
{
    // Template Field Types
    const TYPE_NUMBER   = 'number';
    const TYPE_TEXT     = 'text';
    const TYPE_TEXTAREA = 'textarea';
    const TYPE_WYSIWYG  = 'wysiwyg';

    const ALL_TYPES = [
        self::TYPE_NUMBER,
        self::TYPE_TEXT,
        self::TYPE_TEXTAREA,
        self::TYPE_WYSIWYG,
    ];

    const ALL_TYPES_LABELLED = [
        self::TYPE_NUMBER   => "Number",
        self::TYPE_TEXT     => "Text",
        self::TYPE_TEXTAREA => "Text Area",
        self::TYPE_WYSIWYG  => "WYSIWYG",
    ];


    // Table/Model Field Helpers
    const FIELD_NAME_MAX_LENGTH = 120;
    const FIELD_SLUG_MAX_LENGTH = self::FIELD_NAME_MAX_LENGTH; // Slug shouldn't be any longer than name
    const FIELD_TYPE_MAX_LENGTH = 50;
}
